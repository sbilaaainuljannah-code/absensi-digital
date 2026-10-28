<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal' => 'date',
    ];

    protected $fillable = [
        'student_id',
        'tanggal',
        'waktu',
        'status',
        'qr_location_id',
        'token',
        'latitude',
        'longitude',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function qrLocation()
    {
        return $this->belongsTo(QrLocation::class);
    }
}