<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tower;
use App\Models\Role;
use yajra\Datatables\Datatables;
use App\User;
use Session, Auth;
class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function __construct()

     {
       $this->middleware('auth');
     }

    public function index()
    {
        return view('Towers.index');

    }

    public function getTowers(Request $request){
            $teams = Tower::where('name','like','%'.$request['q'].'%')
                ->paginate(5);
            foreach ($teams as $team) {
                $result[] = ['id' => $team->id,'name' => $team->name ];
            }

            return response()->json($result);
        }

    public function getIndexData(){
      //$mitraid = Auth::user()->mitra_id;
      $towers = Tower::all();
      return Datatables::of($towers)
      ->addColumn('action', function ($towers) {
        $url = 'admin/towers' . '/' . $towers->id;
                return '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button><ul class="dropdown-menu pull-right">
                        <li><a href="/towers/view/'.$towers->id.'">View</a></li>
                        <li><a href="/towers/edit/'.$towers->id.'">Edit</a></li>
                        <li><a href="/towers/delete/' .$towers->id. '">Delete</a></li>
                        </ul>
                        </div>';
      })
      ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      return view('Towers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      //$id = Auth::user()->mitra_id;
      $tower = new Tower;
      //$tower->mitra_id         = $id;
      $tower->name             = $request['name'];
      $tower->site_name        = $request['sitename'];
      $tower->state            = $request['state'];
      $tower->city             = $request['city'];
      $tower->address          = $request['address'];
      $tower->latitude         = $request['latitude'];
      $tower->longitude        = $request['longitude'];
      $tower->description      = $request['description'];
      $tower->active           = 1;
      $tower->save();

      Session::flash('pesan', 'Berhasil disimpan!');
      Return redirect('/towers/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //$mitraid = Auth::user()->mitra_id;
        //$towermitra = Tower::find($id)->mitra_id;
        //if($mitraid == $towermitra){
          $tower = Tower::find($id);
          return view('Towers.show')->with('tower', $tower);
        //}else{
         // return redirect('/towers/index');
      //}
      // dd($towermitra);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $towers = Tower::find($id);
        return view('Towers.edit')->with('towers', $towers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      // - Data belum divalidasi
      //$mitraid = Auth::user()->mitra_id;
      $tower = Tower::find($id);
      //$tower->mitra_id         = $mitraid;
      $tower->name             = $request['name'];
      $tower->site_name        = $request['sitename'];
      $tower->state            = $request['state'];
      $tower->city             = $request['city'];
      $tower->address          = $request['address'];
      $tower->latitude         = $request['latitude'];
      $tower->longitude        = $request['longitude'];
      $tower->description      = $request['description'];
      $tower->active           = 1;
      $tower->save();

      Session::flash('pesan', 'Berhasil disimpan!');
      Return redirect('/towers/index');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        //$mitraid = Auth::user()->mitra_id;
        //$towermitra = Tower::find($id)->mitra_id;
        //dd($towermitra);
        //if($mitraid == $towermitra){
          Tower::find($id)->delete();
          return redirect('/towers/index');
        //}else{
          //return redirect('/towers/index');
      //}
    }
}
