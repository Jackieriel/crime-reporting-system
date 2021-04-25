<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //feedbacks table in database
    protected $guarded = [];
    // user who has feededback

    public function reporter()
    {
        return $this->belongsTo('App\User', 'from_user');
    }

    // returns post of any comment
    public function incident()
    {
        return $this->belongsTo('App\Models\Incident', 'on_incident');
    }
}
