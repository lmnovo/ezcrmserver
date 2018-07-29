<div class='panel panel-default'>
    <div class='panel-heading' style="background-color: #337ab7; color: white;">
        <strong><i class="fa fa-product-hunt"></i> {{trans('crudbooster.total_summary')}} </strong>
    </div>
    <div class="panel-body">

        <div class="row" style="padding-top: 15px;">
            <div class="col-md-6">
                <label for="resumen_appliance">{{trans('crudbooster.products')}}</label>
                <input class="form-control" id="resumen_products" name="resumen_products" readonly="" value="{{$total}}"/>
            </div>
            <div class="col-md-6">
                <label for="resumen_appliance">{{trans('crudbooster.products_tax')}}</label>
                <input class="form-control" id="products_tax" name="products_tax" readonly="" value="0.00" />
            </div>
        </div>

        <div class="row" style="padding-top: 15px;">
            <div class="col-md-12">
                <label  for="">{{trans('crudbooster.description')}}</label>
                <textarea type="text" class="form-control" id="description_products" name="description_products" placeholder="Description"  value="" ></textarea>
            </div>
        </div>

        <div class="row" style="padding-top: 15px;">
            <div class="col-md-6">
                <label id="label_item" for="budget">{{trans('crudbooster.discount')}}</label>
                <input type="text" class="form-control" id="discount" name="discount"  value="<?php echo !$business->discount == 0 ? $business->discount : "0.00" ?>" placeholder="Discount" required >
            </div>
            <div class="col-md-6">
                <label for="gtotalquote" >{{trans('crudbooster.subtotal_ammount')}}</label>
                <input class="form-control" id="subtotal_ammount" name="subtotal_ammount" readonly="" value="0.00"/>
            </div>
        </div>

        <div class="row" style="padding-top: 15px;">

            <div class="col-md-6">
                <label for="tax"  id="label_item">{{trans('crudbooster.total_tax')}}</label>
                <input class="form-control" id="total_tax" name="total_tax"  readonly="" value="0.00"/>
            </div>
            <div class="col-md-6">
                <label for="gtotalquote" >{{trans('crudbooster.total_ammount')}}</label>
                <input class="form-control" id="total_ammount" name="total_ammount" readonly="" value="0.00"/>
            </div>
        </div>
    </div>

</div>