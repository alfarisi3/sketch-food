<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'picture_2nd',
        'picture_3rd',
        'title',
        'title_2nd',
        'description',
        'description_2nd',
        'status'
    ];
}
