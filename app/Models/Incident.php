<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'phone',
        'address',
        'body',
        'description',
        'status',
        'progress_remark'    ,
        'crime_category_id',
        'reporter_id',
        'lga',
        'video',
        'photo',
    ];

    // INcidents has many feedbacks
    // returns all comments on that post
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback', 'on_incident');
    }

    // returns the instance of the user who is reporter of that incident
    public function reporter()
    {
        return $this->belongsTo('App\User', 'reporter_id');
    }

    public function crimecategory()
    {
        return $this->belongsTo('App\Models\CrimeCategory', 'crime_category_id');
    }
}
