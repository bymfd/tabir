<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Ruya extends Model
{
   use HasFactory, Notifiable,HasApiTokens;
    public $table = 'ruya';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'his',
        'ruya_metin',
        'tarih',
        'user_id',

    ];


}
