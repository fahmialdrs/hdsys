<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Log;
use App\Models\Team;
use App\Models\Ticket;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
        Display list Team for select2

    */
        public function throwTeam(Request $request){
            $teams = Team::where('name','like','%'.$request['q'].'%')
                ->paginate(5);
            foreach ($teams as $team) {
                $result[] = ['id' => $team->id,'label' => $team->name ];
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
        $task = Team::orderBy('created_at', 'desc')->paginate(15);
       
        /*foreach ($task as $tasks) {
            echo $tasks->towers->name;
        }*/

        return view('team.index')->with('data',$task );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('team.create');
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
        $input = $request->all();
        $table = new Team;
        $table->fill($input);
        $table->save();
        $table->attachUsers($input['member']);

        Log::info('Create Team #.'.$table->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$table->toArray()
        ]);

        return redirect('team/create')
            ->withSuccess("Success Create New Team");
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

        $team = Team::with('user')->find($id);
        return view('team.view')->with('data',$team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //

        $team = Team::with('user')->find($id);
        return view('team.edit')->with('data',$team);
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
        //
        $team = Team::findOrFail($id);
        $input = $request->all();
        //dd($input['member']);
        
        $temp = $team;
        $team->fill($input)->save();

        $team->syncUser($input['member']);


        Log::info('Update Team #.'.$team->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$team->toArray()
        ]);

       return redirect()->back()->withSuccess("Success Edit Team");
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
        $team = Team::findOrFail($id);

        $team->delete();

        $ticket = Ticket::where('assign_type','team')
                    ->where('assign_id',$id)
                    ->delete();

        Log::info('Delete Team #.'.$team->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$team->toArray()
        ]);
        return redirect()->route('team::index')->withSuccess("Success Delete Task");
    }
}
