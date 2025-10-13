<?php

namespace App\Http\Controllers;

use App\Events\QueueCalled;
use App\Models\antreans;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class antreanController extends Controller
{
    public function panggilAntrean()
    {
        $antreanBerikutnya = antreans::where('status', 'menunggu')
            ->where('statusAmbilAntrean', 'sudah ambil')
            ->whereDate('tanggal_sidang', today())
            ->orderByRaw('ISNULL(prioritized_at) ASC, prioritized_at ASC, id ASC')
            ->first();

        Log::info('Mencoba mengirim broadcast untuk antrean ID: ' . $antreanBerikutnya->id . ' di channel: antrean.' . $antreanBerikutnya->id);

        if ($antreanBerikutnya) {
            try {
                $antreanBerikutnya->status = 'telah dipanggil';
                $antreanBerikutnya->save();

                broadcast(new QueueCalled($antreanBerikutnya));

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
