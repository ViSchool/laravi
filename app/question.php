<?php

namespace App;
use App\Content;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    public function content()
	{
		return $this->belongsTo('App\Content');
	}
}
