<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $table = 'training';

    // Mass assignable attributes
    protected $fillable = [
        'id_biodata',
        'nama_pelatihan',
        'penyelenggara',
        'tanggal_pelatihan'
    ];

    /**
     * Get the biodata that owns the training.
     */
    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'id_biodata');
    }


}
