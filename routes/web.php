<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('ajaxImageUpload', ['uses'=>'AjaxImageUploadController@ajaxImageUpload']);
    Route::post('ajaxImageUpload', ['as'=>'ajaxImageUpload','uses'=>'ImageUploadController@imageUploadPost']);

    Route::post('ajaxAddProduct', ['as'=>'ajaxAddProduct','uses'=>'ImageUploadController@addProductPost']);
    Route::post('ajaxAddNewProduct', ['as'=>'ajaxAddNewProduct','uses'=>'ImageUploadController@addNewProductPost']);

    Route::get('/', function () {
        return view('welcome');
    });

    //Rutas de Traducciones
    Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('tour_default');
    });

    Route::get('file','FileController@create');
    Route::post('file','FileController@store');

    Route::get('/register_client', function () {
        $maxId = DB::table('cms_users')->select(\Illuminate\Support\Facades\DB::raw('MAX(id) as id'))->first();
        $maxId = $maxId->id + 1;

        $sumarizedData = [
            'id' => $maxId,
            'name' => request('name').' '.request('lastname'),
            'email' => request('email'),
            'fullname' => request('name').' '.request('lastname'),
            'id_cms_privileges' => 1,
            'status' => 'Active',
            'password' => bcrypt(request('password'))
        ];

        DB::table('cms_users')->insert($sumarizedData);

        return redirect()->route('getLogin');
    });

    Route::get('image-upload',['as'=>'image.upload','uses'=>'ImageUploadController@imageUpload']);
    Route::post('image-upload',['as'=>'image.upload.post','uses'=>'ImageUploadController@imageUploadPost']);

    Route::get('crm/tour/general', function () { return view('tour_general'); });
    Route::get('crm/tour/add_lead', function () { return view('tour_add_lead'); });
    Route::get('crm/tour/edit_lead', function () { return view('tour_edit_lead'); });
    Route::get('crm/tour/add_quote', function () { return view('tour_add_quote'); });
    Route::get('crm/tour/add_client', function () { return view('tour_add_client'); });
    Route::get('crm/tour/sending_campaings', function () { return view('tour_sending_campaigns'); });
    Route::get('crm/tour/phases', function () { return view('tour_phases'); });
    Route::get('crm/tour/lead', function () { return view('lead_create_tour'); });
    Route::get('crm/tour/product', function () { return view('tour_add_product'); });
    Route::get('crm/tour/user', function () { return view('tour_delete_user'); });
    Route::get('crm/tour/configuration', function () { return view('tour_configuration'); });
    Route::get('crm/tour/first_steps', function () { return view('tour_first_steps'); });
    Route::get('crm/tour/menu_management', function () { return view('tour_menu_management'); });
    Route::get('crm/tour/configuration_privileges', function () { return view('tour_privileges_configuration'); });
    Route::get('crm/tour/proyects_management', function () { return view('tour_proyects_management'); });

    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);

    Route::get('/crm/task_calendar', function () {
        $events = [];
        $data = \App\EazyTask::all();
        $color = '#000';

        $user_id = (CRUDBooster::myId());

        if($data->count()) {
            foreach ($data as $key => $value) {

                // Obtener el color del tipo de tarea a la q pertenece dicha tarea
                $color = \Illuminate\Support\Facades\DB::table('eazy_task_type')
                    ->select(DB::raw('colors.description'))
                    ->join('eazy_tasks', 'eazy_tasks.task_type_id', '=', 'eazy_task_type.id')
                    ->join('colors', 'colors.id', '=', 'eazy_task_type.colors_id')
                    ->where('eazy_tasks.id', '=', $value->task_type_id)
                    ->first();

                $events[] = \MaddHatter\LaravelFullcalendar\Facades\Calendar::event(
                    $value->name.' ('.$value->description.')',
                    true,
                    new \DateTime($value->date),
                    new \DateTime($value->created_at.' +1 day'),
                    false,
                    // Add color and link on event
                    [
                        'color' => $color->description,
                        'url' => 'http://127.0.0.1:8000/crm/eazy_tasks/detail/'.$value->id,
                    ]
                );
            }
        }

        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($events)->setOptions([
            'header' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'month,agendaWeek,agendaDay,listMonth',
            ],
            'eventLimit' => true,
        ]);

        $taskTypes = \Illuminate\Support\Facades\DB::table('eazy_task_type')
            ->select(\Illuminate\Support\Facades\DB::raw('eazy_task_type.name'), 'colors.name as color')
            ->join('colors', 'colors.id', '=', 'eazy_task_type.colors_id')
            ->get();

        return view('calendar.calendar', compact('calendar', 'taskTypes'));
    });

    //Route::get('/admin/wizard/statistics', function () {
    Route::get('/crm/wizard', function () {

        $dashboard = CRUDBooster::sidebarDashboard();
        if($dashboard && $dashboard->url) {
            return redirect($dashboard->url);
        }



        return view('statistics/index', compact('data'));
    });

    /*Permite deshabilitar el envío de emails a los Leads*/
    Route::get('unsubscribed/leads/{email}', function () {
            $email = request('email');

            //Poner el lead como "No Suscrito" y poner el tipo como "Lost"
            DB::table('leads')->where('email','LIKE','%'.$email.'%')->update(['subscribed' => 0]);

            //Mandar email al lead "No suscrito" como confirmación
            //Send Email with notification End Step
            $html = trans('crudbooster.email_subscribed');
            $subject = trans('crudbooster.subscription');

            \Mail::send("crudbooster::emails.blank", ['content' => $html], function ($message) use ($email, $subject) {
                $message->priority(1);
                $message->to($email);
                $message->subject($subject);
            });

            return view('tour_default');
        });


});

