@extends('crudbooster::admin_template')
@section('content')

    <script src='http://127.0.0.1:8000/p/jquery-ui.custom.min.js'></script>
    <script src="http://127.0.0.1:8000/p/jquery.ui.touch-punch.min.js"></script>
    <script src="http://127.0.0.1:8000/p/chosen.jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/p/spinbox.min.js"></script>
    <script src="http://127.0.0.1:8000/p/bootstrap-datepicker.min.js"></script>
    {{--<script src="http://127.0.0.1:8000/p/bootstrap-timepicker.min.js"></script>--}}
    <script src="http://127.0.0.1:8000/p/moment.min.js"></script>
    <script src="http://127.0.0.1:8000/p/daterangepicker.min.js"></script>
    <script src="http://127.0.0.1:8000/p/bootstrap-datetimepicker.min.js"></script>
    <script src="http://127.0.0.1:8000/p/bootstrap-colorpicker.min.js"></script>
    <script src="http://127.0.0.1:8000/p/jquery.knob.min.js"></script>
    <script src="http://127.0.0.1:8000/p/autosize.min.js"></script>
    <script src="http://127.0.0.1:8000/p/jquery.inputlimiter.min.js"></script>
    <script src="http://127.0.0.1:8000/p/bootstrap-tag.min.js"></script>

    <!-- ace scripts -->
    <script src="http://127.0.0.1:8000/p/ace-elements.min.js"></script>
    <script src="http://127.0.0.1:8000/p/ace.min.js"></script>

    <script src="http://127.0.0.1:8000/p/ace.min.js"></script>

{{--
    <script src="http://127.0.0.1:8000/js/products.js"></script>
--}}

    <script>
        $(document).ready(function()
        {
            updateTotalSummary();

            //Calcular los valores de "Total Summary"
            function updateTotalSummary() {
                var total = parseFloat($('#total').val());
                var discount = parseFloat($('#discount').val());
                var resumen_products = parseFloat($('#resumen_products').val());
                var subtotal_ammount = total+resumen_products-discount;

                var products_tax = parseFloat($('#products_tax').val());

                $('#subtotal_ammount').val(subtotal_ammount);
                $('#total_tax').val(products_tax);

                var total_tax = products_tax;
                $('#total_ammount').val(subtotal_ammount+total_tax);
            }
            //------------------------------------------------------------------------------------------

            //Si cambia el "Discount" del "Total Summary"
            $('#discount').on('blur',function() {
                if($('#discount').val() == '') {
                    $('#discount').val('0.00');
                }
                updateTotalSummary();
            });
            //-------------------------------------------------------------------------

            //Si cambia la cantidad del Producto del Modal...
            $('#product_quantity').on('blur',function() {
                if($('#product_quantity').val() == '') {
                    $('#product_quantity').val(1);
                }
                $('#product_total').val($('#product_quantity').val()*$('#product_sell_price').val());
            });
            //-------------------------------------------------------------------------

            $('#stages_group').select2();
            $('#product_name').select2();
            $('#assign_to').select2();
            $('#state').select2();
            $('#date_limit').datepicker({
                autoclose: true,
                todayHighlight: true
            });

            //Botón "New" para abrir modal que agrega nuevo producto
            $('#new_button_product').on('click',function() {
                $('#new_product_name').val('');
                $('#new_product_description').val('');
                $('#new_product_buy_price').val('');
                $('#new_product_sell_price').val('');
                $('#new_product_quantity').val('');
                $('#new_product_weight').val('0.00');
                $('#new_product_photo').attr('src','http://127.0.0.1:8000/images/products/image-not-found.png');

                $('#addProductModal').modal('show');
                $('#newProductModal').modal('hide');
            });

            $('.newProduct').on('click',function() {
                //Obtener el listado de usuarios existentes en bd
                $('#select2-product_name-container').html('');
                $('#product_name').html('');
                $('#product_description').val('');
                $('#product_buy_price').val('');
                $('#product_sell_price').val('');
                $('#product_quantity').val('');
                $('#product_weight').val('0.00');
                $('#product_photo').attr('src','http://127.0.0.1:8000/images/products/image-not-found.png');
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
                        $('#product_quantity').val(1);
                        $('#product_total').val(parseFloat(data[0].sell_price));

                        if(data[0].photo==null)
                            $('#product_photo').attr('src','http://127.0.0.1:8000/images/products/image-not-found.png');
                        else
                            $('#product_photo').attr('src','http://127.0.0.1:8000/images/products/'+data[0].photo);
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

    {{--Resumen Final del Business--}}
    @include('business.total_summary')

    <div class='panel-footer'>
            <button type="submit" id="saveBusiness" title="{{trans('crudbooster.save')}}" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a title="{{trans('crudbooster.send_email')}}" id="send-email-personal" class="btn btn-success" style="margin: 2px" href="#"><i class="fa fa-envelope-o"></i></a>
        </div>
    </form>


    {{--Modal para agregar un Producto al listado del Business--}}
    @include('business.modal_products')

    {{--Modal para agregar un Producto al listado de Productos--}}
    @include('business.modal_products_new')

@endsection