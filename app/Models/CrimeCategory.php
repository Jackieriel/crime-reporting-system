<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrimeCategory extends Model
{
    protected $fillable = ['category_name'];

    public function incidents()
    {
        return $this->hasMany('App\Models\Incident');
    }
}
