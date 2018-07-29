<?php


namespace App\Http\Controllers;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use CRUDBooster;


class FileController extends Controller

{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'filename.*' => 'mimes:jpg,png,jpeg,gif,bmp,pdf,xls,xlsx,doc,docx,txt,zip,rar,7z'
        ]);

        if($request->hasfile('filename'))
        {
            $data = '';
            $cont = 0;
            foreach($request->file('filename') as $file)
            {
                //$name=$file->getClientOriginalName();
                $name = strtolower(time().$cont. '.' . $file->getClientOriginalExtension());
                $cont ++;
                $file->move(public_path().'/files/', $name);

                if ($data == '') {
                    $data = $name;
                }
                else {
                    $data = $data.';'.$name;
                }
            }
        }

        //Guardar información de Archivos en Base de Datos
        $sumarizedData = [
            'files' => $data,
            'updated_at' => Carbon::now(config('app.timezone')),
        ];

        DB::table('business_stages')->where('stages_id',request('stages_id'))->where('business_id',request('business_id'))->update($sumarizedData);

        $stage = DB::table('stages')->where('id',request('stages_id'))->first();
        $userLogin = CRUDBooster::myName();
        $business_id = request('business_id');

        if ($cont != 0) {
            //Crear "Recent Activity" del envío de Email
            DB::table('stages_activities')->insert([
                'stages_id'=>request('stages_id'),
                'description'=>$cont.' file(s) has been uploaded by: '.$userLogin,
                'business_id'=>request('business_id'),
                'created_at'=>Carbon::now(config('app.timezone'))->toDateTimeString(),
            ]);
        }

        //Open Edit Negotiation
        CRUDBooster::redirect(CRUDBooster::adminPath('business/detail/'.$business_id),trans("crudbooster.text_business_create"));
        //return back()->with('success', 'Your files has been successfully added');
    }



}