<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Mitra;
use Illuminate\Support\Facades\Validator;

use Log;
class MitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*


    */

    public function getMitra(Request $request){
    $mitra = Mitra::where('name','like','%'.$request['q'].'%')
                //->where('sla_id','=',$id)
                ->paginate(15);
        foreach ($mitra as $data) {
            $result[] = ['id' => $data->id,'name' => $data->name ];
        }

        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $mitra = Mitra::paginate(15);
        return view('mitra.create')->with('data',$mitra);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mitra = new Mitra;
        $input = $request->all();

        $mitra->fill($input)->save();

        Log::info('Create Mitra #.'.$mitra->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$mitra->toArray()
        ]);

        return redirect()->back()->withSucces("<strong>Success</strong> Create New Mitra");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $mitras = Mitra::paginate(15);
        $mitra = Mitra::findOrFail($id);
        return view('mitra.edit')->with(['datas' => $mitras, 'data' => $mitra ]);
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
        $mitra = Mitra::findOrFail($id);
        $input = $request->all();
        $temp = $mitra;
        $mitra->fill($input)->save();

        Log::info('Update Mitra #.'.$mitra->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$mitra->toArray()
        ]);

        return redirect()->back()->withSucces("<strong>Success</strong> Edit Category #".$mitra->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $mitra = Mitra::find($id);
        $mitra->delete();

        Log::info('Delete Mitra #.'.$mitra->id.' Stack trace:',[
          //  'from'=>$temp->toArray(),
            'to'=>$mitra->toArray()
        ]);
        return redirect()->route('mitra::add')->withSucces("<strong>Success Delete</strong> Mitra");
    }
}
