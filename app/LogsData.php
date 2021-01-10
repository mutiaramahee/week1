<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogsData extends Model
{
    protected $table = 'logs';
    protected $fillable = ['id', 'created_at', 'updated_at', 'user_id', 'url', 'data'];
}
