<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Zizaco\Entrust\HasRole;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use EntrustUserTrait;
    // use HasRole;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    
    public function profile(){
        /*
        Profile Relation
        one to One
    */
      return $this->hasOne('App\Models\Profile', 'user_id');
    }

    public function team(){
        /*
        *   Relation to team table
        *   Uset many to many team
        *   via team_user
        */

        return $this->belongsToMany('App\Models\Team','team_user','user_id','team_id');
   }
   public function ticket()
    {
        /*
            Reversing Polymorphic Relation

            Biar bisa assign task ke team atau user
    
        */
        return $this->morphMany('App\Models\Ticket', 'assign');
    }
}
