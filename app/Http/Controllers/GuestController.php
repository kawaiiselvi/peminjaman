<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Barang;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
    	if ($request->ajax()){
            $barangs = Barang::with(['penanggung']);
            return Datatables::of($barangs)
            ->addColumn('stock',function($barang){
                return $barang->stock;
            })
            ->addColumn('action',function($barang){
                if(Laratrust::hasRole('admin')) return '';
                return '<a class="btn btn-xs btn-primary" href="'.route('guest.barangs.borrow',$barang->id).'">Pinjam</a>';
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Nama Barang'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok','orderable'=>false,'searchable'=>false])
        ->addColumn(['data'=>'author.name','name'=>'author.name','title'=>'Penulis'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('guest.index')->with(compact('html'));
    }
}
