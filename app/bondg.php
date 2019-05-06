<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bondg extends Model
{
    protected $table = 'bondg';
    protected $primaryKey = 'nodg';
    protected $fillable = [
        'posko', 'nodg', 'namapel', 'idpel', 'nohp', 
        'gardu', 'tarif', 'daya', 'noagenda', 'nometerlama', 'nometerbaru', 'tgldg', 'tglpk', 'tglkirimpetugas',
        'tglterpasang', 'tglremaja', 'tglbatal', 'status', 'alamat', 'keluhan', 'perbaikan', 'id_petugas', 'waktupengerjaan',
        'cancel_1', 'cancel_2', 'filename_kwhlama', 'filename_kwhbaru', 'filename_ba', 
    ];

    public function petugas(){
        return $this->belongsTo(user::class, 'id_petugas', 'id');
    }
}
