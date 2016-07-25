<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
    protected $table = 'sla';

    protected $fillable = ['name','description','tenant_id'];

    public $timestamps = false;

    public function rules(){
    	return $this->hasMany('App\Models\SLARules','sla_id');
    }

    public function tenant(){
    	return $this->belongsTo('App\Models\Tenant');
    }
}
