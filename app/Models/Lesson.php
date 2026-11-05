<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        
    'naam',
    'datum',
    'begintijd',
    'eindtijd',
    'begeleider_id',
    
];
public function begeleider()
{
    return $this->belongsTo(User::class, 'begeleider_id');
}
}
