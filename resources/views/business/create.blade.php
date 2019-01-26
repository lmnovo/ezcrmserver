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

    <script src="http://127.0.0.1:8000/js/leads/save_forms.js"></script>

{{--
    <script src="http://127.0.0.1:8000/js/products.js"></script>
--}}

    <script>
        $(document).ready(function()
        {
            var business_name = '';
            var business_description = '';
            var business_user_id = '';
            var business_total = '';
            var business_date_limit = '';
            var business_stages_groups_id = '';
            updateTotalSummary();

            //Al cambiar el "business total" se salva automáticamente
            $('#total').on('blur',function() {
                var id = $('#business_id').val();
                business_total = $('#total').val();

                //Guardar el campo al hacer foco fuera "blur"
                $.ajax({
                    type: "GET",
                    url: "../ajaxsave",
                    data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
                    +"&business_user_id="+business_user_id+"&business_total="+business_total
                    +"&business_date_limit="+business_date_limit+"&business_stages_groups_id="+business_stages_groups_id,
                })
                    .done(function(data) {
                        updateTotalSummary();
                        console.log('ok');
                    });
            });

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

                var id = $('#business_id').val();
                business_discount = $('#discount').val();

                //Guardar el campo al hacer foco fuera "blur"
                $.ajax({
                    type: "GET",
                    url: "../ajaxsave",
                    data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
                    +"&business_user_id="+business_user_id+"&business_total="+business_total
                    +"&business_date_limit="+business_date_limit+"&business_discount="+business_discount
                    +"&business_stages_groups_id="+business_stages_groups_id,
                })
                    .done(function(data) {
                        updateTotalSummary();
                        console.log('ok');
                    });

                updateTotalSummary();
            });
            //-------------------------------------------------------------------------

            //Si cambia la "Cantidad del Producto" del Modal...
            $('#product_quantity').on('blur',function() {
                var id = $('#product_id').val();

                //Si borro el valor del campo "Cantidad de Producto"
                if($('#product_quantity').val() == '') {
                    $.ajax({
                        url: '../product',
                        data: "&id="+id,
                        type:  'get',
                        dataType: 'json',
                        success : function(data) {
                            //--B--Comprobar si existen productos en existencia
                            if (data[0].stock >= 1) {
                                $('#product_quantity').val(1);
                                $('#product_total').val(parseFloat(data[0].sell_price));
                                $('#add_button_product').removeAttr('disabled');
                            }
                            else {
                                swal("Stock Empty", "The inventory of the selected product is empty", "error");
                                $('#product_quantity').val(0);
                                $('#product_total').val(0);
                                $('#add_button_product').attr('disabled', 'disabled');
                            }
                            //--F--Comprobar si existen productos en existencia
                        }
                    });
                }
                else { //Si le agrego un valor a la "Cantidad de Produto"
                    $.ajax({
                        url: '../product',
                        data: "&id="+id,
                        type:  'get',
                        dataType: 'json',
                        success : function(data) {
                            //--B--Comprobar si existen productos en existencia
                            if (data[0].stock >= 1) {
                                $('#product_quantity').val(1);
                                $('#product_total').val(parseFloat(data[0].sell_price));
                                $('#add_button_product').removeAttr('disabled');
                            }
                            else {
                                swal("Stock Empty", "The inventory of the selected product is empty", "error");
                                $('#product_quantity').val(0);
                                $('#product_total').val(0);
                                $('#add_button_product').attr('disabled', 'disabled');
                            }
                            //--F--Comprobar si existen productos en existencia
                        }
                    });
                }

                $('#product_total').val($('#product_quantity').val()*$('#product_sell_price').val());
            });
            //-------------------------------------------------------------------------

            $('#stages_group').select2();
            $('#product_name').select2();
            $('#c').select2();
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

            //Al cambiar el select del "Product Name"
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

                        //--B--Comprobar si existen productos en existencia
                        if (data[0].stock >= 1) {
                            $('#product_quantity').val(1);
                            $('#product_total').val(parseFloat(data[0].sell_price));
                            $('#add_button_product').removeAttr('disabled');
                        }
                        else {
                            swal("Stock Empty", "The inventory of the selected product is empty", "error");
                            $('#product_quantity').val(0);
                            $('#product_total').val(0);
                            $('#add_button_product').attr('disabled', 'disabled');
                        }
                        //--F--Comprobar si existen productos en existencia

                        if(data[0].photo==null)
                            $('#product_photo').attr('src','http://127.0.0.1:8000/images/products/image-not-found.png');
                        else
                            $('#product_photo').attr('src','http://127.0.0.1:8000/'+data[0].photo);
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
            {{--<a title="{{trans('crudbooster.send_email')}}" id="send-email-personal" class="btn btn-success" style="margin: 2px" href="#"><i class="fa fa-envelope-o"></i></a>--}}
        </div>
    </form>


    {{--Modal para agregar un Producto al listado del Business--}}
    @include('business.modal_products')

    {{--Modal para agregar un Producto al listado de Productos--}}
    @include('business.modal_products_new')

@endsection