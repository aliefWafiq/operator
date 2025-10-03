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
        $antreanBerikutnya = antreans::where('status', 'menunggu')->whereDate('tanggal_sidang', Carbon::today())->orderBy('id', 'asc')->first();

        Log::info('Mencoba mengirim broadcast untuk antrean ID: ' . $antreanBerikutnya->id . ' di channel: antrean.' . $antreanBerikutnya->id);

        if ($antreanBerikutnya) {
            try {
                $antreanBerikutnya->status = 'telah di panggil';
                $antreanBerikutnya->save();

                broadcast(new QueueCalled($antreanBerikutnya));

                return response()->json($antreanBerikutnya);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Broadcast Gagal: ' . $e->getMessage(),
                ], 500); // Kirim status 500
            }
        }

        return response()->json(['message' => 'Semua antrean hari ini sudah selesai'], 404);
    }

    public function panggilAntreanSebelumnya()
    {
        $antreanSekarang = antreans::where('status', 'telah di panggil')
            ->whereDate('tanggal_sidang', today())
            ->orderBy('id', 'desc')
            ->first();

        if (!$antreanSekarang) {
            return response()->json(['message' => 'Tidak ada antrean yang sedang aktif'], 404);
        }

        $antreanSebelumnya = antreans::where('status', 'telah di panggil')
            ->whereDate('tanggal_sidang', today())
            ->where('id', '<', $antreanSekarang->id)
            ->orderBy('id', 'desc')
            ->first();

        DB::transaction(function () use ($antreanSekarang, $antreanSebelumnya) {
            $antreanSekarang->status = 'menunggu';
            $antreanSekarang->save();
        });

        if (!$antreanSebelumnya) {
            return response()->json(null, 200);
        }

        return response()->json($antreanSebelumnya);
    }
}
