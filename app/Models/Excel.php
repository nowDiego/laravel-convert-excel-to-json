<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excel extends Model
{
    use HasFactory;

    protected $table = 'excel';
    public $timestamps = false;

    
    protected $fillable = [
        'row',               
    ];


    protected $hidden = [
        'id',     
    ];
}
