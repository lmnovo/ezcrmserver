<?php namespace App\Http\Controllers;

	use Carbon\Carbon;
    use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminBusinessController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "100";
			$this->orderby = "id,desc";
			$this->global_privilege = true;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "business";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Assigned","name"=>"cms_users_id","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Lead Name","name"=>"leads_id","join"=>"leads,name"];
			$this->col[] = ["label"=>"Date Limit","name"=>"date_limit"];
			$this->col[] = ["label"=>"Total","name"=>"total"];
			$this->col[] = ["label"=>"Stage","name"=>"stages_id","join"=>"stages,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Assign To','name'=>'cms_users_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			$this->form[] = ['label'=>'Lead Name','name'=>'leads_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'leads,name'];
			$this->form[] = ['label'=>'Stage\'s Pipeline','name'=>'stages_groups_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'stages_groups,name'];
			//$this->form[] = ['label'=>'Date Limit','name'=>'date_limit','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Total Ammount','name'=>'total','type'=>'number','validation'=>'required','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Description','name'=>'description','type'=>'textarea','width'=>'col-sm-10'];
            # END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Assign To','name'=>'cms_users_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'Stage','name'=>'stages_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'stages,name'];
			//$this->form[] = ['label'=>'Description','name'=>'description','type'=>'textarea','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Date Limit','name'=>'date_limit','type'=>'date','width'=>'col-sm-10'];
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
                    //Agregar nueva nota
                    $('#add_note').on('click',function(){
                        var name = $('#note_value').val();
                        var leads_id = $('#note_lead_id').val();
        
                        $.ajax({
                            url: '../addnote',
                            data: \"name=\"+name+\"&leads_id=\"+leads_id,
                            type:  'get',
                            dataType: 'json',
                            success : function(data) {                                
                                //Actualizo solo el listado de notas para no recargar la web completamente
                                //Limpio el campo de nueva nota
                                $('#div_add_note').load(' #div_add_note');
                                $('#note_value').val('');                                                       
                            }
                         });  
                    });
                    
                                     
                   
                    
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
                $query->where('leads.cms_users_id', $user_id)->where('business.is_active', 1)
                ;
            } else {
                $query->where('business.is_active', 1);
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
            $business = DB::table('business')->where('id', $id)->first();
            $stages_groups = DB::table('stages_groups')->where('id', $business->stages_groups_id)->first();
            $stages = DB::table('stages')
                ->where('stages_groups_id', $stages_groups->id)
                ->orderby('id', 'asc')
                ->get();

            DB::table('business')->where('id', $id)->update(['stages_id'=>$stages[0]->id]);

            foreach ($stages as $stage) {
                $sumarizedData = [
                    'created_at' => Carbon::now(config('app.timezone')),
                    'updated_at' => Carbon::now(config('app.timezone')),
                    'business_id' => $id,
                    'stages_id' => $stage->id,
                ];

                DB::table('business_stages')->insertGetId($sumarizedData);

                //Ponemos por defecto la primera etapa del business
                DB::table('business_stages')->where('stages_id', $stages[0]->id)->update(['is_completed'=>1]);
            }

            //Adicionar "Recent Activity" de la primera etapa creada por defecto
            DB::table('stages_activities')->insert([
                'stages_id'=>$stages[0]->id,
                'description'=>'Created initial stage by: '.CRUDBooster::myName(),
                'business_id'=>$id,
                'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
            ]);

            //Open Edit Negotiation
            CRUDBooster::redirect(CRUDBooster::adminPath('business/edit/'.$id),trans("crudbooster.text_business_create"));

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
	        //Your code here

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
            DB::table("business")->where("id",$id)->delete();
	    }

	    //Muestra los datos de un Business
        public function getDetail($id) {
            //Create an Auth
            if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.text_open_edit_quote"));
            }

            $data = [];
            $data['page_title'] = 'Editing the Negotiation';
            $data['id'] = $id;

            $data['notes'] = DB::table('eazy_notes')->where('assign_to_id', $id)->where('type','business')->where('deleted_at', null)->get();

            //Obtener las tasks de type Business
            $data['tasks'] = DB::table('eazy_tasks')
                ->where('eazy_tasks.deleted_at', null)
                ->where('assign_to_id', $id)
                ->where('type', 'business')
                ->get();

            $data['business'] = \Illuminate\Support\Facades\DB::table('business')
                ->select(DB::raw('leads.name as name'), 'leads.lastname as lastname',
                    'business.total', 'business.date_limit', 'cms_users.name as fullname',
                    'stages.name as stage_name', 'stages.number as stage_number',  'stages.id as stage_id',
                    'business.stages_groups_id as stages_groups_id', 'business.stages_id as business_stage_id',
                    'business.name as business_name', 'business.id as business_id')
                ->join('leads', 'leads.id', '=', 'business.leads_id')
                ->join('cms_users', 'cms_users.id', '=', 'business.cms_users_id')
                ->join('stages', 'stages.id', '=', 'business.stages_id')
                ->where('business.id', '=', $id)
                ->first();

            $data['stages'] = DB::table('business')
                ->select(DB::raw('stages.name as stage_name'), 'stages.number as stage_number',
                    'business_stages.updated_at as date_limit', 'stages.id as stage_id',
                    'business_stages.files as files', 'business_stages.notes as notes')

                ->join('business_stages', 'business_stages.business_id', '=', 'business.id')
                ->join('stages', 'stages.id', '=', 'business_stages.stages_id')
                ->where('business.id', '=', $id)
                ->get();

            $data['stages_activities'] = DB::table('stages_activities')
                ->where('business_id', $id)->orderby('created_at','desc')->get();

            $this->cbView('business.detail',$data);
        }

        //Agregar nueva nota de tipo Lead
        public function getAddnote(\Illuminate\Http\Request $request) {
            $name = $request->get('name');
            $leads_id = $request->get('leads_id');

            $sumarizedData = [
                'created_at' => Carbon::now(config('app.timezone')),
                'name' => $name,
                'assign_to_id' => $leads_id,
                'type' => 'business',
            ];

            DB::table('eazy_notes')->insertGetId($sumarizedData);

            return 1;
        }

        //Agregar Tarea de tipo Business
        public function getAddsave(\Illuminate\Http\Request $request) {

            $date = $request->get('date');

            $sumarizedData = [
                'created_at' => $date,
                'name' => $request->get('name'),
                'assign_to_id' => $request->get('business_id'),
                'type' => 'business',
            ];

            DB::table('eazy_tasks')->insertGetId($sumarizedData);

            return 1;
        }

        //Enviar Email dado el id de Lead
        public function getSendEmail($id) {
            $business = DB::table('business')->where('id', $id)->first();
            $emails = [];

            $lead = DB::table('leads')->where('id', $business->leads_id)->first();

            if (!empty($lead->email)) {
                $emails[] = $lead->email;
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

        //Acción que se ejecuta al dar clic en Leads y Add Business
        public function getAddBusiness($id) {
            $lead = DB::table('leads')->where('id', $id)->first();

            $maxId = DB::table('business')->select(\Illuminate\Support\Facades\DB::raw('MAX(id) as id'))->first();
            $maxId = $maxId->id + 1;

            //Create Business
            $sumarizedData = [
                'id' => $maxId,
                'leads_id' => $id,
                'cms_users_id' => CRUDBooster::myId(),
                'is_active' => 0,
                'created_at' => Carbon::now(config('app.timezone')),
            ];

            DB::table('business')->insert($sumarizedData);

            //Open Edit Quote
            CRUDBooster::redirect(CRUDBooster::adminPath('business/edit/'.$maxId),trans("crudbooster.text_open_edit_quote"));

        }

        //Acción que se ejecuta al dar clic en Leads y Add Business
        public function getEdit($id) {

            $data = [];
            $data['id'] = $id;

            $data['products'] = DB::table('business')
                ->select(DB::raw('products.name'), 'products.description', 'products.sell_price', 'products.buy_price',
                    'products.weight', 'products.id as id', 'business_products.quantity as quantity',
                    'business_products.id as business_products_id')
                ->join('business_products', 'business_products.business_id', '=', 'business.id')
                ->join('products', 'products.id', '=', 'business_products.products_id')
                ->where('business.id', $id)->get();

            $data['total'] = 0;
            foreach ($data['products'] as $items) {
                $data['total'] += $items->quantity * $items->sell_price;
            }

            //Obtener los datos del business actual
            $data['business'] = DB::table('business')->where('id',$id)->first();

            //Obtener el listado de estados de Estados Unidos
            $data['states_list'] = DB::table('states')->get();

            //Obtener el listado de usuarios del sistema
            $data['users'] = DB::table('cms_users')->get();

            //Obtener el listado de stages_groups (pipeline) del sistema
            $data['stages_groups'] = DB::table('stages_groups')->get();

            //Obtener los datos del lead asociado al business actual
            $data['lead'] = DB::table('leads')->where('id',$data['business']->leads_id)->first();

            $this->cbView('business.create',$data);
        }

        //Acción que se ejecuta luego de seleccionar en un lead la opción "Add Business"
        public function getCreate($id) {
            //Create an Auth
            if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.text_open_edit_quote"));
            }

            $data = [];
            $data['page_title'] = 'Creating the Negotiation';
            $data['id'] = $id;

            //Obtener los datos del business actual
            $data['business'] = DB::table('business')->where('id',$id)->first();

            //Obtener los productos existentes
            $data['products'] = DB::table('products')->where('deleted_at',null)->get();

            //Obtener el listado de estados de Estados Unidos
            $data['states_list'] = DB::table('states')->get();

            //Obtener el listado de usuarios del sistema
            $data['users'] = DB::table('cms_users')->get();

            //Obtener el listado de stages_groups (pipeline) del sistema
            $data['stages_groups'] = DB::table('stages_groups')->get();

            //Obtener los datos del lead asociado al business actual
            $data['lead'] = DB::table('leads')->where('id',$data['business']->leads_id)->first();

            $this->cbView('business.create',$data);
        }

        //Guardar mediante ajax los cambios en el Business
        public function getAjaxsave(\Illuminate\Http\Request $request) {
	        //Business Actual
	        $business = DB::table('business')->where('id',$request->get('id'))->first();

            $name = $business->name;
            $description = $business->description;
            $cms_users_id = $business->cms_users_id;
            $total = $business->total;
            $date_limit = $business->date_limit;
            $stages_groups_id = $business->stages_groups_id;
            $discount = $business->discount;

            if (!empty($request->get('business_name'))) {
                $name = $request->get('business_name');
            }
            if (!empty($request->get('business_description'))) {
                $description = $request->get('business_description');
            }
            if (!empty($request->get('business_user_id'))) {
                $cms_users_id = $request->get('business_user_id');
            }
            if (!empty($request->get('business_total'))) {
                $total = $request->get('business_total');
            }
            if (!empty($request->get('business_date_limit'))) {
                $date_limit = $request->get('business_date_limit');
            }
            if (!empty($request->get('business_stages_groups_id'))) {
                $stages_groups_id = $request->get('business_stages_groups_id');
            }
            if (!empty($request->get('business_discount'))) {
                $discount = $request->get('business_discount');
            }

            $sumarizedData = [
                'name' => $name,
                'description' => $description,
                'cms_users_id' => $cms_users_id,
                'total' => $total,
                'date_limit' => $date_limit,
                'stages_groups_id' => $stages_groups_id,
                'discount' => $discount,
            ];
            return DB::table('business')->where('id',$request->get('id'))->update($sumarizedData);
        }

        //Guardar mediante ajax los cambios en el Business - Lead
        public function getAjaxleadsave(\Illuminate\Http\Request $request) {
            //Lead Actual del Business Actual
            $leads = DB::table('leads')->where('id',$request->get('lead_id'))->first();

            $name = $leads->name;
            $lastname = $leads->lastname;
            $email = $leads->email;
            $phone = $leads->phone;
            $states_id = $leads->states_id;
            $city = $leads->city;

            if (!empty($request->get('lead_name'))) {
                $name = $request->get('lead_name');
            }
            if (!empty($request->get('lead_lastname'))) {
                $lastname = $request->get('lead_lastname');
            }
            if (!empty($request->get('lead_email'))) {
                $email = $request->get('lead_email');
            }
            if (!empty($request->get('lead_phone'))) {
                $phone = $request->get('lead_phone');
            }
            if (!empty($request->get('lead_states_id'))) {
                $states_id = $request->get('lead_states_id');
            }
            if (!empty($request->get('lead_city'))) {
                $city = $request->get('lead_city');
            }

            $sumarizedData = [
                'name' => $name,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'states_id' => $states_id,
                'city' => $city,
            ];
            return DB::table('leads')->where('id',$request->get('lead_id'))->update($sumarizedData);
        }

        //Se ejecuta a partir de la acción "getCreate" y guarda la información de un nuevo Business
        public function getEditsave(\Illuminate\Http\Request $request) {
	        //dd($request->all());

            $lead_id = $request->get('lead_id');
            $business_id = $request->get('business_id');

	        $stage = DB::table('stages')->where('stages_groups_id', $request->get('stages_group'))->orderby('number')->first();
            (count($stage) == 0) ? $stage = null : $stage = $stage->id;

            $sumarizedData = [
                'name' => $request->get('business_name'),
                'description' => $request->get('description'),
                'cms_users_id' => $request->get('assign_to'),
                'stages_id' => $stage,
                'stages_groups_id' => $request->get('stages_group'),
                'total' => $request->get('total_ammount'),
                'date_limit' => $request->get('date_limit'),
                'created_at' => Carbon::now(config('app.timezone')),
                'is_active' => 1,
            ];
            DB::table('business')->where('id',$request->get('business_id'))->update($sumarizedData);

            //Actualiza la información del lead asociado al business
            $sumarizedDataLead = [
                'name' => $request->get('name'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'states_id' => $request->get('state'),
                'cms_users_id' => $request->get('assign_to'),
                'updated_at' => Carbon::now(config('app.timezone')),
            ];
            DB::table('leads')->where('id',$request->get('lead_id'))->update($sumarizedDataLead);

            //Adicionar "Recent Activity" a la creación del business
            DB::table('leads_activities')->insert([
                'leads_id'=>$lead_id,
                'description'=>'The quote: '.$request->get('business_name').', was added/edited by: '.CRUDBooster::myName(),
                'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
            ]);

            //Creamos los pasos por defecto (si no existen)
            //Comprobamos existencia inicialmente
            $exists_business_stages =  DB::table('business_stages')
                ->where('business_id',$request->get('business_id'))->first();
            //Si no existe creamos las stages por defecto
            if (count($exists_business_stages) == 0) {
                $stages =  DB::table('stages')->where('stages_groups_id',$request->get('stages_group'))->get();

                foreach ($stages as $stage) {
                    //Primera etapa por defecto
                    if ($stage->number == 1) {
                        $sumarizedDataBusinessStages = [
                            'business_id' => $request->get('business_id'),
                            'stages_id' => $stage->id,
                            'notes' => null,
                            'files' => null,
                            'is_completed' => 1,
                            'created_at' => Carbon::now(config('app.timezone')),
                        ];
                        DB::table('business_stages')->insert($sumarizedDataBusinessStages);
                    } else {
                        $sumarizedDataBusinessStages = [
                            'business_id' => $request->get('business_id'),
                            'stages_id' => $stage->id,
                            'notes' => null,
                            'files' => null,
                            'is_completed' => 0,
                            'created_at' => Carbon::now(config('app.timezone')),
                        ];
                        DB::table('business_stages')->insert($sumarizedDataBusinessStages);
                    }
                }
            }

            //Redireccionamos al lead que creo el business
            CRUDBooster::redirect(CRUDBooster::adminPath("business/detail/$business_id"),trans("crudbooster.text_open_edited_business"));
        }

        //Se obtienen todos los productos existentes
        public function getProducts() {
            $data = DB::table('products')->where('deleted_at', null)->get();
            return $data;
        }

        //Se obtienen el producto dado su "id"
        public function getProduct(\Illuminate\Http\Request $request) {
            return DB::table('products')->where('id', $request->get('id'))->get();
        }

        public function getProduct_delete($id) {
	        //Obtengo la info del producto asociado a la quote
            $product_business = DB::table('business_products')->where('id', $id)->first();

	        //Repongo los productos del stock
            $product = DB::table('products')->where('id', $product_business->products_id)->first();

            DB::table('products')->where('id', $product_business->products_id)->update(['stock'=>  $product->stock + $product_business->quantity]);

	        //Elimino los productos asociados a la quote
            DB::table('business_products')->where('id', $id)->delete();

            CRUDBooster::redirect(CRUDBooster::adminPath('business/edit/'.$product_business->business_id),trans("crudbooster.text_business_update"));
        }

	}