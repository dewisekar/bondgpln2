<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use \Auth;
use \Session;
use App\bondg;
use App\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    //bondg
    public function showform_bondg()
    {
        return view('admin.input-bondg');
    }

    public function input_bondg(Request $request)
    {
        $this->validate($request, [
            'idpel' => ['required', 'string', 'min:12', 'max:12'],
            'nometerlama' => ['required', 'string', 'min:11', 'max:11'],
            'nodg' => ['required', 'unique:bondg'],
        ]);
        $bondg = new bondg;
        $bondg->posko = $request->posko;
        $bondg->tgldg = $request->tgldg;
        $bondg->nodg = $request->nodg;
        $bondg->namapel = $request->namapel;
        $bondg->idpel = $request->idpel;
        $bondg->gardu = $request->gardu;
        $bondg->tarif = $request->tarif;
        $bondg->daya = $request->daya;
        $bondg->nohp = $request->nohp;
        $bondg->nometerlama = $request->nometerlama;
        $bondg->alamat = $request->alamat;
        $bondg->keluhan = $request->keluhan;
        $bondg->perbaikan = $request->perbaikan;
        $bondg->status = "Laporan";
        $bondg->waktupengerjaan = 0;
        $bondg->save();
        return redirect('/input-bondg')->with('success', 'BON DG Berhasil Disimpan');
    }

    public function status_bondg()
    {
        $bondg = bondg::get();
        $no = 1;
        return view('admin.status-bondg', compact('bondg', 'no'));
    }

    public function filter_bondg(Request $request)
    {   
        if($request->status != 'Semua Status'){
            if($request->datefrom != NULL)
            {
                $this->validate($request, [
                    'datetill' => ['required'],
                ]);
                $bondg = bondg::where('status', '=', $request->status)
                ->where("tgldg", '<=',  $request->datetill)
                ->where("tgldg", '>=',   $request->datefrom)
                ->get();
            }
            else if ($request->datetill != NULL)
            {
                $this->validate($request, [
                    'datefrom' => ['required'],
                ]);
                $bondg = bondg::where('status', '=', $request->status)
                ->where("tgldg", "<=", $request->datetill)
                ->where("tgldg", ">=", $request->datefrom)
                ->get();
            }
            else
            {
                $bondg = bondg::where('status', '=', $request->status)->get();
            }              
        }
        else
        {
            if($request->datefrom != NULL)
            {
                $this->validate($request, [
                    'datetill' => ['required'],
                ]);
                $bondg = bondg::where("tgldg", "<=",  $request->datetill)
                ->where("tgldg", ">=", $request->datefrom)
                ->get();
            }
            else if ($request->datetill != NULL)
            {
                $this->validate($request, [
                    'datefrom' => ['required'],
                ]);
                $bondg = bondg::where("tgldg", "<=",  $request->datetill)
                ->where("tgldg", ">=",  $request->datefrom)
                ->get();
            }
            else
            {
                $bondg = bondg::all();
            }
        }   
        $no = 1;
        return view('admin.status-bondg', compact('bondg', 'no'));
    }

    public function detail_bondg(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::with('petugas')->find($id);
        return view('admin.detail-bondg', compact('bondg'));
    }

    public function hapus_bondg(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::find($id);
        $bondg->delete();
        return redirect('/bondg')->with('success', 'BON DG Berhasil Dihapus');
    }

    public function edit_bondg(Request $request, $id)
    {
        $bondg = bondg::find($id);
        $bondg->posko = $request->posko;
        $bondg->nodg = $request->nodg;
        $bondg->namapel = $request->namapel;
        $bondg->idpel = $request->idpel;
        $bondg->gardu = $request->gardu;
        $bondg->tarif = $request->tarif;
        $bondg->daya = $request->daya;
        $bondg->nohp = $request->nohp;
        $bondg->keluhan = $request->keluhan;
        $bondg->perbaikan = $request->perbaikan;
        $bondg->alamat = $request->alamat;
        $bondg->nometerlama = $request->nometerlama;
        $bondg->save();
        return redirect('/bondg')->with('success', 'BON DG Berhasil Diubah');
    }

    //ap2t
    public function showform_ap2t()
    {
        $norows = 1;
        $bondg = bondg::get();
        $count = 0;
        return view('admin.input-ap2t', compact('bondg', 'norows', 'count'));
    }

    public function search_bondg(Request $request)
    {
        $nobondg = $request->nodg;
        $bondg= bondg::where('nodg', '=', $nobondg)->get();
        $norows = count($bondg);
        $count = 1;
        return view('admin.input-ap2t', compact('bondg', 'norows', 'count'));
    }

    public function search_bondg_2(Request $request)
    {
        $nobondg = $request->nodg;
        $bondg= bondg::where('nodg', '=', $nobondg)->get();
        $norows = count($bondg);
        $petugas = user::where('role', '=', '0')->get();
        $count = 1;
        return view('admin.input-petugas', compact('bondg', 'norows', 'count', 'petugas'));
    }

    public function input_ap2t(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::find($id);
        $this->validate($request, [
            'noagenda' => ['required', 'string', 'min:18', 'max:18'],
            'nometerbaru' => ['required', 'string', 'min:11', 'max:11'],
            'noagenda' => ['required', 'unique:bondg'],            
        ]);
        $bondg->noagenda = $request->noagenda;
        $bondg->nometerbaru = $request->nometerbaru;
        $bondg->tglpk = now();
        $bondg->status = "Cetak PK";
        $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
        $bondg->save();
        return redirect('/input-ap2t')->with('success', 'AP2T Berhasil Disimpan');
    }

    //akun petugas
    public function showform_akun()
    {
        return view('admin.input-akun');
    }

    public function register_akun(Request $request)
    {
        $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:255'],
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'active' => 1,
            'remember_token' => $token,
        ]);
        return redirect('/register-akun')->with('success', 'Akun Berhasil Didaftarkan');
    }

    public function akun()
    {
        $no = 1;
        $akun = user::where('id', '!=', Auth::user()->id)->get();
        return view('admin.akun', compact('no','akun'));
    }

    public function activate_akun(Request $request)
    {
        $id = $request->id;
        $user = user::find($id);
        if ($user->active==1)
        {
            $user->active=0;
            $user->save();
            return redirect('/daftar-akun')->with('success', 'Akun berhasil dinonaktifkan');
        }
        else
        {
            $user->active= 1;
            $user->save();
            return redirect('/daftar-akun')->with('success', 'Akun berhasil diaktifkan');
        }
        
    }

    public function test()
    {
        $bondg = bondg::find(1);
        $date = Carbon::createFromDate($bondg->tglpk)->diffInDays($bondg->tgldg);
        dd($date);
    }

    public function showform_petugas()
    {
        $norows = 1;
        $bondg = bondg::get();
        $count = 0;
        $petugas = user::where('role', '=', '0')->get();
        return view('admin.input-petugas', compact('bondg', 'norows', 'count', 'petugas'));
    }

    public function tambah_petugas(Request $request)
    {
        $id = $request->id;
        $bondg = bondg::find($id);
        $bondg->id_petugas = $request->petugas;
        $bondg->status = "Pengiriman WO";
        $bondg->tglkirimpetugas = Carbon::now();
        $bondg->waktupengerjaan = Carbon::now()->diffIndays($bondg->tgldg);
        $bondg->save();
        return redirect('/input-petugas')->with('success', 'Petugas berhasil diaktifkan');
    }
}
