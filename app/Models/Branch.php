<?php
// app/Models/Branch.php

namespace App\Models;
use App\Models\Regional;


use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'region_id','name_regions'];

    public function region()
    {
        return $this->belongsTo(Regional::class);
    }
}
