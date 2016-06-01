<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model {
	
	public function faq()
	{		
		return $this->hasMany('App\FAQ');
	}
	
}