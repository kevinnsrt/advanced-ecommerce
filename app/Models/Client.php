<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password'
    ];

    protected $table = "clients";

    protected $hidden = [
        'password',
    ];
    public $timestamps = false;
}
