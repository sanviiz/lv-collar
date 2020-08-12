<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safezone extends Model
{
    //
    protected $table = 'safezone';
    protected $fillable = ['safezonename','userid','radius','lat','lng'];
    protected $primaryKey = 'id';
}
