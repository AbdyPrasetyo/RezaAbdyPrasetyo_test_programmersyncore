<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';

    protected $fillable = [
        'id_biodata', 'tingkat_pendidikan', 'nama_institusi', 'tahun_lulus'
    ];

    // Relasi ke Biodata
    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'id_biodata');
    }


}
