<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_date', 'end_date', 'regional_category', 'branch_name'];

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}
