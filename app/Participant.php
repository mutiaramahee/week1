<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;
    protected $table = 'participant';
    protected $fillable = ['id', 
    					   'created_at', 
    					   'updated_at',
    					   'deleted_at',
    					   'image',
    					   'name', 
    					   'email',
    					   'phone',
    					   'provinsi_id',
    					   'kabupaten_kota_id',
    					   'kecamatan_id', 
    					   'kelurahan_id'
    					   ];
    protected $dates = ['deleted_at'];
}
