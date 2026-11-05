<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
  protected $fillable = [
    'naam',
    'beschrijving',
    'datum',
    'begintijd',
    'eindtijd',
    'locatie',
    'max_deelnemers',
    'begeleider_id',
];

public function begeleider()
{
    return $this->belongsTo(User::class, 'begeleider_id');
}
public function enrollments()
{
    return $this->hasMany(Enrollment::class);
}
}
