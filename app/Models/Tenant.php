<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenant';

    protected $fillable = ['name', 'description'];

    public function mitra(){
    	return $this->hasMany('App\Models\Mitra');
    }
}
