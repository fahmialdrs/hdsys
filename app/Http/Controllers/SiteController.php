<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Permission;
use App\User;
use App\Models\Ticket;
use Carbon\Carbon;
use DB;
use Mail;
use Storage;
use Artisan;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Http\Response;
class SiteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'dashboard']);
    }

    public function backup(){

        $files = Storage::files('backups');
        //dd($files);
        foreach ($files as $file => $value) {
            $data[] = ['name' => substr($value, 8), 'size' => Storage::size($value),];
        }
        //dd($data);
        return view('site.backup')->with('files',$data);
    }

    public function doBackup(){
        Artisan::call('db:backup');

        return redirect()->route('setting::backup')->withSuccess('Success create new backup, check table below');
    }

    public function restoreLastBackup(){
        Artisan::call('db:restore',['--last-dump']);

        return redirect()->route('setting::backup')->withSuccess('Success Restore Last Backup');
    }
    public function restore($name){
        Artisan::call('db:restore '.$name);

        return redirect()->route('setting::backup')->withSuccess('Success Restore');
    }

    public function deleteFile($name){
        Storage::delete('backups/'.$name);

        return redirect()->route('setting::backup')->withSuccess('File Deleted');
    }

    public function download($name){
        $file = Storage::disk('local')->get('backups/'.$name);
        //dd($file);
        return (new Response($file, 200))
              ->header('Content-Type', 'application/octet-stream');
    }

    public function ticketByMonth(){
        $ticket = Ticket::groupBy('date')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                DB::raw('Month(created_at) as date'),
                                DB::raw('COUNT(*) as "views"')
                            ));
        foreach ($ticket as $tickets) {
           $result[] = array('date'=>Carbon::createFromFormat('m Y',$tickets->date.' '.Carbon::now()->year)->format('M Y'), 'views'=>$tickets['views']);
        }
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function dashboard()
    {
        $mostTroubleTower = Ticket::with('tower')
                ->select(['tower_id',DB::raw('COUNT(*) as "count"')])
                ->groupBy('tower_id')
                ->orderBy('count', 'DESC')
                ->paginate(20);

        $open = Ticket::where('status','like','open')->get();
        $respond = Ticket::where('status','like','respond')->get();
        $resolve = Ticket::where('status','like','resolve')->get();
        $recover = Ticket::where('status','like','recover')->get();
        $close = Ticket::where('status','like','close')->get();
        //dd($ticket);
       return view('site.dashboard')->with([
            'mostTroubleTower'=>$mostTroubleTower,
            'open'=>$open,
            'respond'=>$respond,
            'resolve'=>$resolve,
            'recover'=>$recover,
            'close'=>$close,

        ]);
    }

    public function sendEmail($id)
    {
        $ticket = Ticket::with('tower','category','mitra')->findOrFail($id);

        Mail::send('emails.mitra', ['data' => $ticket], function ($m) use ($ticket) {
            $m->to($ticket->mitra->email, $ticket->mitra->name)->subject('Penugasan');
            $m->to('foo@example.com');
            //$m->cc('bar@example.com');
            //$m->attach($pathToFile, array $options = []);
        });
    }

    /*
        First Start app

    */

    public function start(){
        $superAdmin = new Role();
        $superAdmin->name         = 'superAdmin';
        $superAdmin->display_name = 'Super Administrator'; // optional
        $superAdmin->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Administrator'; // optional
        $admin->save();

        $mitra = new Role();
        $mitra->name         = 'mitra';
        $mitra->display_name = 'Mitra'; // optional
        $mitra->save();

        $pic = new Role();
        $pic->name         = 'pic';
        $pic->display_name = 'PIC'; // optional
        $pic->save();

        $createTicket = new Permission();
        $createTicket->name         = 'createTicket';
        $createTicket->display_name = 'Create Ticket'; // optional
        // Allow a user to...
        $createTicket->description  = 'create new ticket'; // optional
        $createTicket->save();

        $changeTicketStatus = new Permission();
        $changeTicketStatus->name         = 'changeTicketStatus';
        $changeTicketStatus->display_name = 'Change Ticket Status'; // optional
        // Allow a user to...
        $changeTicketStatus->description  = 'Change Ticket Status Open,Close,Pending'; // optional
        $changeTicketStatus->save();

        $manageTicket = new Permission();
        $manageTicket->name         = 'manageTicket';
        $manageTicket->display_name = 'Manage Ticket'; // optional
        // Allow a user to...
        $manageTicket->description  = 'Manage Ticket create,update,delete'; // optional
        $manageTicket->save();

        $manageUser = new Permission();
        $manageUser->name         = 'manageUser';
        $manageUser->display_name = 'Manage User'; // optional
        // Allow a user to...
        $manageUser->description  = 'Manage User create,update,delete,assign'; // optional
        $manageUser->save();

        $manageSLA = new Permission();
        $manageSLA->name         = 'manageSLA';
        $manageSLA->display_name = 'Manage SLA'; // optional
        // Allow a user to...
        $manageSLA->description  = 'create new ticket'; // optional
        $manageSLA->save();

        $getTicket = new Permission();
        $getTicket->name         = 'getTicket';
        $getTicket->display_name = 'Get Ticket'; // optional
        // Allow a user to...
        $getTicket->description  = 'Get ticket from admin'; // optional
        $getTicket->save();

        $sendAlert = new Permission();
        $sendAlert->name         = 'sendAlert';
        $sendAlert->display_name = 'Send Alert To PIC'; // optional
        // Allow a user to...
        $sendAlert->description  = 'Send Alert Message to PIC'; // optional
        $sendAlert->save();

        $createHelpTopic = new Permission();
        $createHelpTopic->name         = 'createHelpTopic';
        $createHelpTopic->display_name = 'Create Help Topic'; // optional
        // Allow a user to...
        $createHelpTopic->description  = 'create help topic'; // optional
        $createHelpTopic->save();

        $manageOperator = new Permission();
        $manageOperator->name         = 'manageOperator';
        $manageOperator->display_name = 'Manage Operator'; // optional
        // Allow a user to...
        $manageOperator->description  = 'Manage Operator Cellular'; // optional
        $manageOperator->save();

        $manageMitra = new Permission();
        $manageMitra->name         = 'manageMitra';
        $manageMitra->display_name = 'Manage Mitra'; // optional
        // Allow a user to...
        $manageMitra->description  = 'manage mitra'; // optional
        $manageMitra->save();

        $superAdmin->attachPermission($createHelpTopic);
        $superAdmin->attachPermission($manageSLA);
        $superAdmin->attachPermission($manageUser);
        $superAdmin->attachPermission($manageMitra);
        $superAdmin->attachPermission($manageOperator);

        $admin->attachPermission($manageTicket);
        $admin->attachPermission($sendAlert);
        $admin->attachPermission($manageUser);

        $pic->attachPermission($getTicket);
        $pic->attachPermission($changeTicketStatus);

        $userSuperAdmin =  User::create([
                'name' => 'Super Admin',
                'email' => 'sa@a.com',
                'password' => bcrypt('sa123'),
                ]);

            $userAdmin =  User::create([
                'name' => 'Admin',
                'email' => 'a@a.com',
                'password' => bcrypt('a123'),
                ]);

            $userSuperAdmin->attachRole($superAdmin);
            $userAdmin->attachRole($admin);

            return "success";
    }

    /*
        Lupa Create USERnya

    */


}
