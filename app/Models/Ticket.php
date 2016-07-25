<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Nicolaslopezj\Searchable\SearchableTrait;

class Ticket extends Model
{
    //
     use SearchableTrait;

     /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'title' => 10,
            'category.name' => 9,
            'tower.name' => 7,
            'mitra.name' => 5,
            'sla.name' => 2,
        ],
        'joins' => [
            'tower' => ['tower.id','ticket.tower_id'],
            'sla' => ['sla.id','ticket.sla_id'],
            'category' => ['category.id','ticket.category_id'],
            'mitra' => ['mitra.id','ticket.mitra_id'],
        ],
    ];
    protected $table = 'ticket';

     protected $guarded = ['_token'];

     protected $dates = array('respond_at','recover_at','resolve_at','close_at');

    public function tower(){
    	return $this->belongsTo('App\Models\Tower');
    }

    public function sla(){
    	return $this->belongsTo('App\Models\SLA');
    }

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }
     public function mitra(){
    	return $this->belongsTo('App\Models\Mitra');
    }

    public function assign()
    {
      /*
         Polymorphic Relation

         Biar bisa assign task ke team atau user
   
      */
        return $this->morphTo();
    }

//    public function pic_status()
  //  {
	//      
//    }

}
