$(document).ready(function()
{
    var oTableCampaigns= $('#table_campaigns').DataTable();

    //codigo para la edicion de la tabla
    ETable_campaigns={
        "existingValue":"",
        "init":function(){
            $('#table_campaigns').on('click','.original',function(){
                ETable_campaigns.openEditable(this);
            });
            $('#table_campaigns').on('blur','.editable',function(){
                var original = $(this).parent().parent().find('.original');
                ETable_campaigns.saveNewData(this,original);
            });
        },
        "openEditable":function(elem){
            $(elem).addClass('hide');
            $(elem).siblings().removeClass('hide');
            $(elem).siblings().find('.editable').focus();
            oTableCampaigns.existingValue=$(elem).html();
        },
        "saveNewData":function(elem,original){
            var newVal=$(elem).val();
            var id=$(elem).data("id");

            //obtengo el index de la columna sobre la que estoy accionando
            var columnIdx = oTableCampaigns.cell( $(elem).parents('td')).index().column;

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
    ETable_campaigns.init();



});