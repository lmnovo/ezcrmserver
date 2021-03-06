<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminEazyTasks1Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "eazy_tasks";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
            $this->col[] = ["label"=>"Assigned to","name"=>"customers_id","join"=>"account,name"];
			$this->col[] = ["label"=>"Date","name"=>"date"];
            $this->col[] = ["label"=>"Description","name"=>"description"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter'];
			$this->form[] = ['label'=>'Date','name'=>'date','type'=>'date','validation'=>'required|date_format:Y-m-d','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Assign to','name'=>'customers_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'account,name'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter'];
			//$this->form[] = ['label'=>'Description','name'=>'description','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Date','name'=>'date','type'=>'date','validation'=>'required|date_format:Y-m-d','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Task Type','name'=>'task_type_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'eazy_task_type,name'];
			//$this->form[] = ['label'=>'Assign to','name'=>'customers_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'account,name'];
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
            $this->index_button[] = ['label'=>'Show Calendar','url'=>CRUDBooster::adminPath($slug="task_calendar"),"icon"=>"fa fa-calendar"];



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
            $tasks = DB::table('eazy_tasks')->where('id', $id)->first();
            $customers = DB::table('account')->where('id', $tasks->customers_id)->first();

            $html = '<p>Task Name: '.$tasks->name.'</p><p>Task Description: '.$tasks->description.'</p><p>Task Date: '.$tasks->date.'</p>';
            $subject = 'New Task Assigned';
            $to[] = $customers->email;
            $template = CRUDBooster::first('cms_email_templates',['id'=>1]);

            \Mail::send("crudbooster::emails.blank",['content'=>$html],function($message) use ($to,$subject,$template) {
                $message->priority(1);
                $message->to($to);

                if($template->from_email) {
                    $from_name = ($template->from_name)?:CRUDBooster::getSetting('appname');
                    $message->from($template->from_email,$from_name);
                }

                if($template->cc_email) {
                    $message->cc($template->cc_email);
                }

                $message->subject($subject);
            });

            if($customers->is_client == 1) {
                CRUDBooster::redirect(CRUDBooster::adminpath("customers25/detail/$tasks->customers_id"),trans("crudbooster.text_task_added"));
            }
            else {
                CRUDBooster::redirect(CRUDBooster::adminpath("account/detail/$tasks->customers_id"),trans("crudbooster.text_task_added"));
            }

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
            $tasks = DB::table('eazy_tasks')->where('id', $id)->first();
            $customers = DB::table('account')->where('id', $tasks->customers_id)->first();

            $html = '<p>Task Name: '.$tasks->name.'</p><br><p>Task Description: '.$tasks->description.'</p><br><p>Task Date: '.$tasks->date.'</p><br>';
            $subject = 'Task Modified';
            $to[] = $customers->email;
            $template = CRUDBooster::first('cms_email_templates',['id'=>1]);

            \Mail::send("crudbooster::emails.blank",['content'=>$html],function($message) use ($to,$subject,$template) {
                $message->priority(1);
                $message->to($to);

                if($template->from_email) {
                    $from_name = ($template->from_name)?:CRUDBooster::getSetting('appname');
                    $message->from($template->from_email,$from_name);
                }

                if($template->cc_email) {
                    $message->cc($template->cc_email);
                }

                $message->subject($subject);
            });

            if($customers->contact_type == 1) {
                CRUDBooster::redirect(CRUDBooster::adminpath("customers25/detail/$tasks->customers_id"),trans("crudbooster.text_task_added"));
            }
            else {
                CRUDBooster::redirect(CRUDBooster::adminpath("account/detail/$tasks->customers_id"),trans("crudbooster.text_task_added"));
            }

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
            DB::table("eazy_tasks")->where("id",$id)->delete();
	    }



	    //By the way, you can still create your own method in here... :) 


	}