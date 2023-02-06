<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function problems()
    {
        return $this->belongsToMany(Problem::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
