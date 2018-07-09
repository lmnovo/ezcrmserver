$(document).ready(function()
{
    var oTableBusiness= $('#table_business').DataTable();

    //codigo para la edicion de la tabla
    ETable_business={
        "existingValue":"",
        "init":function(){
            $('#table_business').on('click','.original',function(){
                ETable_business.openEditable(this);
            });
            $('#table_business').on('blur','.editable',function(){
                var original = $(this).parent().parent().find('.original');
                ETable_business.saveNewData(this,original);
            });
        },
        "openEditable":function(elem){
            $(elem).addClass('hide');
            $(elem).siblings().removeClass('hide');
            $(elem).siblings().find('.editable').focus();
            oTableBusiness.existingValue=$(elem).html();
        },
        "saveNewData":function(elem,original){
            var newVal=$(elem).val();
            var id=$(elem).data("id");

            //obtengo el index de la columna sobre la que estoy accionando
            var columnIdx = oTableBusiness.cell( $(elem).parents('td')).index().column;

            original.text(newVal);
            $('#modal-loading').modal('show');

            $.ajax({
                url:  'editestado',
                data: "estado="+newVal+"&id="+id,
                type:  'get',
                dataType: 'json',
                success : function(data) {
                    $('#modal-loading').modal('hide');
                }
            });

            $('.editors').addClass('hide');
            $('.original').removeClass('hide');
        }
    };
    ETable_business.init();

    $(document).on("click","#btneliminarestado",function(e) {
        e.preventDefault();

        var item = $(this).data('id');
        var tr = $(this).closest('td').parent();

        $.ajax({
            url:  '../products/deleteestado',
            data: '&id='+item,
            type:  'get',
            dataType: 'json',
            success : function(data) {
                //Eliminamos la fila de la vista
                swal('Deleted!', 'Delete selected successfully !', 'success');
                tr.hide();
            }
        });
    });


});