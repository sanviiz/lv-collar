<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logdata extends Model
{
    //
    protected $table = 'logdatas';
    protected $primaryKey = 'logid';
    protected $fillable = ['userid','deviceid','latitude','longtitude'];
    
}
