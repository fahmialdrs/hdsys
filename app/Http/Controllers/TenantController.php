<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Tenant;

use Illuminate\Support\Facades\Validator;

use Log;
class TenantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        $tenant = Tenant::paginate(15);
        return view('tenant.create')->with('data',$tenant);
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
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $tenant = new Tenant;
        $input = $request->all();

        $tenant->fill($input)->save();

        Log::info('Create Tenant #.'.$tenant->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$tenant->toArray()
        ]);

        return redirect()->back()->withSucces("<strong>Success</strong> Create New Tenant");
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
        $tenants = Tenant::paginate(15);
        $tenant = Tenant::findOrFail($id);
        return view('tenant.edit')->with(['datas' => $tenants, 'data' => $tenant ]);
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
        $tenant = Tenant::findOrFail($id);
        $input = $request->all();
        $temp = $tenant;
        $tenant->fill($input)->save();

        Log::info('Update Tenant #.'.$tenant->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$tenant->toArray()
        ]);

        return redirect()->back()->withSucces("<strong>Success</strong> Edit Category #".$tenant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $tenant = Tenant::find($id);
        $tenant->delete();

        Log::info('Delete Tenant #.'.$tenant->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$tenant->toArray()
        ]);
        return redirect()->route('tenant::add')->withSucces("<strong>Success Delete</strong> Tenant");
    }
}
