<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    /**
     * ✍️ Kolom yang boleh diisi secara massal (mass assignment)
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'description',
    ];
}