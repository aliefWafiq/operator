<?php

namespace App\Http\Controllers;

use App\Events\QueueCalled;
use App\Events\UpdateDisplayAntrean;
use App\Models\antreans;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class antreanController extends Controller
{
    public function panggilAntrean()
    {

        // Log ini akan membantu kita melihat apa yang dianggap 'hari ini' oleh server.
        Log::info('--- Memulai panggilAntrean ---');
        Log::info('Server date (today()): ' . today()->toDateString());

        // 1. Cek berapa total antrean untuk hari ini, tanpa filter status
        $totalAntreanHariIni = antreans::whereDate('tanggal_sidang', today())->count();
        Log::info("Total antrean untuk hari ini (tanpa filter status): " . $totalAntreanHariIni);

        // 2. Cek antrean hari ini yang statusnya 'menunggu'
        $jumlahStatusMenunggu = antreans::whereDate('tanggal_sidang', today())
            ->where('status', 'menunggu')
            ->count();
        Log::info("Dari total itu, yang statusnya 'menunggu': " . $jumlahStatusMenunggu);

        // 3. Cek antrean hari ini yang statusnya 'sudah ambil'
        $jumlahStatusAmbil = antreans::whereDate('tanggal_sidang', today())
            ->where('statusAmbilAntrean', 'sudah ambil')
            ->count();
        Log::info("Dari total itu, yang statusAmbilAntrean 'sudah ambil': " . $jumlahStatusAmbil);

        // 4. Cek antrean yang memenuhi KEDUA kondisi status
        $jumlahKeduaStatus = antreans::whereDate('tanggal_sidang', today())
            ->where('status', 'menunggu')
            ->where('statusAmbilAntrean', 'sudah ambil')
            ->count();
        Log::info("Yang memenuhi KEDUA status di atas: " . $jumlahKeduaStatus);
        // --- AKHIR KODE DEBUG ---
        
        $antreanBerikutnya = antreans::where('status', 'menunggu')
            ->where('statusAmbilAntrean', 'sudah ambil')
            ->whereDate('tanggal_sidang', today())
            ->orderByRaw('ISNULL(prioritized_at) ASC, prioritized_at ASC, id ASC')
            ->first();

        if ($antreanBerikutnya) {
            Log::info('Mencoba mengirim broadcast untuk antrean ID: ' . $antreanBerikutnya->id . ' di channel: antrean.' . $antreanBerikutnya->id);

            try {
                $antreanBerikutnya->status = 'telah dipanggil';
                $antreanBerikutnya->save();

                broadcast(new QueueCalled($antreanBerikutnya));
                broadcast(new UpdateDisplayAntrean($antreanBerikutnya));

                return response()->json($antreanBerikutnya);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Broadcast Gagal: ' . $e->getMessage(),
                ], 500);
            }
        }

        return response()->json(['message' => 'Semua antrean hari ini sudah selesai'], 404);
    }

    public function panggilLagi()
    {
        $antreanSekarang = antreans::where('status', 'telah dipanggil')
            ->whereDate('tanggal_sidang', today())
            ->orderBy('id', 'desc')
            ->first();

        if (!$antreanSekarang) {
            return response()->json(['message' => 'Tidak ada antrean yang sedang aktif'], 404);
        }

        broadcast(new UpdateDisplayAntrean($antreanSekarang));

        return response()->json($antreanSekarang);
    }

    public function panggilAntreanSebelumnya()
    {
        $antreanSekarang = antreans::where('status', 'telah dipanggil')
            ->whereDate('tanggal_sidang', today())
            ->orderBy('id', 'desc')
            ->first();

        if (!$antreanSekarang) {
            return response()->json(['message' => 'Tidak ada antrean yang sedang aktif.'], 404);
        }

        $antreanSebelumnya = antreans::where('status', 'telah dipanggil')
            ->whereDate('tanggal_sidang', today())
            ->where('id', '<', $antreanSekarang->id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$antreanSebelumnya) {
            return response()->json(['message' => 'Ini adalah antrean pertama.'], 404);
        }

        DB::transaction(function () use ($antreanSekarang, $antreanSebelumnya) {
            $antreanSekarang->status = 'menunggu';
            $antreanSekarang->save();
        });

        broadcast(new UpdateDisplayAntrean($antreanSebelumnya));

        return response()->json($antreanSebelumnya);
    }

    public function prioritaskan($id)
    {
        $antrean = antreans::where('id', $id)
            ->where('status', 'menunggu')
            ->whereDate('tanggal_sidang', today())
            ->first();

        if ($antrean) {
            if (is_null($antrean->prioritized_at)) {
                $antrean->prioritized_at = now();
                $antrean->save();
            }
            return response()->json(['message' => 'Antrean berhasil diprioritaskan.']);
        }

        return response()->json(['message' => 'Antrean tidak ditemukan atau sudah dipanggil'], 404);
    }
}
