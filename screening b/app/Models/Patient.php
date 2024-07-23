<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasien', 'alamat', 'telepon', 'id_rumah_sakit'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rumah_sakit');
    }
}
