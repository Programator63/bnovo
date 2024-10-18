<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;

    // Указываем, какие поля могут быть массово присвоены
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
    ];

    // Указываем, какие поля должны быть скрыты при сериализации
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
