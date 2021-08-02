<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabir extends Model
{
    public $table = 'tabirler';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['ruya_id', 'user_id', 'tabir'];

}
