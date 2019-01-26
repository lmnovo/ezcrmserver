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
        //Obtener la cantidad en stock del producto solicitado
        $stock_product = DB::table('products')->where('id', request('product_id'))->first();

        //Reducimos la cantidad solicitado del stock del producto solicitado
        DB::table('products')->where('id', request('product_id'))->update(['stock' => $stock_product->stock-request('product_quantity')]);

        //Comprobar si existe el producto agregado para dicho business
        $exists = DB::table('business_products')
            ->where('business_id', request('business_id'))
            ->where('products_id', request('product_id'))
            ->first();

        //Si ya existe el producto
        if (count($exists)) {
            $quantity = $exists->quantity + request('product_quantity');
            DB::table('business_products')
                ->where('business_id', request('business_id'))
                ->where('products_id', request('product_id'))
                ->update(['quantity' => $quantity]);
        } else {
            $sumarizedData = [
                'business_id' => request('business_id'),
                'products_id' => request('product_id'),
                'quantity' => request('product_quantity'),
                'created_at' => Carbon::now(config('app.timezone')),
            ];

            DB::table('business_products')->insert($sumarizedData);
        }

        CRUDBooster::redirect(CRUDBooster::adminPath('business/edit/'.request('business_id')),trans("crudbooster.text_open_edit_quote"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addNewProductPost()
    {
        //dd(request()->all());
        //Si existe la imagen, si no está vacía
        $imageName = null;
        if (!empty(request('image'))) {
            request()->validate([
                'image' => 'required|file|mimes:jpg,png,jpeg,gif,bmp,pdf,xls,xlsx,doc,docx,txt,zip,rar,7z',
            ]);

            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
        }

        $sumarizedData = [
            'name' => request('new_product_name'),
            'description' => request('new_product_description'),
            'buy_price' => request('new_product_buy_price'),
            'sell_price' => request('new_product_sell_price'),
            'weight' => request('new_product_weight'),
            'photo' => "images/".$imageName,
            'stock' => request('new_product_stock'),
            'created_at' => Carbon::now(config('app.timezone')),
        ];

        DB::table('products')->insert($sumarizedData);

        CRUDBooster::redirect(CRUDBooster::adminPath('business/edit/'.request('business_id')),trans("crudbooster.text_open_edit_quote"));
    }


}