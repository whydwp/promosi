<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'image',
        'branch',
        'regional',
        'status'
    ];

    protected $casts = [
        'image' => 'array',
    ];

    // Define accessor for status attribute
    public function getStatusAttribute()
    {
        $now = now();

        if ($this->end_date < $now) {
            return 'Expired';
        } {
            return 'Published';
        }
    }
}
