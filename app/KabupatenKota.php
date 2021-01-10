<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    protected $table = 'kabupaten_kota';
    protected $fillable = ['id', 'name', 'provinsi_id'];
    public $timestamps = false;
}
