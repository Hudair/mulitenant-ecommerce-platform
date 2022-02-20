<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
	public $timestamps = false;

	public function price()
	{
		return	$this->hasOne('App\Attributeprice');
	}

	public function stock()
	{
		return	$this->hasOne('App\Stock');
	}

	public function product()
	{
		return $this->belongsTo('App\Term','term_id','id')->select('id','title')->with('preview');
	}

	public function term()
	{
		return $this->belongsTo('App\Term','term_id','id')->with('preview');
	}

	public function attribute()
	{
		return $this->belongsTo('App\Category','category_id','id')->select('id','name');
	}

	public function variation()
	{
		return $this->belongsTo('App\Category','variation_id','id')->select('id','name');
	}

	public function files(){
		return $this->hasOne('App\File','attribute_id','id'); 
	}
}
