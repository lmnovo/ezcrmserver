<div class='panel panel-default'>
    <div class='panel-heading' style="background-color: #337ab7; color: white;">
        <strong><i class="fa fa-product-hunt"></i> {{trans('crudbooster.products')}} </strong>
    </div>

    <button style="margin-left: 20px; margin-top: 20px;" class="btn btn-success pull-left newProduct" type="button" ><i class="fa fa-product-hunt"></i> {{trans('crudbooster.add_product')}} </button>

    <div id="table_products" class="table-responsive hover" style="margin: 70px;">
        <table id="products" class="table table-striped table-responsive table-bordered" cellspacing="0">
            <thead>
            <tr>
                <th>{{trans('crudbooster.name')}}</th>
                <th>{{trans('crudbooster.description')}}</th>
                <th>{{trans('crudbooster.price')}}</th>
                <th>{{trans('crudbooster.quantity')}}</th>
                <th>{{trans('crudbooster.total')}}</th>
                <th style="width: 5%">{{trans('crudbooster.action')}}</th>
            </tr>
            </thead>
            <tbody >

            @foreach($products as $items)
                <tr role="row" class="odd">
                    <input id='id' type="hidden" value="{{ $items->id }}"/>
                    <td class="sorting_1">
                        <span class="editors hide"><select class="col-md-12 col-sm-12 editable form-control combo" ></select></span>
                        <span class="originals" id="tbl_sel_name">{{ $items->name }}</span>
                    </td>
                    <td>
                        <span class="editors hide"><select class="col-md-12 col-sm-12 editable form-control combo" ></select></span>
                        <span class="originals" id="tbl_sel_description">{{ $items->description }}</span>
                    </td>
                    <td>
                        <span class="editors hide"><select class="col-md-12 col-sm-12 editable form-control combo" ></select></span>
                        <span class="originals" id="tbl_sel_price">{{ $items->sell_price }}</span>
                    </td>
                    <td>
                        <span class="editors hide"><select class="col-md-12 col-sm-12 editable form-control combo" ></select></span>
                        <span class="originals" id="tbl_sel_price">{{ $items->quantity }}</span>
                    </td>
                    <td>
                        <span class="editors hide"><select class="col-md-12 col-sm-12 editable form-control combo" ></select></span>
                        <span class="originals" id="tbl_sel_price">{{ $items->quantity * $items->sell_price }}</span>
                    </td>
                    <td style="text-align: center">
                        <button class="btn btn-danger btn-xs" value="{{ $items->id }}" name="{{ $items->id }}" type="button" id="eliminar">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total($):</th>
                <th id="total_app" style="font-size: 16px"> {{ $total }}</th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>