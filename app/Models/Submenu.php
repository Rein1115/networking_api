<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Submenu extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'transNo',
        'description',
        'icon',
        'class',
        'routes',
        'sort',
        'created_by'
    ];
}
