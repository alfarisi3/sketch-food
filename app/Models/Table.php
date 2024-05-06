<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'total_meja'
        ];

        public function reservation()
        {
            return $this->hasMany(Reservation::class, 'table_id', 'id');
        }
}
