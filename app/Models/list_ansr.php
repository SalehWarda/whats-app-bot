<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_ansr extends Model
{
    use HasFactory;

    protected $fillable = [
        'button',
        'qeus_id'
    ];

    public function titles()
    {
        return $this->hasMany(title::class);
    }
}
