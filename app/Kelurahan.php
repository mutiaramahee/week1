<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $fillable = ['id', 'name', 'kecamatan_id'];
    public $timestamps = false;
}
