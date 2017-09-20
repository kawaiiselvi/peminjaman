<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Barang extends Model
{
	public static function boot()
	{
		parent::boot();
		self::updating(function($barang)
		{
			if ($barang->amount<$barang->borrowed)
			{
				Session::flash("flash_notification", [
            	"level"=>"danger",
            	"message"=>"Jumlah Barang $barang->title Harus >= ".$barang->borrowed]);
            	return false;
			}
		});

		self::deleting(function($barang)
		{
			if ($barang->borrowLogs()->borrowed()->count()>0)
			{
				Session::flash("flash_notification", [
            	"level"=>"danger",
            	"message"=>"Barang $barang->title Sedang Dipinjam"]);
            	return false;
			}
		});
	}

	public function getBorrowedAttribute()
	{
		return $this->borrowLogs()->borrowed()->count();
	}

    protected $fillable=['title', 'amount', 'stock', 'penanggung_id',];
    public function penanggung()
    {
    	return $this->belongsTo('App\Penanggung');
    }

    public function borrowLogs()
    {
    	return $this->hasMany('App\borrowLog');
    }

    public function getStockAttribute()
    {
    	$borrowed = $this->borrowLogs()->borrowed()->count();
    	$stock = $this->stock - $borrowed;
    	return $stock;
    }
}
