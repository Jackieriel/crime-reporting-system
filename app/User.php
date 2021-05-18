<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone', 'photo', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // user has many posts
    public function incidents()
    {
        return $this->hasMany('App\Models\Incident', 'reporter_id');
    }


        // user has many Agent
        public function agency()
        {
            return $this->hasMany('App\Models\Agency', 'agent_id');
        }

        
    // user has many comments
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback', 'from_user');
    }

    public function can_report()
    {
        $role = $this->role;
        if ($role == 'reporter' || $role == 'otherAgency' || 'securityAgency') {
            return true;
        }
        return false;
    }

    public function is_reporter()
    {
        $role = $this->role;
        if ($role == 'reporter') {
            return true;
        }
        return false;
    }

    public function is_super_admin()
    {
        $role = $this->role;
        if ($role == 'superAdmin') {
            return true;
        }
        return false;
    }

    public function is_security_agency()
    {
        $role = $this->role;
        if ($role == 'securityAgency') {
            return true;
        }
        return false;
    }

    public function is_other_agency()
    {
        $role = $this->role;
        if ($role == 'otherAgency') {
            return true;
        }
        return false;
    }
}
