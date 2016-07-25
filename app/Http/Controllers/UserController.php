<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use Log;
use Illuminate\Support\Facades\Validator;

use App\Models\Ticket;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:manageUser', 
                ['only' => ['create', 'store','update','edit','destroy']
            ]);
        $this->middleware('verifyUser', 
                ['only' => ['editPassword','updatePassword']
            ]);
    }

    /*
        Throw JSON
        @param  Rquest  $request GET
        @return Response()->json()
    */


    public function throwUser(Request $request){
        $users = User::where('name','like','%'.$request['q'].'%')
                //->orWhere('address','like','%'.$request['term'].'%')
                ->paginate(5);
        foreach ($users as $user) {
            $result[] = ['id' => $user->id,'label' => $user->name ];
           // $result[] =  $towers->name;
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
        $user = User::with('roles')->paginate(15);
        return view('user.create')->with('data',$user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required|confirmed',
            'role'=>'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $role = Role::where('name','like',$input['role'])->first();
        //dd($input);
        //dd($role->id);
        $user->fill($input)->save();

        $user->attachRole($role->id);

        Log::info('Create User #.'.$user->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$user->toArray()
        ]);

        return redirect()->back()->withSucces("<strong>Success</strong> Create New User #".$user->name);
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
        $user = User::with('roles')->findOrFail($id);
        return view('user.update')->with('data',$user);
    }

    /**
     * Show the form for editing Password.
     *
     * @param  int  $id
     * @return Response
     */
    public function editPassword($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('user.editPassword')->with('data',$user);
    }

    public function updatePassword(Request $request, $id)
    {
         $validator = Validator::make($request->all(),[
            //'name' => 'required',
            //'email' => 'required|email',
            'password'=>'required|confirmed',
            //'role'=>'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::findOrFail($id);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user->fill($input)->save();
        return redirect()->back()->withSuccess("<strong>Success</strong> Change user Password");
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
         $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            //'password'=>'required|confirmed',
            'role'=>'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::findOrFail($id);
        $input = $request->all();
        $temp = $user;
        $role = Role::where('name','like',$input['role'])->first();

        $user->fill($input)->save();

        $user->roles()->sync([$role->id]);


        Log::info('Update User #.'.$user->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$user->toArray()
        ]);

        return redirect()->back()->withSuccess("<strong>Success</strong> Edit Task");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        $ticket = Ticket::where('assign_type','user')
                    ->where('assign_id',$id)
                    ->delete();

        Log::info('Delete User #.'.$user->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$user->toArray()
        ]);

        return redirect()->route('user::add')->withSucces("<strong>Success</strong> delete User");
    }
}
