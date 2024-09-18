<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AntrianController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function nomorAntrian()
    {
        return view('nomor-antrian.index');
    }

    public function panggilanAntrian()
    {
        $jumlah_antrian = Antrian::count();
        $antrian_sekarang = Antrian::where('status', 1)->first();
        $antrian_selanjutnya = Antrian::where('status', 0)->first();
        $sisa_antrian = Antrian::where('status', 0)->count();

        if ($antrian_sekarang) {
            $antrian_sekarang = $antrian_sekarang->no_antrian;
        } else {
            $antrian_sekarang = 0;
        }

        if ($antrian_selanjutnya) {
            $antrian_selanjutnya = $antrian_selanjutnya->no_antrian;
        } else {
            $antrian_selanjutnya = 0;
        }

        return view('panggilan-antrian.index', compact('jumlah_antrian', 'antrian_sekarang', 'antrian_selanjutnya', 'sisa_antrian'));
    }

    public function getNoAntrian()
    {
        $tanggal_antrian = now()->format('Y-m-d');
        $jumlah_antrian = Antrian::whereDate('tanggal_antrian', $tanggal_antrian)->count();

        return number_format($jumlah_antrian, 0, '', '.');
    }

    public function insertAntrian(Request $request)
    {
        // Get the current date and time
        $tanggal_antrian = now()->format('Y-m-d');

        // Get the current number of antrians for today
        $jumlah_antrian = Antrian::whereDate('tanggal_antrian', $tanggal_antrian)->count();

        // Check if the number of antrians has reached 10
        // if ($jumlah_antrian >= 10) {
        //     return 'Maaf, antrian telah mencapai batas maksimal 10.';
        // }

        // Get the last antrian number for today
        $lastAntrian = Antrian::whereDate('tanggal_antrian', $tanggal_antrian)->max('no_antrian');

        // If there's no antrian for today, start from 1
        if (!$lastAntrian) {
            $no_antrian = 1;
        } else {
            // Increment the last antrian number by 1
            $no_antrian = $lastAntrian + 1;
        }

        // Insert the new antrian into the database
        $antrian = new Antrian();
        $antrian->tanggal_antrian = $tanggal_antrian;
        $antrian->no_antrian = $no_antrian;
        $antrian->save();

        // Return a success message
        return 'Sukses';
    }



    public function getJumlahAntrian()
    {
        $jumlah_antrian = Antrian::count();
        return response()->json($jumlah_antrian);
    }

    public function getAntrianSekarang()
    {
        $antrian_sekarang = Antrian::where('status', 1)->first();
        if ($antrian_sekarang) {
            $antrian_sekarang = $antrian_sekarang->no_antrian;
        } else {
            $antrian_sekarang = 0;
        }
        return response()->json($antrian_sekarang);
    }

    public function getAntrianSelanjutnya()
    {
        $antrian_selanjutnya = Antrian::where('status', 0)->first();
        if ($antrian_selanjutnya) {
            $antrian_selanjutnya = $antrian_selanjutnya->no_antrian;
        } else {
            $antrian_selanjutnya = 0;
        }
        return response()->json($antrian_selanjutnya);
    }

    public function getSisaAntrian()
    {
        $sisa_antrian = Antrian::where('status', 0)->count();
        return response()->json($sisa_antrian);
    }

    public function getAntrian()
    {
        $antrian = Antrian::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'no_antrian' => $item->no_antrian,
                'tanggal_antrian' => $item->tanggal_antrian,
                'updated_antrian' => $item->updated_antrian,
                'jumlah_dipanggil' => $item->jumlah_dipanggil,
                'lama_antrian' => $item->lama_antrian,
                'status' => $item->status,
            ];
        });
        return response()->json($antrian);
    }
    public function updateAntrian(Request $request)
    {
        $antrian = Antrian::find($request->id);
        $antrian->status = 1;

        // Tambahkan jumlah dipanggil + 1
        if ($antrian->jumlah_dipanggil === null) {
            $antrian->jumlah_dipanggil = 1;
        } else {
            $antrian->jumlah_dipanggil = min($antrian->jumlah_dipanggil + 1, 3);
        }

        $antrian->save();
        return response()->json(['message' => 'Antrian berhasil diupdate']);
    }

}
