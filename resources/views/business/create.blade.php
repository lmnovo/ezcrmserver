@extends('crudbooster::admin_template')
@section('content')

    <script src='http://18.220.213.59/p/jquery-ui.custom.min.js'></script>
    <script src="http://18.220.213.59/p/jquery.ui.touch-punch.min.js"></script>
    <script src="http://18.220.213.59/p/chosen.jquery.min.js"></script>
    <script src="http://18.220.213.59/p/spinbox.min.js"></script>
    <script src="http://18.220.213.59/p/bootstrap-datepicker.min.js"></script>
    {{--<script src="http://18.220.213.59/p/bootstrap-timepicker.min.js"></script>--}}
    <script src="http://18.220.213.59/p/moment.min.js"></script>
    <script src="http://18.220.213.59/p/daterangepicker.min.js"></script>
    <script src="http://18.220.213.59/p/bootstrap-datetimepicker.min.js"></script>
    <script src="http://18.220.213.59/p/bootstrap-colorpicker.min.js"></script>
    <script src="http://18.220.213.59/p/jquery.knob.min.js"></script>
    <script src="http://18.220.213.59/p/autosize.min.js"></script>
    <script src="http://18.220.213.59/p/jquery.inputlimiter.min.js"></script>
    <script src="http://18.220.213.59/p/bootstrap-tag.min.js"></script>

    <!-- ace scripts -->
    <script src="http://18.220.213.59/p/ace-elements.min.js"></script>
    <script src="http://18.220.213.59/p/ace.min.js"></script>

{{--
    <script src="http://18.220.213.59/js/products.js"></script>
--}}

    <script>
        $(document).ready(function()
        {
            $('#stages_group').select2();
            $('#product_name').select2();
            $('#assign_to').select2();
            $('#state').select2();
            $('#date_limit').datepicker({
                autoclose: true,
                todayHighlight: true
            });

            $('.newProduct').on('click',function() {
                //Obtener el listado de usuarios existentes en bd
                $.ajax({
                    type: "GET",
                    url: "../products",
                    data: ""
                })
                    .done(function(data) {
                        $('#product_name').append('<option value="">**Select Data**</option>');
                        for(var i=0;i<data.length;i++)
                        {
                            $('#product_name').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                        }
                    });

                $('#newProductModal').modal('show');
            });

            $('#product_name').on('change',function(){
                var id = $(this).val();

                $.ajax({
                    url: '../product',
                    data: "&id="+id,
                    type:  'get',
                    dataType: 'json',
                    success : function(data) {
                        $('#product_description').val(data[0].description);
                        $('#product_buy_price').val(data[0].buy_price);
                        $('#product_sell_price').val(data[0].sell_price);
                        $('#product_weight').val(data[0].weight);
                        $('#product_id').val(data[0].id);

                        console.log(data[0].photo);

                        if(data[0].photo==null)
                            $('#product_photo').attr('src','http://18.220.213.59/assets/images/products/image-not-found.png');
                        else
                            $('#product_photo').attr('src','http://18.220.213.59/assets/images/products/'+data[0].photo);
                    }
                });

            });


            var oTableProducts= $('#products').DataTable();

        });
    </script>

    {{--Lead Information--}}
    @include('business.products_basic_information')

    {{--Lead Information--}}
    @include('business.products_lead_information')

    {{--Listado de Productos del Business--}}
    @include('business.products_list')

    <div class='panel-footer'>
            <button type="submit" id="saveBusiness" title="{{trans('crudbooster.save')}}" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a title="{{trans('crudbooster.send_email')}}" id="send-email-personal" class="btn btn-success" style="margin: 2px" href="#"><i class="fa fa-envelope-o"></i></a>
        </div>
    </form>


    {{--Modal para agregar un Producto al listado del Business--}}
    @include('business.modal_products')

@endsection