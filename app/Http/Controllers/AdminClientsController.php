<?php namespace App\Http\Controllers;

	use Carbon\Carbon;
    use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PDF;

	class AdminClientsController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "leads";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Last Name","name"=>"lastname"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Phone","name"=>"phone"];
			$this->col[] = ["label"=>"Lead Type","name"=>"leads_type_id","join"=>"leads_type,name"];
			$this->col[] = ["label"=>"Assigned To","name"=>"cms_users_id","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Address","name"=>"address"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
            $this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Last Name','name'=>'lastname','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:leads','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'text','validation'=>'required','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Address','name'=>'address','type'=>'googlemaps','validation'=>'min:1|max:255','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Photo','name'=>'photo','type'=>'upload','validation'=>'image|max:3000','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Assign To','name'=>'cms_users_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'cms_users,name'];
            $this->form[] = ['label'=>'Latitude','name'=>'latitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Longitude','name'=>'longitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter'];
			//$this->form[] = ['label'=>'Last Name','name'=>'lastname','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter'];
			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Telephone','name'=>'telephone','type'=>'text','validation'=>'required','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'ZipCode','name'=>'zip_code','type'=>'text','width'=>'col-sm-10','placeholder'=>'You can enter letters and numbers'];
			//$this->form[] = ['label'=>'State','name'=>'state','type'=>'select2','width'=>'col-sm-10','datatable'=>'states,name'];
			//$this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'string|min:3|max:200','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Address','name'=>'address','type'=>'googlemaps','validation'=>'min:1|max:255','width'=>'col-sm-10','latitude'=>'latitude','longitude'=>'longitude'];
			//$this->form[] = ['label'=>'Photo','name'=>'photo','type'=>'upload','validation'=>'image|max:3000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Type','name'=>'estado','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'customer_type,name'];
			//$this->form[] = ['label'=>'Assign To','name'=>'id_usuario','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'cms_users,name'];
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
            //$this->sub_module[] = ['label'=>'Phases','path'=>'fases','foreign_key'=>'customers_id','button_color'=>'primary','button_icon'=>'fa fa-book','parent_columns'=>'name'];


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
            //$this->addaction[] = ['label'=>'Quotes','url'=>CRUDBooster::mainpath('quotes/[id]'),'icon'=>'fa fa-pencil-square-o text-normal','color'=>'success'];


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
                
                    //Agregar nueva nota
                    $('#add_note').on('click',function(){
                        var name = $('#note_value').val();
                        var customers_id = $('#note_lead_id').val();
        
                        $.ajax({
                            url: '../addnote',
                            data: \"name=\"+name+\"&customers_id=\"+customers_id,
                            type:  'get',
                            dataType: 'json',
                            success : function(data) {
                                window.location.href = 'http://127.0.0.1:8000/crm/customers25/detail/'+customers_id;                                                        
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
                $query->where(['is_client' => 1])
                    ->where('cms_users_id', $user_id);
            } else {
                $query->where(['is_client' => 1]);
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
	        //Your code here

            /*$states = DB::table('states')->where('id', $postdata['state'])->first();
            $postdata['state'] = $states->abbreviation;*/

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

            $query = DB::table('clients')->where('id',$id)->first();
            $state = DB::table('states')->where('id', $query->state)->first();
            DB::table('clients')->where('id', $query->id)->update(['state'=>$state->abbreviation]);

            /*$query = DB::table('clients')->where('id', $id)->first();
            $states = DB::table('states')->where('id', $query->state)->first();
            DB::table('clients')->where('id', $id)->update(['state'=>$states->abbreviation]);*/
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

        public function getEdit($id) {
            //Create an Auth
            if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.text_open_edit_quote"));
            }

            $data = [];
            $data['page_title'] = 'Editing the Quote';
            $data['id'] = $id;
            $data['products_type'] = DB::table('type')->get();
            $data['lead'] = DB::table('clients')->where('id',$id)->first();
            $data['states'] = DB::table('states')->get();
            $data['estados'] = DB::table('customer_type')->get();
            $data['users'] = DB::table('cms_users')->get();

            $this->cbView('clients.edit',$data);
        }

        public function getEditsaveclient(\Illuminate\Http\Request $request) {
            //dd($request->all());

            $sumarizedData = [
                'name' => $request->get('name'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
                'telephone' => $request->get('telephone'),
                'zip_code' => $request->get('zip_code'),
                'state' => $request->get('state'),
                'city' => $request->get('city'),
                'address' => $request->get('address'),
                'latitude' => $request->get('input-latitude-address'),
                'longitude' => $request->get('input-longitude-address'),
                'photo' => $request->get('photo'),
                'estado' => $request->get('estado'),
                'id_usuario' => $request->get('id_usuario'),
            ];
            DB::table('clients')->where('id', $request->get('lead_id'))->update($sumarizedData);

            CRUDBooster::redirect(CRUDBooster::adminPath('customers25/detail/'.$request->get('lead_id')),trans("crudbooster.text_lead_added"));
        }

        //Obtiene el listado de usuarios existentes en bd
        public function getUsers() {
            $data = DB::table('cms_users')
                ->select('id','name')
                ->get();

            return $data;
        }

        //Permite editar la información del usuario en el lead
        public function getEdituser(\Illuminate\Http\Request $request) {
            DB::table('clients')->where('id', $request->get('id_client'))->update([$request->get('campo') => $request->get('valor')]);
            $data = DB::table('cms_users')->where('id', $request->get('valor'))->first();

            return $data->name;
        }

        public function getAddsave(\Illuminate\Http\Request $request) {

            $date = $request->get('date');
            $date = explode("/", $date);
            $date = $date[2].'-'.$date[0].'-'.$date[1];
            $date = Carbon::createFromFormat("Y-m-d", $date);

            $sumarizedData = [
                'date' => $date,
                'created_at' => Carbon::now(config('app.timezone')),
                'name' => $request->get('name'),
                'clients_id' => $request->get('lead_id'),
            ];

            DB::table('eazy_tasks_clients')->insertGetId($sumarizedData);

            return 1;
        }

        public function getAddnote(\Illuminate\Http\Request $request) {
            $name = $request->get('name');
            $customers_id = $request->get('customers_id');

            $sumarizedData = [
                'created_at' => Carbon::now(config('app.timezone')),
                'name' => $name,
                'customers_id' => $customers_id,
                'is_client' => 1,
            ];

            DB::table('eazy_notes')->insertGetId($sumarizedData);
            DB::table('clients')->where('id', $request->get('customers_id'))->update(['notes'=>1]);

            return 1;
        }

	    public function getEditsave(\Illuminate\Http\Request $request) {
            $id = $request->get('quote_id');

            $bill_contact_name = $request->get('bill_contact_name');
            $bill_states = $request->get('bill_states');
            $bill_city = $request->get('bill_city');

            $ship_contact_name = $request->get('ship_contact_name');
            $ship_states = $request->get('ship_states');
            $ship_city = $request->get('ship_city');

            $orders = DB::table('user_trucks')->where('id',$id)->first();
            $orders_detail = DB::table('truck_items')->where('id_truck',$id)->get();

            $customer =  DB::table('account')->where('id', $orders->id_account)->first();
            $setting  =  DB::table('settings')->where('id', 1)->first();
            $state    =  DB::table('states')->where('id', $customer->states_id)->first();
            $total = 0;

            foreach ($orders_detail as $items) {
                $total += $items->price * $items->cant;
            }

            $invoiceSumarizedData = [
                'contact_name' => $customer->name.' '.$customer->lastname,
                'invoice_date' => Carbon::now(config('app.timezone')),
                'owner' => $setting->name,
                'state_client' => $customer->state,
                'id_user' => $customer->id_usuario,
                'street' => $customer->address,
                'city' => $customer->city,
                'tax' => $orders->truck_tax + $orders->tax_item,
                'discount' => $orders->discount,
                'bill_street' => $customer->address,
                'bill_name' => $customer->name.' '.$customer->lastname,
                'bill_city' => $customer->city,
                'bill_state' => $customer->state,
                'mail' => $customer->email,
                'address_client' => $customer->address,
                'address_bill' => $customer->address
            ];

            $lastId = DB::table('invoice')->insertGetId($invoiceSumarizedData);
            DB::table('account')->where('id', $customer->id)->update(['is_client' => 1]);
            DB::table('user_trucks')->where('id', $id)->update(['is_invoice' => 1]);

            $product_type =  DB::table('products_type')->where('id', $orders->interesting)->first();
            $state =  DB::table('estado')->where('id', $orders->id_type)->first();
            $size =  DB::table('sizes')->where('id', $orders->id_size)->first();
            $product =  DB::table('products')->where('id', $orders->build_out)->first();

            if (!empty($orders->registration)) {
                $detailSumarizedDataRegistration = [
                    'id_invoice' => $lastId,
                    'product' => 'Registration',
                    'descripcion' => 'Vehicle Registration',
                    'price' => $orders->registration,
                    'cant' => 1
                ];
                DB::table('invoice_items')->insert($detailSumarizedDataRegistration);
            }

            $detailSumarizedData = [
                'id_invoice' => $lastId,
                'product' => $product_type->name,
                'descripcion' => 'TYPE: '.$state->name.' SIZE: '.$size->name,
                'price' => $orders->price_item,
                'cant' => 1
            ];
            DB::table('invoice_items')->insert($detailSumarizedData);

            $detailBuildoutSumarizedData = [
                'id_invoice' => $lastId,
                'product' => $product->name,
                'descripcion' => $product->description,
                'price' => $product->sell_price,
                'cant' => 1
            ];
            DB::table('invoice_items')->insert($detailBuildoutSumarizedData);

            foreach ($orders_detail as $items) {
                $detailApplianceSumarizedData = [
                    'id_invoice' => $lastId,
                    'product' => $items->item_category.'-'.$items->item_name.'-'.$items->item_subcategory,
                    'descripcion' => $items->descripcion_details,
                    'price' => $items->price,
                    'cant' => $items->cant
                ];
                DB::table('invoice_items')->insert($detailApplianceSumarizedData);
            }

            CRUDBooster::redirect(CRUDBooster::adminPath("invoice"),trans("crudbooster.text_save_invoice"));
        }

	    //By the way, you can still create your own method in here... :)
        //Permite convertir el Lead asociado a una Quote en un Client
        public function getQuotes($id) {
            //Create an Auth
            if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $data = [];
            $data['page_title'] = 'Client Information';
            $data['client'] =  DB::table('user_trucks')
                ->join('account', 'account.id', '=', 'user_trucks.id_account')
                ->where('user_trucks.id_account', $id)->first();

            $data['quotes_closed'] = DB::table('user_trucks')->where('id_account', $id)->where('is_closed', 1)->where('is_invoice', 0)->get()->toArray();
            $data['quotes_opened'] = DB::table('user_trucks')->where('id_account', $id)->where('is_closed', -1)->where('is_invoice', 0)->get()->toArray();

            //Please use cbView method instead view method from laravel
            $this->cbView('clients.show',$data);
        }

        public function getChangeQuotes($id, $close = false) {

            $quotes = DB::table('orders')->where('id', $id)->first();

	        //Si la Quote se desea Cerrar
	        if ($quotes->is_closed == 0) {
                DB::table('orders')->where('id', $id)->update(['is_closed' => 1]);
            }
            //Si la Quote se desea Abrir
            else {
                DB::table('orders')->where('id', $id)->update(['is_closed' => 0]);
            }

            $quote = DB::table('orders')->where('id', $id)->first();

            $data = [];
            $data['page_title'] = 'Client Information';
            $data['client'] =  DB::table('orders')
                ->join('customers', 'customers.id', '=', 'orders.customers_id')
                ->where('customers_id', $id)->first();

            $data['quotes_closed'] = DB::table('orders')->where('customers_id', $id)->where('is_closed', 1)->where('is_invoice', 0)->get()->toArray();
            $data['quotes_opened'] = DB::table('orders')->where('customers_id', $id)->where('is_closed', 0)->where('is_invoice', 0)->get()->toArray();

            CRUDBooster::redirect(CRUDBooster::mainpath("quotes/$quotes->customers_id"),trans("crudbooster.text_change_quotes"));
        }

        //Permite convertir el Lead asociado a una Quote en un Client
        public function getCreateInvoice($id) {

	        $orders = DB::table('user_trucks')->where('id',$id)->first();
            $client = DB::table('account')->where('id',$orders->id_account)->first();
            $orders_detail = DB::table('truck_items')->where('id_truck',$id)->get();
            $dateActual = Carbon::now(config('app.timezone'));

            $data = [];
            $data['invoice'] = DB::table('user_trucks')
                ->join('account', 'account.id', '=', 'user_trucks.id_account')
                ->where('user_trucks.id', $id)->first();

            $data['settings'] = DB::table('settings')->first();
            $data['customer_information'] = $client;
            $data['states_id'] = $client->state;
            $data['order_id'] = $id;
            $data['dateActual'] = $dateActual;
            $data['orders_detail'] = $orders_detail;
            $data['states'] = DB::table('states')->get();

            /*$data['appliances'] = $appliances;*/
            $totalFinal = 0;
            foreach ($orders_detail as $order_detail) {
                $totalFinal += $order_detail->price * $order_detail->cant;
            }

            $data['totalFinal'] = $totalFinal;

            $this->cbView('clients.invoice',$data);
        }

        public function getSaveInvoice($id) {

            /*$order = DB::table('orders')->where('id',$id)->get();
            $pdf = PDF::loadView('pdf.pdf', compact('order'));
            return $pdf->download('invoice.pdf');*/


            $order = DB::table('user_trucks')->where('id',$id)->first();
            //dd($order);

            //$customer = DB::table('customers')->where('id', $order->customers_id)->first();
            $customer = DB::table('account')->where('id', $order->id_account)->first();
            $settings = DB::table('settings')->where('id', 1)->first();

            $items = [
                'contact_name' => $customer->name.' '.$customer->lastname,
                'invoice_date' => Carbon::now(config('app.timezone')),
                'owner' => $settings->name,
                'id_user' => $order->cms_users_id,
                'tax' => $order->tax,
                'mail' => $customer->email,
                'address_client' => $customer->addresse
            ];


            $lastId = DB::table('invoice')->insertGetId($items);

            $orders_detail = DB::table('orders_detail')->where('orders_id',$id)->get();

            foreach ($orders_detail as $value) {
                $product = DB::table('products')->where('id',$value->products_id)->first();

                //Buscar como obtener ultimo ID

                $invoice_items = [
                    'id_invoice' => $lastId,
                    'product' => $product->name,
                    'descripcion' => $product->description,
                    'price' => $product->sell_price,
                    'cant' => $value->quantity
                ];

                DB::table('invoice_items')->insert($invoice_items);
            }

            CRUDBooster::redirect(CRUDBooster::adminPath("invoice"),trans("crudbooster.text_save_invoice"));
        }

        //Mostrar el perfil de un Client dado su id
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
            $data['page_title'] = 'Client Profile';
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

        public function getSendSms($id) {

            $to = null;

            if(gettype($id) == 'array') {
                $leadsSelected = DB::table('account')->whereIn('id',$id)->get();

                foreach ($leadsSelected as $item) {
                    if (!empty($item->telephone)) {
                        $to[] = $item->telephone;
                    }
                }

            }
            else {
                $leadsSelected = DB::table('account')->where('id',$id)->first();

                if (!empty($leadsSelected->telephone)) {
                    $to[] = $leadsSelected->telephone;
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

            $lastId = DB::table('settings_campaigns')->insertGetId($sumarizedData);

            //Open Edit Quote
            CRUDBooster::redirect(CRUDBooster::adminPath('settings_campaigns/edit/'.$lastId),trans("crudbooster.text_open_edit_campaign"));

        }

        public function getSendEmail($id) {
            $emails = [];

            if(gettype($id) == 'array') {
                $customers = DB::table('clients')->whereIn('id', $id)->get();

                foreach ($customers as $item) {
                    if (!empty($item->email)) {
                        $emails[] = $item->email;
                    }
                }

            } else {
                $customers = DB::table('clients')->where('id', $id)->first();

                if (!empty($customers->email)) {
                    $emails[] = $customers->email;
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

            $lastId = DB::table('settings_campaigns')->insertGetId($sumarizedData);

            //Open Edit Quote
            CRUDBooster::redirect(CRUDBooster::adminPath('settings_campaigns/edit/'.$lastId),trans("crudbooster.text_open_edit_campaign"));

        }





    }