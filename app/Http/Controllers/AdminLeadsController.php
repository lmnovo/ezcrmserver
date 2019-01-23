<?php namespace App\Http\Controllers;

use App\Brands;
use App\EazyTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Session;
use Request;
use DB;
use CRUDBooster;
use App\Mail\CampaignEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

use Twilio\Rest\Client;

class AdminLeadsController extends \crocodicstudio\crudbooster\controllers\CBController {

    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "100";
			$this->orderby = "id,desc";
			$this->global_privilege = true;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = true;
			$this->button_export = true;
			$this->table = "leads";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Last Name","name"=>"lastname"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Phone","name"=>"phone"];
			$this->col[] = ["label"=>"Lead Type","name"=>"leads_type_id","join"=>"leads_type,name"];
			$this->col[] = ["label"=>"Assigned","name"=>"cms_users_id","join"=>"cms_users,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Photo','name'=>'photo','type'=>'upload','validation'=>'image|max:10000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Last Name','name'=>'lastname','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:253|email|unique:leads','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'text','validation'=>'required|min:10|max:10|unique:leads','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'googlemaps','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'State','name'=>'states_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'states,name'];
			$this->form[] = ['label'=>'Assign To','name'=>'cms_users_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			$this->form[] = ['label'=>'Latitude','name'=>'latitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Longitude','name'=>'longitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Photo','name'=>'photo','type'=>'upload','validation'=>'image|max:10000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Last Name','name'=>'lastname','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:253|email|unique:leads','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'text','validation'=>'required|min:10|max:10|unique:leads','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Address','name'=>'address','type'=>'googlemaps','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10','datatable'=>'states,name'];
			//$this->form[] = ['label'=>'State','name'=>'states_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Assign To','name'=>'cms_users_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'Latitude','name'=>'latitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Longitude','name'=>'longitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# OLD END FORM

			/*
        | ----------------------------------------------------------------------
        | Sub Module
        | ----------------------------------------------------------------------
        | @label          = Label of action
        | @path           = Path of sub module
        | @foreign_key 	  = foreign key of sub table/module
        | @button_color   = Bootstrap Class (primary,success,warning,danger)
        | @button_icon    = Font Awesome Class
        | @parent_columns = Sparate with comma, e.g : name,created_at
        |
        */
        $this->sub_module = array();

        /*
        | ----------------------------------------------------------------------
        | Add More Action Button / Menu
        | ----------------------------------------------------------------------
        | @label       = Label of action
        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
        | @icon        = Font awesome class icon. e.g : fa fa-bars
        | @color 	   = Default is primary. (primary, warning, succecss, info)
        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
        |
        */
        $this->addaction = array();



        /*
        | ----------------------------------------------------------------------
        | Add More Button Selected
        | ----------------------------------------------------------------------
        | @label       = Label of action
        | @icon 	   = Icon from fontawesome
        | @name 	   = Name of button
        | Then about the action, you should code at actionButtonSelected method
        |
        */
        $this->button_selected = array();
        $this->button_selected[] = ['label'=>'Send Email','icon'=>'fa fa-envelope-o','name'=>'send_email'];
        $this->button_selected[] = ['label'=>'Send SMS','icon'=>'fa fa-phone','name'=>'send_sms'];


        /*
        | ----------------------------------------------------------------------
        | Add alert message to this module at overheader
        | ----------------------------------------------------------------------
        | @message = Text of message
        | @type    = warning,success,danger,info
        |
        */
        $this->alert        = array();



        /*
        | ----------------------------------------------------------------------
        | Add more button to header button
        | ----------------------------------------------------------------------
        | @label = Name of button
        | @url   = URL Target
        | @icon  = Icon from Awesome.
        |
        */
        $this->index_button = array();


        /*
        | ----------------------------------------------------------------------
        | Customize Table Row Color
        | ----------------------------------------------------------------------
        | @condition = If condition. You may use field alias. E.g : [id] == 1
        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
        |
        */
        $this->table_row_color = array();


        /*
        | ----------------------------------------------------------------------
        | You may use this bellow array to add statistic at dashboard
        | ----------------------------------------------------------------------
        | @label, @count, @icon, @color
        |
        */
        $this->index_statistic = array();


        /*
        | ----------------------------------------------------------------------
        | Add javascript at body
        | ----------------------------------------------------------------------
        | javascript code in the variable
        | $this->script_js = "function() { ... }";
        |
        */
        $this->script_js = "
            
	        	$(function() {                      
                    
	        	})
	        ";


        /*
        | ----------------------------------------------------------------------
        | Include HTML Code before index table
        | ----------------------------------------------------------------------
        | html code to display it before index table
        | $this->pre_index_html = "<p>test</p>";
        |
        */
        $this->pre_index_html = null;



        /*
        | ----------------------------------------------------------------------
        | Include HTML Code after index table
        | ----------------------------------------------------------------------
        | html code to display it after index table
        | $this->post_index_html = "<p>test</p>";
        |
        */
        $this->post_index_html = null;



        /*
        | ----------------------------------------------------------------------
        | Include Javascript File
        | ----------------------------------------------------------------------
        | URL of your javascript each array
        | $this->load_js[] = asset("myfile.js");
        |
        */
        $this->load_js = array();



        /*
        | ----------------------------------------------------------------------
        | Add css style at body
        | ----------------------------------------------------------------------
        | css code in the variable
        | $this->style_css = ".style{....}";
        |
        */
        $this->style_css = NULL;



        /*
        | ----------------------------------------------------------------------
        | Include css File
        | ----------------------------------------------------------------------
        | URL of your css each array
        | $this->load_css[] = asset("myfile.css");
        |
        */
        $this->load_css = array();


    }


    /*
    | ----------------------------------------------------------------------
    | Hook for button selected
    | ----------------------------------------------------------------------
    | @id_selected = the id selected
    | @button_name = the name of button
    |
    */
    public function actionButtonSelected($id_selected,$button_name) {

        if ($button_name == 'send_email')
        {
            $this->getSendEmail($id_selected);
        } else {
            $this->getSendSms($id_selected);
        }
    }


    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate query of index result
    | ----------------------------------------------------------------------
    | @query = current sql query
    |
    */
    public function hook_query_index(&$query) {
        $id = (CRUDBooster::isSuperadmin());
        $user_id = (CRUDBooster::myId());

        if ($id != 1) {
            $query->where(['is_client' => 0])
                ->where('cms_users_id', $user_id);
        } else {
            $query->where(['is_client' => 0]);
        }
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate row of index table html
    | ----------------------------------------------------------------------
    |
    */
    public function hook_row_index($column_index,&$column_value) {
        //Your code here
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
    */
    public function hook_before_add(&$postdata) {

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @id = last insert id
    |
    */
    public function hook_after_add($id) {

        //Adicionar "Recent Activity" a la creación de un Leads
        DB::table('leads_activities')->insert([
            'leads_id'=>$id,
            'description'=>'The lead was created by: '.CRUDBooster::myName(),
            'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
        ]);

        //Mostrar los detalles del Lead Creado
        return $this->getDetail($id);
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before update data is execute
    | ----------------------------------------------------------------------
    | @postdata = input post data
    | @id       = current id
    |
    */
    public function hook_before_edit(&$postdata,$id) {

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_edit($id) {
        CRUDBooster::redirect(CRUDBooster::adminPath('leads/detail/'.$id),trans("crudbooster.text_edit_lead"));
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_before_delete($id) {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_delete($id) {
        DB::table("leads")->where("id",$id)->delete();
    }

    //Agregar nueva nota de tipo Lead
    public function getAddnote(\Illuminate\Http\Request $request) {
        $name = $request->get('name');
        $leads_id = $request->get('leads_id');

        $sumarizedData = [
            'created_at' => Carbon::now(config('app.timezone')),
            'name' => $name,
            'assign_to_id' => $leads_id,
            'type' => 'leads',
        ];

        DB::table('eazy_notes')->insertGetId($sumarizedData);

        //Adicionar "Recent Activity" a la creación de una nota
        DB::table('leads_activities')->insert([
            'leads_id'=>$leads_id,
            'description'=>'A note was added by: '.CRUDBooster::myName(),
            'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
        ]);

        return 1;
    }

    //Obtiene el listado de usuarios existentes en bd
    public function getUsers() {
        $data = DB::table('cms_users')
            ->select('id','name')
            ->get();

        return $data;
    }

    //Agregar Tarea de tipo Lead
    public function getAddsave(\Illuminate\Http\Request $request) {

        $sumarizedData = [
            'created_at' => $request->get('date'),
            'updated_at' => $request->get('reminder_email'),
            'name' => $request->get('name'),
            'assign_to_id' => $request->get('lead_id'),
            'type' => 'leads',
        ];

        DB::table('eazy_tasks')->insertGetId($sumarizedData);

        //Adicionar "Recent Activity" a la creación de una tarea
        DB::table('leads_activities')->insert([
            'leads_id'=>$request->get('lead_id'),
            'description'=>'The task: '.$request->get('name').' was added by: '.CRUDBooster::myName(),
            'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
        ]);

        return 1;
    }

    //Mostrar el perfil de un Lead dado su id
    public function getDetail($id) {

        $lead_user_null = DB::table('leads')->where('id',$id)->first();

        if($lead_user_null->cms_users_id == null) {
            DB::table('leads')->where('id',$id)->update(['cms_users_id'=>1]);
        }

        //Create an Auth
        if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
        }

        $account_exists = DB::table('leads')->where('id',$id)->first();
        if (!empty($account_exists)) {
            if ($account_exists->deleted_at != null) {
                CRUDBooster::redirect(CRUDBooster::adminPath('account'),trans("crudbooster.text_delete_account"));
            }
        }

        $data = [];
        $data['page_title'] = 'Lead Profile';
        $data['id'] = $id;

        $data['notes'] = DB::table('eazy_notes')
            ->where('assign_to_id', $id)->where('type','leads')->where('deleted_at', null)
            ->get();

        $data['recent_activities'] = DB::table('leads_activities')->where('leads_id', $id)->where('deleted_at', null)->orderby('created_at', 'DESC')->get();

        $data['business'] = \Illuminate\Support\Facades\DB::table('business')
            ->select(DB::raw('business.name as name'), 'stages.name as stage', 'business.created_at as created_at',
                'business.total as total', 'business.date_limit as date_limit', 'business.id as id')
            ->join('stages', 'stages.id', '=', 'business.stages_id')
            ->join('leads', 'leads.id', '=', 'business.leads_id')
            ->where('business.leads_id', '=', $id)
            ->where('business.is_active', '=', 1)
            ->where('business.deleted_at', '=', null)
            ->get();

        //Obtener las tasks de type Leads
        $data['tasks'] = DB::table('eazy_tasks')
            ->where('eazy_tasks.deleted_at', null)
            ->where('assign_to_id', $id)
            ->where('type', 'leads')
            ->get();

        $data['lead'] = \Illuminate\Support\Facades\DB::table('leads')
            ->select(DB::raw('leads.name as name'), 'leads.lastname as lastname', 'cms_users.fullname as user_fullname'
                , 'leads.phone', 'leads.email', 'leads_type.name as leads_type', 'states.name as states', 'leads.city'
                , 'leads.photo', 'leads.address', 'leads.subscribed', 'leads.is_client as is_client')
            ->join('cms_users', 'cms_users.id', '=', 'leads.cms_users_id')
            ->join('states', 'states.id', '=', 'leads.states_id')
            ->join('leads_type', 'leads_type.id', '=', 'leads.leads_type_id')
            ->where('leads.id', '=', $id)
            ->first();

        $data['campaigns'] = \Illuminate\Support\Facades\DB::table('leads')
            ->select(DB::raw('settings_campaigns.name as campaign_name'), 'settings_campaigns.type as type'
                , 'settings_campaigns.subject as subject', 'settings_campaigns.id as campaign_id')
            ->join('campaigns_leads', 'campaigns_leads.leads_id', '=', 'leads.id')
            ->join('settings_campaigns', 'settings_campaigns.id', '=', 'campaigns_leads.campaigns_id')
            ->where('leads.id', '=', $id)
            ->get();

        //Please use cbView method instead view method from laravel
        $this->cbView('leads.perfil',$data);
    }

    //Enviar SMS dado el id de Lead
    public function getSendSms($id) {

        $to = null;

        if(gettype($id) == 'array') {
            $leadsSelected = DB::table('leads')->whereIn('id',$id)->get();
            foreach ($leadsSelected as $item) {
                if (!empty($item->phone)) {
                    $to[] = $item->phone;
                }
            }
        }
        else {
            $leadsSelected = DB::table('leads')->where('id',$id)->first();
            if (!empty($leadsSelected->phone)) {
                $to[] = $leadsSelected->phone;
            }
        }

        $phonesArray = '';
        $cant = count($to);
        for ($i = 0; $i < count($to); $i++) {
            if ($i == 0) {
                $phonesArray	= $to[$i];
            } else {
                $phonesArray	= $phonesArray.'; '.$to[$i];
            }
        }

        $sumarizedData = [
            'created_at' => Carbon::now(config('app.timezone')),
            'to' => $phonesArray,
            'subject' => '',
            'content' => '',
            'type' => 'SMS',
            'cms_email_templates_id' => null,
            'cms_users_id' => CRUDBooster::myId()
        ];

        $maxId = DB::table('settings_campaigns')->select(\Illuminate\Support\Facades\DB::raw('MAX(id) as id'))->first();
        $maxId = $maxId->id + 1;
        $lastId = DB::table('settings_campaigns')->insertGetId($sumarizedData);

        //Open Edit Campaign
        CRUDBooster::redirect(CRUDBooster::adminPath('settings_campaigns/edit/'.$lastId),trans("crudbooster.text_open_edit_campaign"));
    }

    //Enviar Email dado el id de Lead
    public function getSendEmail($id) {
        $emails = [];

        //Si son varios correos a los que se les enviará la campaña
        if(gettype($id) == 'array') {
            $leads = DB::table('leads')->whereIn('id', $id)->get();

            foreach ($leads as $item) {
                if (!empty($item->email)) {
                    $emails[] = $item->email;
                }
            }

        //Si es un único correo al que se le enviará la campaña
        } else {
            $lead = DB::table('leads')->where('id', $id)->first();

            if (!empty($lead->email)) {
                $emails[] = $lead->email;
            }
        }

        $emailArray = '';
        $cant = count($emails);
        for ($i = 0; $i < count($emails); $i++) {
            if ($i == 0) {
                $emailArray	= $emails[$i];
            } else {
                $emailArray	= $emailArray.'; '.$emails[$i];
            }
        }

        $sumarizedData = [
            'created_at' => Carbon::now(config('app.timezone')),
            'to' => $emailArray,
            'subject' => '',
            'content' => '',
            'type' => 'Email',
            'cms_email_templates_id' => null,
            'cms_users_id' => CRUDBooster::myId()
        ];

        $maxId = DB::table('settings_campaigns')->select(\Illuminate\Support\Facades\DB::raw('MAX(id) as id'))->first();
        $maxId = $maxId->id + 1;
        $lastId = DB::table('settings_campaigns')->insertGetId($sumarizedData);

        //Open Edit Campaign
        CRUDBooster::redirect(CRUDBooster::adminPath('settings_campaigns/edit/'.$lastId),trans("crudbooster.text_open_edit_campaign"));

    }

    //Ajax - Cambiar el estado de la suscripción del lead a las campañas de email marketing
    public function getSubscriptionchange(\Illuminate\Http\Request $request) {

        $id = $request->get('id');
        $subscribed = $request->get('subscribed');

        $lead = DB::table('leads')->where('id',$id)->first();

        if (!empty($lead)) {
            $description = '';
            /*if ($subscribed == 1) {
                $description = 'The subscription for the campaigns of email marketing was activated at: ';
            } else {
                $description = 'The subscription for the campaigns of email marketing was deactivated at: ';
            }

            //Adicionar "Recent Activity" a la suscripción de un Lead
            DB::table('leads_activities')->insert([
                'leads_id'=>$id,
                'description'=>$description.Carbon::now(config('app.timezone')).' by: '.CRUDBooster::myName(),
                'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
            ]);*/

            return DB::table('leads')->where('id',$id)->update(['subscribed'=>$subscribed]);
        }
        return -1;
    }

    //Convertir Lead en Client
    public function getConvertClient($id) {
        $lead = DB::table('leads')->where('id',$id)->first();

        if (!empty($lead)) {
            DB::table('leads')->where('id',$id)->update(['is_client'=>1]);
        }

        CRUDBooster::redirect(CRUDBooster::adminPath('leads/detail/'.$id),trans("crudbooster.text_edit_lead"));
    }

    //Convertir Lead en Client
    public function getConvertLead($id) {
        $lead = DB::table('leads')->where('id',$id)->first();

        if (!empty($lead)) {
            DB::table('leads')->where('id',$id)->update(['is_client'=>0]);
        }

        CRUDBooster::redirect(CRUDBooster::adminPath('leads/detail/'.$id),trans("crudbooster.text_edit_lead"));
    }


}