<?php

namespace Petrik\Rajzfilmek;

//composer require illuminate/database

use Exception;
use Illuminate\Database\Eloquent\Model;

class Nevek extends Model {
    protected $table = 'nevek'; //adatbázisban a táblanév
    public $timestamps = false;
    
    //protected $fillable = ['cim', 'hossz', 'kiadasi_ev'];
    protected $guarded = ['id'];
}