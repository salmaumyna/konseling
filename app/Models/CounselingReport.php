<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingReport extends Model
{
    use HasFactory;

    protected $table = 'counseling_reports';

    protected $fillable = [
        'student_id',
        'class_id',
        'major_id',
        'teacher_id',
        'date', 
        'description', 
        'reason', 
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relasi ke tabel users (guru BK)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
