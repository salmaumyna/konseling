<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'nis',
        'nama',
        'tingkat',
        'nama_kelas',
        'is_active'
    ];

    /**
     * Relasi ke model Kelas (mengacu pada tabel 'class' atau 'classes')
     */
    public function kelas()
    {
        return $this->belongsTo(ClassModel::class, 'tingkat');
    }

    /**
     * Relasi ke model Major (mengacu pada tabel 'majors')
     */
    public function major()
    {
        return $this->belongsTo(Major::class, 'nama_kelas');
    }
}
