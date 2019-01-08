<?php namespace crocodicstudio\crudbooster\controllers;

use Carbon\Carbon;
use crocodicstudio\crudbooster\controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use CRUDBooster;

class AdminController extends CBController {	

	function getIndex() {

		$dashboard = CRUDBooster::sidebarDashboard();
		if($dashboard && $dashboard->url) {
			return redirect($dashboard->url);
		}

        $leads = \Illuminate\Support\Facades\DB::table('leads')
            ->select(\Illuminate\Support\Facades\DB::raw('count(*) as ammount'))
            ->where('leads.is_client', 0)
            ->get();

        $leads = \Illuminate\Support\Facades\DB::table('leads')
            ->select(\Illuminate\Support\Facades\DB::raw('count(*) as ammount'), 'leads.is_client as lead_type')
            ->groupBy('leads.is_client')
            ->get();

        $data = [];
        $data['total_leads'] = '';
        foreach ($leads as $value) {
            $data['total_leads'] = $data['total_leads'] .$value->ammount. ",";
        }

        return view('statistics/index', compact('data'));
	}

	public function getLockscreen() {
		
		if(!CRUDBooster::myId()) {
			Session::flush();
			return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
		}
		
		Session::put('admin_lock',1);
		return view('crudbooster::lockscreen');
	}

	public function postUnlockScreen() {
		$id       = CRUDBooster::myId();
		$password = Request::input('password');		
		$users    = DB::table(config('crudbooster.USER_TABLE'))->where('id',$id)->first();		

		if(\Hash::check($password,$users->password)) {
			Session::put('admin_lock',0);	
			return redirect()->route('AdminControllerGetIndex'); 
		}else{
			echo "<script>alert('".trans('crudbooster.alert_password_wrong')."');history.go(-1);</script>";				
		}
	}	

	public function getLogin()
	{											
		return view('crudbooster::login');
	}

    public function getRegister()
    {
        return view('crudbooster::register');
    }
 
	public function postLogin() {

		$validator = Validator::make(Request::all(),			
			[
			'email'=>'required|email|exists:'.config('crudbooster.USER_TABLE'),
			'password'=>'required'			
			]
		);
		
		if ($validator->fails()) 
		{
			$message = $validator->errors()->all();
			return redirect()->back()->with(['message'=>implode(', ',$message),'message_type'=>'danger']);
		}

		$email 		= Request::input("email");
		$password 	= Request::input("password");
		$users 		= DB::table(config('crudbooster.USER_TABLE'))->where("email",$email)->first(); 		

		if(\Hash::check($password,$users->password)) {
			$priv = DB::table("cms_privileges")->where("id",$users->id_cms_privileges)->first();

			$roles = DB::table('cms_privileges_roles')
			->where('id_cms_privileges',$users->id_cms_privileges)
			->join('cms_moduls','cms_moduls.id','=','id_cms_moduls')
			->select('cms_moduls.name','cms_moduls.path','is_visible','is_create','is_read','is_edit','is_delete')
			->get();
			
			$photo = ($users->photo)?asset($users->photo):'https://www.gravatar.com/avatar/'.md5($users->email).'?s=100';
			Session::put('admin_id',$users->id);			
			Session::put('admin_is_superadmin',$priv->is_superadmin);
			Session::put('admin_name',$users->name);	
			Session::put('admin_photo',$photo);
			Session::put('admin_privileges_roles',$roles);
			Session::put("admin_privileges",$users->id_cms_privileges);
			Session::put('admin_privileges_name',$priv->name);			
			Session::put('admin_lock',0);
			Session::put('theme_color',$priv->theme_color);
			Session::put("appname",CRUDBooster::getSetting('appname'));		

			CRUDBooster::insertLog(trans("crudbooster.log_login",['email'=>$users->email,'ip'=>Request::server('REMOTE_ADDR')]));		

			$cb_hook_session = new \App\Http\Controllers\CBHook;
			$cb_hook_session->afterLogin();

			return redirect()->route('AdminControllerGetIndex'); 
		}else{
			return redirect()->route('getLogin')->with('message', trans('crudbooster.alert_password_wrong'));			
		}		
	}

