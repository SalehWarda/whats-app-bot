<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'list_ansr_id'
    ];

    public function rows()
    {
        return $this->hasMany(row::class);
    }
}
