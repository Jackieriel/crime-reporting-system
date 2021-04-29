<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = [
        'agent_id',
        'agency_name',
        'phone',
        'website',
        'email',
        'about',
    ];

        // returns the instance of the user who is reporter of that incident
        public function agent()
        {
            return $this->belongsTo('App\User', 'agent_id');
        }
}
