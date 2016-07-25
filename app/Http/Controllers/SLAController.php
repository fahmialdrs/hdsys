<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SLARules;
use App\Models\SLA;
use App\Models\Tenant;
use Illuminate\Support\Facades\Validator;
use Log;

class SLAController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*


    */

    public function getSLARules($id){
    $sla = SLARules::where('type','like','respond')
                ->where('sla_id','=',$id)
                ->paginate(15);
        foreach ($sla as $slas) {
            $result[] = ['id' => $slas->name,'name' => $slas->name ];
        }

        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function rules($id)
    {
       $rules = SLA::with('rules','tenant')->find($id);

       return view('sla.rules')->with('data',$rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sla = SLA::with('rules')->get();
        return view('sla.index')->with('data',$sla);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tenant = Tenant::all();
        return view('sla.create')->with('tenant',$tenant);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $sla = new SLA;

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'tenant_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator,'input');
        }

        $input = $request->all();

        $sla->fill($input)->save();

        Log::info('Create SLA #.'.$sla->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$sla->toArray()
        ]);

        return redirect()->route('sla::rules',['id'=>$sla->id]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeRules(Request $request)
    {
        $slaRules = new SLARules;

        $validator = Validator::make($request->all(),[
            'type' => 'required',
            'name' => 'required',
            'min_time' => 'required',
            ]);

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator,'input');
        }

        $input = $request->all();

        $slaRules->fill($input)->save();

        Log::info('Create SLA Rules #.'.$slaRules->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$slaRules->toArray()
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $sla = SLA::with('rules')->find($id);

        $tenant = Tenant::all();
        return view('sla.edit')->with(['data'=>$sla,'tenant'=>$tenant]);
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
        $sla = SLA::find($id);
        $temp = $sla;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'tenant_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator,'input');
        }

        $sla->fill($request->all())->save();

        Log::info('Update SLA #.'.$sla->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$sla->toArray()
        ]);

        return redirect()->back()->withSuccess("Success Update SLA");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $sla = SLA::find($id);
        $sla->delete();

        Log::info('Delete SLA #.'.$sla->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$sla->toArray()
        ]);

        return redirect()->route('sla::index')->withSuccess("Success Delete SLA");
    }

    public function destroyRules($id)
    {
        
        $sla = SLARules::find($id);
        $sla->delete();

        Log::info('Delete SLA Rules #.'.$sla->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$sla->toArray()
        ]);

        return redirect()->back();
    }
}
