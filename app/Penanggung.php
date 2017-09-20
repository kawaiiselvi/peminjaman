<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Penanggung extends Model
{
    protected $fillable=['name'];
    public function barangs()
    {
    	return $this->hasMany('App\Barang');
    }

    public static function boot()
    {
    	parent::boot();
    	self::deleting(function($penanggung) 
    	{
    		if ($penanggung->barangs->count()>0) 
    		{
    			$html = 'Penulis Tidak Bisa Dihapus Karena Masih Mempunyai Buku : ';
    			$html .= '<ul>';
    			foreach ($penanggung->barangs as $barang) 
    			{
    				$html .= "<li>$barang->title</li>";
    			}
    			$html .= '</ul>';

    			Session::flash("flash_notification", [
    				"level"=>"danger",
    				"message"=>$html]);
    			return false;
    		}
    	});
    }
}
