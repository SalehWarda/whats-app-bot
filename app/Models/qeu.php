<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qeu extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'header',
        'body',
        'footer',
        'frist',
    ];

    public function buttons()
    {
        return $this->hasMany(button::class);
    }
    public function lsits()
    {
        return $this->hasMany(list_ansr::class);
    }

}
