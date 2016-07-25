<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SLA;
use App\Models\Category;
use App\Models\Ticket;
use Auth;
use Carbon\Carbon;
use PDF;
use Log;
use Mail;
use Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Excel;
class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generatePDF($id){
        $data = Ticket::with('sla.tenant','tower','mitra','category','sla.rules','assign','assign.user')->find($id);
        $pdf = PDF::loadView('letter.permit',array('data'=>$data));
        $filename = $data->tower->name.' '.$data->created_at->format('Y-m-d').' '.str_random(5).'.pdf';
        return $pdf->stream($filename);
    }

    public function export(){
        $ticket = Ticket::with('sla.tenant','tower','mitra','category','sla.rules','assign','assign.user')->get();
        Excel::create('ExportHelpdesk-'.Carbon::now(), function($excel) use ($ticket) {

            $excel->sheet('ticket', function($sheet) use ($ticket) {

                $sheet->loadView('ticket.xls')->with('data',$ticket);

            });

        })->download('xls');
        return redirect()->route('ticket::index')->withSuccess('Success Create xls files, please download to open');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ticket = Ticket::with('sla.tenant','sla.rules','tower','mitra','user','category')->paginate(15);
        return view('ticket.index')->with('data',$ticket);
    }

     public function search(Request $request)
    {
        $input = $request->all();
        //dd($input);
        $ticket = Ticket::search($input['search'],9)->with('sla','tower','mitra','category')->get();

        $limit = 10;
        $page = $request->has('page') ? $request->page - 1 : 0;
        $total = $ticket->count();
        $result = $ticket->slice($page * $limit, $limit);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($result, $total, $limit);
        $result->setPath('/ticket/search')->appends(['search' => $input['search']]);
        //dd($ticket);
        return view('ticket.index')->with('data',$result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexByStatus($status)
    {
        $ticket = Ticket::with('sla.tenant','sla.rules','tower','mitra','category')
                    ->where('status','like',$status)
                    ->paginate(15);
        return view('ticket.index')->with('data',$ticket);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sla = SLA::all();
        $category = Category::all();

        return view('ticket.create')->with(['sla'=>$sla,'category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $ticket = New Ticket;

        $validator = Validator::make($request->all(),[
            'tower_id' => 'required|integer',
            'full_name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'assign_type' => 'required',
            'assign_id' => 'required|integer',
            'severity' => 'required',
            'priority' => 'required',
            'sla_id' => 'required|integer',
            'category_id' => 'required|integer',
            'mitra_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator,'input');
        }

        $input = $request->all();
        $input['status'] = 'open';
        $input['user_id'] = Auth::user()->id;
        //dd($input);
	$ticket->pic_status = 'Not Respond';
        $ticket->fill($input)->save();

        /*
            Save PDF to storage
         */
        $data = Ticket::with('sla.tenant','tower','mitra','category','sla.rules','assign','assign.user')->find($ticket->id);
        $pdf = PDF::loadView('letter.permit',array('data'=>$data));
        $filename = $data->tower->name.' '.$data->created_at->format('Y-m-d').' '.str_random(5).'.pdf';
        //$storage = Storage::put('pdf/'.$filename, $pdf->output());

        /*

            Email Report to Mitra
         */
        $mail = Ticket::with('tower','category','mitra','assign')->findOrFail($ticket->id);
        Mail::send('emails.mitra', ['data' => $mail], function ($m) use ($mail) {
            $m->to($mail->mitra->email, $mail->mitra->name)->subject('Centratama: Penugasan '.$mail->mitra->name);
            //$m->to('foo@example.com');
            //$m->cc('bar@example.com');
        });

        /*

            Email to PIC
         */
        if($ticket->assign_type == 'team'){
            //dd($mail->assign->user->name);
            foreach ($mail->assign->user as $user) {
                Mail::send('emails.pic', ['data' => $mail,'user'=>$user], function ($m) use ($user,$pdf,$filename) {
                    $m->to($user->email, $user->name)->subject('Centratama: Penugasan PIC '.$user->name);
                    //$m->to('foo@example.com');
                    //$m->cc('bar@example.com');
                    $m->attachData($pdf->output(),$filename);
                });
            }
        }
        else{
            Mail::send('emails.pic', ['data' => $mail], function ($m) use ($mail,$pdf,$filename) {
                    $m->to($mail->assign->email, $mail->assign->name)->subject('Centratama: Penugasan PIC '.$mail->assign->name);
                    //$m->to('foo@example.com');
                    //$m->cc('bar@example.com');
                    $m->attachData($pdf->output(),$filename);
                });
        }

        Log::info('Create Ticket #.'.$ticket->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$ticket->toArray()
        ]);
        return redirect()->back()->withSuccess('Success Create New Ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('sla.tenant','tower','mitra','category','sla.rules')->find($id);
        return view('ticket.view')->with('data',$ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ticket = Ticket::with('tower','assign','mitra')->find($id);
        $sla = SLA::all();
        $category = Category::all();
        return view('ticket.edit')->with(['data'=>$ticket, 'sla'=>$sla,'category'=>$category]);
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
        $ticket = Ticket::find($id);
        $temp = $ticket;

        $validator = Validator::make($request->all(),[
            'tower_id' => 'required|integer',
            'full_name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'assign_type' => 'required',
            'assign_id' => 'required|integer',
            'severity' => 'required',
            'priority' => 'required',
            'sla_id' => 'required|integer',
            'category_id' => 'required|integer',
            'mitra_id' => 'required|integer',
            ]);

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator,'input');
        }

        $input = $request->all();
        $ticket->fill($input)->save();

        Log::info('Update Ticket #.'.$ticket->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$ticket->toArray()
        ]);

        return redirect()->back()->withSuccess('Success Update Ticket');
        //dd($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->back()->withSuccess('Success Delete Ticket');
    }

    public function changeStatus($id,$status){
        $ticket = Ticket::find($id);
        $temp = $ticket;
        $ticket->status = $status;
        if ($status == 'respond') {
             $ticket->respond_at = Carbon::now();
        }elseif ($status == 'recover') {
            $ticket->recover_at = Carbon::now();
        }elseif ($status == 'resolve') {
            $ticket->resolve_at = Carbon::now();
        }elseif ($status == 'close') {
            $ticket->close_at = Carbon::now();
        }elseif ($status == 'open') {
            $ticket->close_at = null;
            $ticket->resolve_at = null;
            $ticket->recover_at = null;
            $ticket->respond_at = null;
            $ticket->created_at = Carbon::now();
        }
        $ticket->save();
        Log::info('Update Ticket status #.'.$ticket->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$ticket->toArray()
        ]);
        return redirect()->back()->withSuccess('Success Update Ticket Status');
    }
    public function picStatusRespond($id)
    {
      $ticket = Ticket::find($id);
      $temp = $ticket;
      $ticket->pic_status = 'Respond';

      $ticket->save();
      Log::info('Update Ticket PIC status #.'.$ticket->id.' Stack trace:',[
          'from'=>$temp->toArray(),
          'to'=>$ticket->toArray()
      ]);
      return 'Status Ticket = Respond';
    }
    public function picStatusRecover($id)
    {
      $ticket = Ticket::find($id);
      $temp = $ticket;
      $ticket->pic_status = 'Recover';

      $ticket->save();
      Log::info('Update Ticket PIC status #.'.$ticket->id.' Stack trace:',[
          'from'=>$temp->toArray(),
          'to'=>$ticket->toArray()
      ]);
      return 'Status Ticket = Recover';
    }
    public function picStatusResolve($id)
    {
      $ticket = Ticket::find($id);
      $temp = $ticket;
      $ticket->pic_status = 'Resolve';

      $ticket->save();
      Log::info('Update Ticket PIC status #.'.$ticket->id.' Stack trace:',[
          'from'=>$temp->toArray(),
          'to'=>$ticket->toArray()
      ]);
      return 'Status Ticket = Resolve';
    }
    public function picStatusClose($id)
    {
      $ticket = Ticket::find($id);
      $temp = $ticket;
      $ticket->pic_status = 'Close';

      $ticket->save();
      Log::info('Update Ticket PIC status #.'.$ticket->id.' Stack trace:',[
          'from'=>$temp->toArray(),
          'to'=>$ticket->toArray()
      ]);
      return 'Status Ticket = Close';
    }
}
