<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;
    protected $table = 'job_history';

    protected $fillable = [
        'id_biodata', 'nama_perusahaan', 'posisi', 'tahun_mulai', 'tahun_selesai'
    ];

    // Relasi ke Biodata
    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'id_biodata');
    }

}
