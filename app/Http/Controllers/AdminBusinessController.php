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
			$this->limit = "10";
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
			$this->table = "business";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Assigned To","name"=>"cms_users_id","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Lead Name","name"=>"leads_id","join"=>"leads,name"];
			$this->col[] = ["label"=>"Date Limit","name"=>"date_limit"];
			$this->col[] = ["label"=>"Total","name"=>"total"];
			$this->col[] = ["label"=>"Stage","name"=>"stages_id","join"=>"stages,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Assign To','name'=>'cms_users_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			$this->form[] = ['label'=>'Stage','name'=>'stages_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'stages,name'];
			$this->form[] = ['label'=>'Date Limit','name'=>'date_limit','type'=>'date','width'=>'col-sm-10'];
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
                                window.location.href = 'http://127.0.0.1:8000/crm/business/edit/'+leads_id;                                                        
                            }
                         });  
                    });
                    
                    $('#addTasks').on('click',function(){
                        $('#taskLeadModal').modal('show'); 
                    });
                    
                    $('#addSaveTask').on('click',function(){
                        var name = $('#name').val();
                        var date = $('#date').val();
                        var lead_id = $('#lead_id').val();
                        
                        $.ajax({
                            url: '../addsave',
                            data: \"name=\"+$('#name').val()+\"&date=\"+$('#date').val()+\"&lead_id=\"+$('#lead_id').val(),
                            type:  'get',
                            dataType: 'json',
                            success : function(data) {
                               window.location.href = 'http://127.0.0.1:8000/crm/account/detail/'+lead_id; 
                               $('#taskLeadModal').modal('hide');
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
	        //Your code here
	            
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
	        //Your code here

	    }


        public function getEdit($id) {
            //Create an Auth
            if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.text_open_edit_quote"));
            }

            $data = [];
            $data['page_title'] = 'Editing the Negotiation';
            $data['id'] = $id;

            $data['notes'] = DB::table('notes')->where('leads_id', $id)->where('deleted_at', null)->get();

            $data['tasks'] = DB::table('eazy_tasks')
                ->where('eazy_tasks.deleted_at', null)
                ->where('assign_to_id', $id)
                ->where('type', 'business')
                ->get();

            $data['business'] = \Illuminate\Support\Facades\DB::table('business')
                ->select(DB::raw('leads.name as name'), 'leads.lastname as lastname',
                    'business.total', 'business.date_limit', 'cms_users.fullname as fullname',
                    'stages.name as stage_name', 'stages.number as stage_number')
                ->join('leads', 'leads.id', '=', 'business.leads_id')
                ->join('cms_users', 'cms_users.id', '=', 'business.cms_users_id')
                ->join('stages', 'stages.id', '=', 'business.stages_id')
                ->where('business.id', '=', $id)
                ->first();

            $this->cbView('business.edit',$data);
        }


        //Agregar nueva nota de tipo Lead
        public function getAddnote(\Illuminate\Http\Request $request) {
            $name = $request->get('name');
            $leads_id = $request->get('leads_id');

            $sumarizedData = [
                'created_at' => Carbon::now(config('app.timezone')),
                'name' => $name,
                'leads_id' => $leads_id,
            ];

            DB::table('notes')->insertGetId($sumarizedData);

            return 1;
        }

        //Agregar Tarea de tipo Lead
        public function getAddsave(\Illuminate\Http\Request $request) {

            $date = $request->get('date');
            $date = explode("/", $date);
            $date = $date[2].'-'.$date[0].'-'.$date[1];
            $date = Carbon::createFromFormat("Y-m-d", $date);

            $sumarizedData = [
                'created_at' => $date,
                'name' => $request->get('name'),
                'assign_to_id' => $request->get('lead_id'),
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

	}