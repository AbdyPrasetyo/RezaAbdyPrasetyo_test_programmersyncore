<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biodata extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_biodata';
    protected $table = 'biodata';  // Pastikan nama tabel sesuai yang digunakan dalam migration

    protected $fillable = [
        'user_id', 'nama', 'tanggal_lahir', 'tempat_lahir', 'posisi_dilamar'
    ];



    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Education
    public function education()
    {
        return $this->hasMany(Education::class, 'id_biodata');
    }

    // Relasi ke JobHistory
    public function jobHistory()
    {
        return $this->hasMany(JobHistory::class, 'id_biodata');
    }

    public function training()
    {
        return $this->hasMany(Training::class, 'id_biodata');
    }
}
