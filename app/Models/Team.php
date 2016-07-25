<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //

    protected $with = ['user']; 

    protected $table = 'team';

    protected $guarded = ['_token','member'];

    protected $morphClass = 'team';

    public function user(){
   		/*
   		*	Relation to task History table
   		*	Task one to many Task History
   		*/

   		return $this->belongsToMany('App\User','team_user','team_id','user_id');
   }

   public function ticket()
    {
    	/*
			Reversing Polymorphic Relation

			Biar bisa assign task ke team atau user
	
    	*/
        return $this->morphMany('App\Models\Ticket', 'assign');
    }

    /*
        Sync user (insert/delete) to pivot table 

      @param $user array of id [1,2,3]
    
    */
    public function syncUser($user){
        $this->user()->sync($user);
    }

    /*
        Attach user to pivot table 

      @param $userId
    
    */
    public function attachUser($userId){
        $this->user()->attach($userId);
    }

    /*
        Attach user to pivot table 

      @param $userId
    
    */
    public function detachUser($userId){
        $this->user()->detach($userId);
    }

    /*
        Attach multiple user to pivot table 

      @param array $user
    
    */
     public function attachUsers($users)
    {
        foreach ($users as $user) {
            $this->attachUser($user);
        }
    }

    /*
        Attach multiple user to pivot table 

      @param array $user
    
    */
     public function detachUsers($users)
    {
        foreach ($users as $user) {
            $this->detachUser($user);
        }
    }
}
