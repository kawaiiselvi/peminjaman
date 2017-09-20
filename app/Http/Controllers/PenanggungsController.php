<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penanggung;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class PenanggungsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $penanggungs = Penanggung::select(['id','name']);
            return Datatables::of($penanggungs)
            ->addColumn('action',function($penanggungs){
                return view('datatable._action', [
                    'model'     => $penanggungs,
                    'form_url'  => route('penanggungs.destroy',$penanggungs->id),
                    'edit_url'  => route('penanggungs.edit',$penanggungs->id),
                    'confirm_message' => 'Yakin Ingin Menghapus ' . $penanggungs->name . ' ?' ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'name','name'=>'name','title'=>'Nama'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('penanggungs.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penanggungs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required|unique:penanggungs']);
        $penanggung = Penanggung::create($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan $penanggung->name"]);
        return redirect()->route('penanggungs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penanggung=Penanggung::find($id);
        return view('penanggungs.edit')->with(compact('penanggung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name'=>'required|unique:penanggungs,name,'.$id]);
        $penanggung = Penanggung::find($id);
        $penanggung->update($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan $penanggung->name"]);
        return redirect()->route('penanggungs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Penanggung::destroy($id))  return redirect()->back();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Penulis Berhasil Dihapus"]);
        return redirect()->route('penanggungs.index');
    }
}
