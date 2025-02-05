<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'majors'; // Nama tabel di database
    protected $fillable = [
        'name', // Nama jurusan
        'is_active'
    ];

    // Relasi ke model Student
    public function students()
    {
        return $this->hasMany(Student::class, 'major_id');
    }

    // Relasi ke model CounselingReport
    public function counselingReports()
    {
        return $this->hasMany(CounselingReport::class, 'major_id');
    }
}
