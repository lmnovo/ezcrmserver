<div class="modal fade" role="dialog" id="newProductModal" >
    <div class="modal-dialog modal-lg" role="document"  style=" width: 90%">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{trans('crudbooster.add_product')}}</h4>
            </div>

            {!! Form::open(array('id' => 'newProduct_form', 'route' => 'ajaxAddProduct','enctype' => 'multipart/form-data', 'class' => 'form-horizontal')) !!}

            <input type="hidden" name="business_id" value="{{$id}}" />
            <input type="hidden" id="product_id" name="product_id" value="" />

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="appliance" class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.name')}}*</label>
                            <div class="col-md-9 col-xs-12 col-sm-9">
                                {{--<input required class="form-control required" id="product_name" name="product_name"  placeholder="{{trans('crudbooster.name')}}" type="text"/>--}}
                                <select class="form-control" data-placeholder="{{trans('crudbooster.select_data')}}" id="product_name" name="product_name" style="width: 100%" required="required">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.description')}}*</label>
                            <div class="col-md-9 col-xs-12 col-sm-9">
                                <textarea required rows="6" class="form-control required" id="product_description" name="product_description" placeholder="{{trans('crudbooster.description')}}"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.buy_price')}}*</label>
                            <div class="col-md-9">
                                <input type="text" title="{{trans('crudbooster.buy_price')}}" required class="form-control number min:0" placeholder="0.00" name="product_buy_price" id="product_buy_price" value="">
                                <div class="text-danger"></div>
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.sell_price')}}*</label>
                            <div class="col-md-9">
                                <input type="text" title="{{trans('crudbooster.sell_price')}}" required class="form-control number min:0" placeholder="0.00" name="product_sell_price" id="product_sell_price" value="">
                                <div class="text-danger"></div>
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.weight')}}</label>
                            <div class="col-md-9">
                                <input class="form-control number min:0" id="product_weight" name="product_weight" value="0.00" type="text"/>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-5">
                            <img style="width: 100%; height: 400px;" id="product_photo" class="profile-user-img img-responsive img-bordered" src="<?php echo e(asset('assets/images/products/image-not-found.png')); ?>" alt="Image">

                            {{--{!! Form::file('image', array('class' => 'image')) !!}--}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="">{{trans('crudbooster.add')}}</button>
            </div>

            {!! Form::close() !!}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>