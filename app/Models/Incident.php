<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'id',
        'phone',
        'address',
        'body',
        'prescription',
        'status',
        'user_id'
    ];

    // INcidents has many feedbacks
    // returns all comments on that post
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Incident', 'on_incident');
    }

    // returns the instance of the user who is reporter of that incident
    public function reporter()
    {
        return $this->belongsTo('App\User', 'reporter_id');
    }

    public function crimecategory()
    {
        return $this->belongsTo('App\Models\CrimeCategory');
    }
}
