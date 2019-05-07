<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bondg;
use App\User;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function GetOrder(Request $request)
    {   
        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $petugas = User::where('remember_token', $request->token)->where('active', 1)->first();
            $bondg = bondg::select('posko', 'nodg as id_laporan', 'namapel as nama_pelapor', 'nohp as no_hp pelapor',
                'alamat as alamat_pelapor', 'keluhan', 'noagenda as nomor_agenda', 'tgldg as tgl_bln_thn', 'nometerlama as no_meter_lama', 'nometerbaru as no_meter_baru',
                'daya', 'gardu', 'perbaikan', 'tglkirimpetugas as tgl_kirim_petugas' )
                ->where('id_petugas', '=', $petugas->id)
                ->where('status', '=', 'Pengiriman WO')
                ->get();

            return response()->json(array(
                'error' => 0,
                'message' => $bondg->toArray(),
            ), 200);
        }
        
    }

    public function GetDetailOrder (Request $request)
    {

        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $request->validate([
                'id_laporan' => 'required',
            ]);
            $petugas = User::where('remember_token', $request->token)->where('active', 1)->first();        
            $bondg = bondg::select('posko', 'nodg as id_laporan', 'namapel as nama_pelapor', 'nohp as no_hp pelapor',
                'alamat as alamat_pelapor', 'keluhan', 'noagenda as nomor_agenda', 'tgldg as tgl_bln_thn', 'nometerlama as no_meter_lama', 'nometerbaru as no_meter_baru',
                'daya', 'gardu', 'perbaikan', 'tglkirimpetugas as tgl_kirim_petugas' )
                ->where('nodg', '=', $request->id_laporan)
                ->get();
            $idpetugas = bondg::where('nodg', '=', $request->id_laporan)->get();
    
            if( $petugas->id == $idpetugas[0]->id_petugas)
            {
                return response()->json(array(
                    'error' => 0,
                    'message' => $idpetugas->toArray(),
                ), 200);
            }
            else
            {
                return response()->json(array(
                    'error' => 1,
                    'message' => "Unauthorized",
                ), 200);
            }
        }
        
    }

    public function CancelOrder(Request $request)
    {

        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
        if($user == NULL)
        {
            return response()->json(['error' => 1,'message' => 'Token Salah!'], 200);  
        }
        else
        {
            $request->validate([
                'id_laporan' => 'required',
                'alasan' => 'required',
            ]);
    
            $bondg = bondg::find($request->id_laporan);
            if($bondg->cancel_1 == NULL)
            {
                $bondg->cancel_1 = $request->alasan;
                $bondg->save();
                return response()->json(array(
                    'error' => 0,
                    'message' => "Berhasil diubah",
                ), 200);
            }
            else
            {
                $bondg->cancel_2 = $request->alasan;
                $bondg->tglbatal = Carbon::now();
                $bondg->status = "Batal";
                $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
                $bondg->save();
                return response()->json(array(
                    'error' => 0,
                    'message' => "Berhasil diubah",
                ), 200);
            }
        }
        
    }
}
