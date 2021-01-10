<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $fillable = ['id', 'name', 'kabupaten_kota_id'];
    public $timestamps = false;
}
