<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use CRUDBooster;

class ImageUploadController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function imageUpload()
    {
        return view('imageUpload');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function imageUploadPost()
    {
        request()->validate([
            'image' => 'required|file|mimes:jpg,png,jpeg,gif,bmp,pdf,xls,xlsx,doc,docx,txt,zip,rar,7z',
        ]);

        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        return back()
            ->with('success', 'You have successfully upload file.')
            ->with('image', $imageName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addProductPost()
    {
        //Comprobar si existe el producto agregado para dicho business
        $exists = DB::table('business_products')
            ->where('business_id', request('business_id'))
            ->where('products_id', request('product_id'))
            ->first();

        //Si ya existe el producto
        if (count($exists)) {
            $quantity = $exists->quantity + 1;
            DB::table('business_products')
                ->where('business_id', request('business_id'))
                ->where('products_id', request('product_id'))
                ->update(['quantity' => $quantity]);
        } else {
            $sumarizedData = [
                'business_id' => request('business_id'),
                'products_id' => request('product_id'),
                'quantity' => 1,
                'created_at' => Carbon::now(config('app.timezone')),
            ];

            DB::table('business_products')->insert($sumarizedData);
        }

        CRUDBooster::redirect(CRUDBooster::adminPath('business/edit/'.request('business_id')),trans("crudbooster.text_open_edit_quote"));
    }
}