<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class row extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ansr_id',
        'title_id'
    ];

}