    public function postRegister() {

        $validator = Validator::make(Request::all(),
            [
                'name'=>'required',
                'email'=>'required|email|unique:'.config('crudbooster.USER_TABLE'),
                'password'=>'required'
            ]
        );

        if ($validator->fails())
        {
            $message = $validator->errors()->all();
            return redirect()->back()->with(['message'=>implode(', ',$message),'message_type'=>'danger']);
        }

        $password 	= Request::input("password");
        $password   = \Hash::make($password);
        $email = Request::input("email");
        $name = Request::input("name");

        $sumarizedData = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'status' => 'Active',
            'id_cms_privileges' => '2',
            'photo' => 'images/user.png',
            'created_at' => Carbon::now(config('app.timezone')),
            'updated_at' => Carbon::now(config('app.timezone')),
        ];

        DB::table('cms_users')->insert($sumarizedData);

        //Enviar email al usuario creado
        $to[] = $email;

        $subject = trans("crudbooster.email_register_subject");

        $html = "<p>".trans("crudbooster.text_dear")." $name, ".trans("crudbooster.email_register")."</p>";

        //Send Email with notification End Step
        \Mail::send("crudbooster::emails.blank",['content'=>$html],function($message) use ($to,$subject) {
            $message->priority(1);
            $message->to($to);

            $message->subject($subject);
        });

        return redirect()->route('getLogin');

    }

	public function getForgot() {		
		return view('crudbooster::forgot');
	}

	public function postForgot() {
		$validator = Validator::make(Request::all(),
			[
			'email'=>'required|email|exists:'.config('crudbooster.USER_TABLE')			
			]
		);
		
		if ($validator->fails()) 
		{
			$message = $validator->errors()->all();
			return redirect()->back()->with(['message'=>implode(', ',$message),'message_type'=>'danger']);
		}	

		$rand_string = str_random(5);
		$password = \Hash::make($rand_string);

		DB::table(config('crudbooster.USER_TABLE'))->where('email',Request::input('email'))->update(array('password'=>$password));
 	
		$appname = CRUDBooster::getSetting('appname');		
		$user = CRUDBooster::first(config('crudbooster.USER_TABLE'),['email'=>g('email')]);	
		$user->password = $rand_string;

		//CRUDBooster::sendEmail(['to'=>$user->email,'data'=>$user,'template'=>'forgot_password_backend']);

        $to = $user->email;
        $subject = '';
        $html = $user;

        $html = "<p>".trans("crudbooster.text_forgot")."</p>
                        <ul>
                            <li>".trans("crudbooster.name_lastname").": $html->fullname</li>
                            <li>".trans("crudbooster.email").": $html->email</li>
                            <li>".trans("crudbooster.password").":  ".$html->password."</li>
                        </ul>
                        <p>".trans("crudbooster.phase_sign")." Chef Units</p>
                ";

        //Send Email with notification End Step
        \Mail::send("crudbooster::emails.blank",['content'=>$html],function($message) use ($to,$subject) {
            $message->priority(1);
            $message->to($to);

            $message->subject($subject);
        });


		CRUDBooster::insertLog(trans("crudbooster.log_forgot",['email'=>g('email'),'ip'=>Request::server('REMOTE_ADDR')]));

		return redirect()->route('getLogin')->with('message', trans("crudbooster.message_forgot_password"));

	}	

	public function getLogout() {
		
		$me = CRUDBooster::me();
		CRUDBooster::insertLog(trans("crudbooster.log_logout",['email'=>$me->email]));

		Session::flush();
		return redirect()->route('getLogin')->with('message',trans("crudbooster.message_after_logout"));
	}

}
