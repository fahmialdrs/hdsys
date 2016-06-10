<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class SLARules extends Model
{
    protected $table = 'sla_rules';

    protected $fillable = ['name','min_time','sla_id','type'];


    public $timestamps = false;

    public function sla(){
    	return $this->belongsTo('App\Models\SLA');
    }

    public function getMinTimeAttribute($value)
	{
		//list($hours, $minutes, $seconds) = explode(':', $value);
	    return Carbon::parse($value); 
	}
}
