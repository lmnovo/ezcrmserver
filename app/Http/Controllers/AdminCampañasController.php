<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminCampañasController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "10";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "campaigns";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
            $this->col[] = ["label"=>trans('crudbooster.name'),"name"=>"name"];
            $this->col[] = ["label"=>trans('crudbooster.template'),"name"=>"cms_email_templates_id","urlTemplate"=>"email_templates"];
            $this->col[] = ["label"=>trans('crudbooster.total_sent'),"name"=>"total_send"];
            $this->col[] = ["label"=>trans('crudbooster.creation_date'),"name"=>"created_at"];
            $this->col[] = ["label"=>trans('crudbooster.updated_date'),"name"=>"updated_at"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter'];
			$this->form[] = ['label'=>'Total Send','name'=>'total_send','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter'];
			//$this->form[] = ['label'=>'Total Send','name'=>'total_send','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
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
            $this->index_button[] = ['label'=>'','url'=>CRUDBooster::adminPath($slug="email_templates"),"icon"=>"fa fa-envelope-o", "title"=>trans('crudbooster.campaign_template'), "color"=>"warning"];


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
	        $this->script_js = NULL;


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
	        //Your code here
	            
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
                $query->where('id_cms_users', $user_id);
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
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

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
            $toArray = [];
            $toTemp = explode("; ", $postdata['to']);

            dd($toTemp);

            $isMail = strpos($toTemp[0], "@");

            if ($isMail == false) {
                //Obtengo el/los Leads seleccionado
                $leadsSelected = DB::table('account')->whereIn('telephone', $toTemp)->get();

            } else {
                //Obtengo el/los Leads seleccionado
                $leadsSelected = DB::table('account')->whereIn('email', $toTemp)->get();
            }

            DB::table('settings_campaigns')->where('id', $id)->update(['is_active' => 1]);
            $campaignsDelete = DB::table('settings_campaigns')->where('is_active', 0)->delete();

            //Comprobar si la campaña es de envío de SMS o Email
            $campaignsType = DB::table('settings_campaigns')->where('id', $id)->first();

            if($postdata['cms_email_templates_id'] != 0) {
                $template = CRUDBooster::first('cms_email_templates',['id'=>$postdata['cms_email_templates_id']]);
                $html = $template->content;
                $subject = $template->subject;
            } else {
                $html = $postdata['content'];
                $subject = $postdata['subject'];
            }

            if ($isMail == false) {
                //Obtengo arreglo de phones asociados a los Leads seleccionados para enviar campaña
                foreach ($leadsSelected as $item) {
                    $to[] = $item->telephone;
                    $leads_send_id[] = $item->id;
                }
            } else {
                //Obtengo arreglo de emails asociados a los Leads seleccionados para enviar campaña
                foreach ($leadsSelected as $item) {
                    //validamos antes de incluir los emails
                    if ($this->validarEmail($item->email)) {
                        $to[] = $item->email;
                        $leads_send_id[] = $item->id;
                    }
                }
            }

            ///////////////////Envío Campaign Email//////////////////////////
            if ($campaignsType->type == 'Email') {

                \Mail::send("crudbooster::emails.blank",['content'=>$html],function($message) use ($to,$subject,$template) {
                    $message->priority(1);
                    $message->cc($to);

                    if($template->from_email) {
                        $from_name = ($template->from_name)?:CRUDBooster::getSetting('appname');
                        $message->from($template->from_email,$from_name);
                    }

                    if($template->cc_email) {
                        $message->cc($template->cc_email);
                    }

                    $message->subject($subject);
                });
            }
            ///////////////////Envío Campaign SMS//////////////////////////
            else {
                //Eliminar etiquetas html para el envío de sms
                $html = strip_tags($html);

                $settings = DB::table('settings')->where('id', 1)->first();

                $sid = $settings->sid_twilio; // Your Account SID from www.twilio.com/console
                $token = $settings->token; // Your Auth Token from www.twilio.com/console
                $number_twilio = $settings->number_twilio;

                $client = new Client($sid, $token);

                foreach ($to as $number_phone) {
                    $client->messages->create(
                    // the number you'd like to send the message to '18324348183',
                        '1'.$number_phone,
                        array(
                            // A Twilio phone number you purchased at twilio.com/console
                            'from' => $number_twilio,
                            // the body of the text message you'd like to send
                            'body' => $html
                        )
                    );
                }
            }

            $template_id = null;
            $template_name = $subject;
            if ($template != null) {
                $template_id = $template->id;
                $template_name = $template->name;
            }

            //Guardar registro de campañas enviadas
            $lastId = DB::table('campaigns')->insertGetId([
                'name' => $template_name,
                'content' => $html,
                'total_send' => count($leads_send_id),
                'cms_email_templates_id' => $template_id,
                'id_settings_campaigns' => $id,
                'created_at' => Carbon::now(config('app.timezone')),
                'updated_at' => Carbon::now(config('app.timezone')),
                'id_cms_users' => CRUDBooster::myId()
            ]);

            //Insertar relación de Leads y Campañas enviadas
            foreach ($leads_send_id as $lead_send) {
                DB::table('campaigns_leads')->insert([
                    'campaigns_id' => $lastId,
                    'leads_id' => $lead_send,
                    'created_at' => Carbon::now(config('app.timezone')),
                ]);
            }

            $lastId = DB::table('campaigns')->max('id');

            //Notificación de envío de campaña de tipo campaña
            $config['content'] = trans("crudbooster.text_notification_success_1")."'".$template_name."' ".trans("crudbooster.text_notification_success_2");
            $config['to'] = CRUDBooster::adminPath('campaigns/detail/'.$lastId);


            if (CRUDBooster::myId() != 1) {
                $config['id_cms_users'] = [1,CRUDBooster::myId()]; //This is an array of id users
            }
            else {
                $config['id_cms_users'] = [1]; //This is an array of id users
            }

            CRUDBooster::sendNotification($config);

            CRUDBooster::redirect(CRUDBooster::adminPath('campaigns'),trans("crudbooster.text_send_campaign"));

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

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
	        //Your code here

	    }


        public function getDetail($id) {
            //Create an Auth
            if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $data = [];
            $data['page_title'] = 'Detail Sent Campaigns';
            $data['row'] = DB::table('campaigns')
                ->select('campaigns.name', 'campaigns.content','campaigns.cms_email_templates_id', 'campaigns.total_send', 'campaigns.created_at',
                    'settings_campaigns.type', 'settings_campaigns.to')
                ->join('settings_campaigns', 'settings_campaigns.id', '=', 'campaigns.id_settings_campaigns')
                ->where('campaigns.id',$id)
                ->first();

            $senders = $data['row']->to;
            $senders = explode(";", $senders);
            $data['senders'] = $senders;

            $data['leads'] = DB::table('campaigns')
                ->select(['account.name', 'account.email'])
                ->join('campaigns_leads', 'campaigns_leads.campaigns_id', '=', 'campaigns.cms_email_templates_id')
                ->join('account', 'account.id', '=', 'campaigns_leads.leads_id')
                ->where('campaigns.id', $id)
                ->get();

            $data['total_send'] = count($data['leads']);

            //Please use cbView method instead view method from laravel
            $this->cbView('campaigns.show',$data);
        }


	}