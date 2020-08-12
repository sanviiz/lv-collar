<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    //

    protected $table ='userinfo';
    protected $fillable = ['tokenid,dogname,name,address,tel'];
}
