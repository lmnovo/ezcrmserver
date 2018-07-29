$(document).ready(function()
{
    var lead_name = '';
    var lead_lastname = '';
    var lead_email = '';
    var lead_phone = '';
    var lead_city = '';
    var lead_states_id = '';
    //Al cambiar el "lead name" se salva automáticamente
    $('#name').on('blur',function() {
        var lead_id = $('#lead_id').val();
        lead_name = $('#name').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxleadsave",
            data: "lead_id="+lead_id+"&lead_name="+lead_name+"&lead_lastname="+lead_lastname
            +"&lead_email="+lead_email+"&lead_phone="+lead_phone
            +"&lead_city="+lead_city+"&lead_states_id="+lead_states_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "lead lastname" se salva automáticamente
    $('#lastname').on('blur',function() {
        var lead_id = $('#lead_id').val();
        lead_lastname = $('#lastname').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxleadsave",
            data: "lead_id="+lead_id+"&lead_name="+lead_name+"&lead_lastname="+lead_lastname
            +"&lead_email="+lead_email+"&lead_phone="+lead_phone
            +"&lead_city="+lead_city+"&lead_states_id="+lead_states_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "lead email" se salva automáticamente
    $('#email').on('blur',function() {
        var lead_id = $('#lead_id').val();
        lead_email = $('#email').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxleadsave",
            data: "lead_id="+lead_id+"&lead_name="+lead_name+"&lead_lastname="+lead_lastname
            +"&lead_email="+lead_email+"&lead_phone="+lead_phone
            +"&lead_city="+lead_city+"&lead_states_id="+lead_states_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "lead phone" se salva automáticamente
    $('#phone').on('blur',function() {
        var lead_id = $('#lead_id').val();
        lead_phone = $('#phone').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxleadsave",
            data: "lead_id="+lead_id+"&lead_name="+lead_name+"&lead_lastname="+lead_lastname
            +"&lead_email="+lead_email+"&lead_phone="+lead_phone
            +"&lead_city="+lead_city+"&lead_states_id="+lead_states_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "lead city" se salva automáticamente
    $('#city').on('blur',function() {
        var lead_id = $('#lead_id').val();
        lead_city = $('#city').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxleadsave",
            data: "lead_id="+lead_id+"&lead_name="+lead_name+"&lead_lastname="+lead_lastname
            +"&lead_email="+lead_email+"&lead_phone="+lead_phone
            +"&lead_city="+lead_city+"&lead_states_id="+lead_states_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "lead states id" se salva automáticamente
    $('#state').on('change',function() {
        var lead_id = $('#lead_id').val();
        lead_states_id = $('#state').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxleadsave",
            data: "lead_id="+lead_id+"&lead_name="+lead_name+"&lead_lastname="+lead_lastname
            +"&lead_email="+lead_email+"&lead_phone="+lead_phone
            +"&lead_city="+lead_city+"&lead_states_id="+lead_states_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });

    var business_name = '';
    var business_description = '';
    var business_user_id = '';
    var business_total = '';
    var business_date_limit = '';
    var business_stages_groups_id = '';
    //Al cambiar el "business name" se salva automáticamente
    $('#business_name').on('blur',function() {
        var id = $('#business_id').val();
        business_name = $('#business_name').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxsave",
            data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
            +"&business_user_id="+business_user_id+"&business_total="+business_total
            +"&business_date_limit="+business_date_limit+"&business_stages_groups_id="+business_stages_groups_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "business description" se salva automáticamente
    $('#description').on('blur',function() {
        var id = $('#business_id').val();
        business_description = $('#description').val()

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxsave",
            data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
            +"&business_user_id="+business_user_id+"&business_total="+business_total
            +"&business_date_limit="+business_date_limit+"&business_stages_groups_id="+business_stages_groups_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
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
                console.log('ok');
            });
    });
    //Al cambiar el "business stage pipeline" se salva automáticamente
    $('#stages_group').on('change',function() {
        var id = $('#business_id').val();
        business_stages_groups_id = $('#stages_group').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxsave",
            data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
            +"&business_user_id="+business_user_id+"&business_total="+business_total
            +"&business_date_limit="+business_date_limit+"&business_stages_groups_id="+business_stages_groups_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "business user_id" se salva automáticamente
    $('#date_limit').on('change',function() {
        var id = $('#business_id').val();
        business_date_limit = $('#date_limit').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxsave",
            data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
            +"&business_user_id="+business_user_id+"&business_total="+business_total
            +"&business_date_limit="+business_date_limit+"&business_stages_groups_id="+business_stages_groups_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });
    //Al cambiar el "business stages groups" se salva automáticamente
    $('#assign_to').on('change',function() {
        var id = $('#business_id').val();
        business_user_id = $('#assign_to').val();

        //Guardar el campo al hacer foco fuera "blur"
        $.ajax({
            type: "GET",
            url: "../ajaxsave",
            data: "id="+id+"&business_name="+business_name+"&business_description="+business_description
            +"&business_user_id="+business_user_id+"&business_total="+business_total
            +"&business_date_limit="+business_date_limit+"&business_stages_groups_id="+business_stages_groups_id,
        })
            .done(function(data) {
                console.log('ok');
            });
    });

});