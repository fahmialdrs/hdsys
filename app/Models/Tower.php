<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    //
    protected $table = 'tower';

    protected $fillable = ['name','state','city','address','latitude','longitude','description','active'];

    public function ticket(){
   		
   		return $this->hasMany('App\Models\Ticket');
   }
}
