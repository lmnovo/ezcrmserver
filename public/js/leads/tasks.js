$(document).ready(function()
{
    var oTableTasks= $('#table_tasks').DataTable();

    //codigo para la edicion de la tabla
    ETable_tasks={
        "existingValue":"",
        "init":function(){
            $('#table_tasks').on('click','.original',function(){
                ETable_tasks.openEditable(this);
            });
            $('#table_tasks').on('blur','.editable',function(){
                var original = $(this).parent().parent().find('.original');
                ETable_tasks.saveNewData(this,original);
            });
        },
        "openEditable":function(elem){
            $(elem).addClass('hide');
            $(elem).siblings().removeClass('hide');
            $(elem).siblings().find('.editable').focus();
            oTableTasks.existingValue=$(elem).html();
        },
        "saveNewData":function(elem,original){
            var newVal=$(elem).val();
            var id=$(elem).data("id");

            //obtengo el index de la columna sobre la que estoy accionando
            var columnIdx = oTableTasks.cell( $(elem).parents('td')).index().column;

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
    ETable_tasks.init();

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

    //Abrir modal para agregar una nueva Tarea
    $('#addTasks').on('click',function(){
        $('#taskLeadModal').modal('show');
    });
    //-----------------------------------------------------------------------------

    //Guardar los datos de la nueva Tarea
    $('#addSaveTask').on('click',function(){
        var name = $('#name').val();
        var date = $('#date_due').val();
        var reminder_email = $('#reminder_email').val();
        var lead_id = $('#lead_id').val();

        $.ajax({
            url: '../addsave',
            data: "name="+$('#name').val()+"&date="+$('#date_due').val()+"&lead_id="+$('#lead_id').val()+"&reminder_email="+$('#reminder_email').val(),
            type:  'get',
            dataType: 'json',
            success : function(data) {
                window.location.href = 'http://127.0.0.1:8000/crm/leads/detail/'+lead_id;
                $('#taskLeadModal').modal('hide');
            }
        });
    });

});