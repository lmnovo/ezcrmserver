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

    <script>
        $(document).ready(function()
        {
            //Acción para agregar notas a los business
            var stages_id;
            $(document).on('click','.add-notes',function(){
                stages_id = $(this).data('id');
                $('#stages_id').val(stages_id);
                $('#newNoteModal').modal('show');
            });

            $('#newNoteModal').on('click','#saveNote',function(){
                var note_detail = $('#note_detail').summernote('code');
                var business_id = $('#business_id').val();

                $.ajax({
                    url: '../../stages/addstagesnotes',
                    data: "notes="+note_detail+"&stages_id="+stages_id+"&business_id="+business_id,
                    type:  'get',
                    dataType: 'json',
                    success : function(data) {
                        window.location.href = 'http://127.0.0.1:8000/crm/business/edit/'+business_id;
                    }
                });

            });

            //Ocultar el mensaje de alerta pasados 4 segundos
            setTimeout("$(\"div[class*='alert alert-warning']\").fadeOut(350);", 2000);
            setTimeout("$(\"div[class*='alert alert-success']\").fadeOut(350);", 2000);
            //*****************************************************************************************


            $(document).on('click','.add-files',function(){
                var stages_id = $(this).data('id');
                $('#stages_id').val(stages_id);
                $('#newStageModal').modal('show');
            });

            //Botón de agregar nuevo archivo en modal newStageModal
            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            //Botón de eliminar archivo en modal newStageModal
            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });
            //***********************************************************************


            //Acción para agregar nueva Task
            $('#addTasks').on('click',function(){
                $('#taskLeadModal').modal('show');
            });

            $('#addSaveTask').on('click',function(){
                var name = $('#name').val();
                var date = $('#date').val();
                var business_id = $('#business_id').val();

                $.ajax({
                    url: '../addsave',
                    data: "name="+$('#name').val()+"&date="+$('#date').val()+"&business_id="+$('#business_id').val(),
                    type:  'get',
                    dataType: 'json',
                    success : function(data) {
                        window.location.href = 'http://127.0.0.1:8000/crm/business/edit/'+business_id;
                        $('#taskLeadModal').modal('hide');
                    }
                });
            });
            //***********************************************************************

            $(document).on('click','.step-check-actual',function(){

                var stages_id = $(this).data('id');
                var stages_id_position = $(this).data('type');
                var item = $(this);
                var business_id = $('#business_id').val();

                swal({
                        title: "Do you want to finalize this stage?",
                        text: "Stage "+stages_id_position,
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    },
                    function(){
                        $.ajax({
                            url: '../../stages/stageterminate',
                            data: "stages_id="+stages_id+"&business_id="+business_id,
                            type:  'get',
                            dataType: 'json',
                            success : function(data) {
                                console.log(item);
                                item.removeClass('bg-gray');
                                item.addClass('bg-blue');
                                window.location.href = 'http://127.0.0.1:8000/crm/business/edit/'+business_id;
                            }
                        });
                    });




            });
        });
    </script>

    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <span style="border-radius: 3%;" class="info-box-icon bg-aqua" >
                            <i class="fa fa-briefcase"></i>
                        </span>

                        <h3 class="profile-username text-center">{{ $business->business_name }}</h3>
                        {{--<p class="text-muted" style="text-align: center">-Negocitation Name-</p>--}}

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item" style="height: 55px;">
                                <a title="{{trans('crudbooster.send_email')}}" class='btn btn-success pull-right' style="margin: 2px" href='{{CRUDBooster::mainpath("send-email/$id")}}'><i class="fa fa-envelope-o"></i></a>
                                <a title="{{trans('crudbooster.send_sms')}}" class='btn btn-primary pull-right' style="margin: 2px" href='{{CRUDBooster::mainpath("send-sms/$id")}}'><i class="glyphicon glyphicon-phone"></i></a>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>{{trans('crudbooster.Total Ammount')}}</b>
                                <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    ${{ $business->total }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>{{trans('crudbooster.Lead Name')}}</b>
                                <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $business->name }} {{ $business->lastname }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>{{trans('crudbooster.Closing Date')}}</b>
                                <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $business->date_limit }}
                                </p>
                            </li>

                            <li class="list-group-item" style="height: 55px">
                                <b>{{trans('crudbooster.assign_to')}}</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $business->fullname }}
                                </p>
                            </li>

                            <li class="list-group-item" style="height: 55px">
                                <b>{{trans('crudbooster.Actual Stage')}}</b>
                                <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    <span class="label label-primary" style="font-size: 12px;">{{ $business->stage_name }}</span>
                                </p>
                            </li>

                            <li class="list-group-item" style="height: 55px">
                                <b>{{trans('crudbooster.Actual Stage Number')}}</b>
                                <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    <span class="label label-success" style="font-size: 12px;">{{ $business->stage_number }}</span>
                                </p>
                            </li>

                        </ul>

                    </div>


                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>

            <div class="col-md-9">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#stages" data-toggle="tab"><i class='fa fa-clock-o'></i> {{trans('crudbooster.Stages')}}<strong>(<?php echo(count($stages))?>)</strong></a></li>
                            <li><a href="#notes" data-toggle="tab"><i class='fa fa-file-text-o'></i> {{trans('crudbooster.notes')}}<strong>(<?php echo(count($notes))?>)</strong></a></li>
                            <li><a href="#tasks" data-toggle="tab"><i class='fa fa-calendar-minus-o'></i> {{trans('crudbooster.tasks')}}<strong>(<?php echo(count($tasks))?>)</strong></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="stages">

                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="timeline">

                                        @foreach($stages as $stage)
                                            <!-- timeline time label -->
                                                <li class="time-label">
                                                    <span class="bg-blue">Stage {{ $stage->stage_number }}</span>
                                                </li>

                                                <li>
                                                    @if($stage->stage_id <= $business->business_stage_id)
                                                        <i id="{{ $stage->stage_id }}" data-id="{{ $stage->stage_id }}" data-type="{{ $stage->stage_number }}" class="fa fa-check-circle bg-blue step-check-active"></i>
                                                    @elseif($stage->stage_id == $business->stage_id+1)
                                                        <i id="{{ $stage->stage_id }}" data-id="{{ $stage->stage_id }}" data-type="{{ $stage->stage_number }}" class="fa fa-check-circle bg-gray step-check-actual"></i>
                                                    @else
                                                        <i id="{{ $stage->stage_id }}" data-id="{{ $stage->stage_id }}" data-type="{{ $stage->stage_number }}" class="fa fa-check-circle bg-gray step-check-disabled"></i>
                                                    @endif

                                                    <div class="timeline-item">
                                                <span class="time" style="font-size: 12px">End Date:  <i class="fa fa-clock-o"></i>
                                                    @if($stage->date_limit == null)
                                                        -
                                                    @else
                                                        {{ $stage->date_limit }}
                                                    @endif
                                                </span>

                                                        <h3 class="timeline-header">
                                                            <a href="#">{{ $stage->stage_name }}</a>
                                                        </h3>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="timeline-item">
                                                        <div class="row">
                                                            <div class="col-md-5">

                                                                <!-- end of user messages -->
                                                                <ul class="timeline">
                                                                    <?php
                                                                    if (count($stages_activities) == 0) {
                                                                    ?>
                                                                    <li class="time-label">
                                                                        <span style="font-size: 14px">{{ trans('crudbooster.no_history') }}</span>
                                                                    </li>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                    <li class="time-label">
                                                                        <span style="font-size: 14px">{{ trans('crudbooster.history') }}</span>
                                                                    </li>
                                                                    <?php
                                                                    }
                                                                    $dateTemp = null;
                                                                    ?>

                                                                    @foreach($stages_activities as $activity)
                                                                        @if($activity->stages_id == $stage->stage_id)
                                                                            <li>
                                                                                <span  class="btn btn-success btn-xs">{{ $activity->created_at }}</span>
                                                                                <div class="timeline-item">
                                                                                    <p>-{{ $activity->description }}</p>
                                                                                </div>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach

                                                                </ul>
                                                                <!-- end of user messages -->


                                                            </div>

                                                            <div class="col-md-4">

                                                                <!-- end of user messages -->
                                                                <ul>
                                                                    <span style="font-size: 14px; font-weight: bold;">{{trans('crudbooster.notes')}}</span>

                                                                    <div class="timeline-item">
                                                                        <p><?php echo ($stage->notes); ?></p>
                                                                    </div>

                                                                </ul>
                                                                <!-- end of user messages -->
                                                            </div>

                                                            <div class="col-md-3">
                                                                <h5 style="text-align: right">{{trans('crudbooster.stages_files')}}</h5>
                                                                <ul class="list-unstyled project_files" style="text-align: right">
                                                                    <?php
                                                                    $files = explode(';', $stage->files);

                                                                    foreach ($files as $item)
                                                                    {
                                                                    $extension = explode('.', $item);

                                                                    //pdf,xls,xlsx,doc,docx,txt,zip,rar,7z
                                                                    if ($extension[1] == 'jpg' || $extension[1] == 'png'|| $extension[1] == 'jpeg'|| $extension[1] == 'gif'|| $extension[1] == 'bmp')
                                                                    {
                                                                    ?>
                                                                    <li>
                                                                        <a title="{{trans('crudbooster.click_to_view')}}" data-lightbox="roadtrip" href="http://127.0.0.1:8000/files/{{$item}}"><i class="fa fa-picture-o"></i><?php print_r($item); ?></a>
                                                                    </li>
                                                                    <?php
                                                                    }
                                                                    else if($item != '')
                                                                    {
                                                                    ?>
                                                                    <li>
                                                                        <a title="{{trans('crudbooster.click_to_view')}}" href="http://127.0.0.1:8000/files/{{$item}}" target="_blank"><i class="fa fa-file-pdf-o"></i><?php print_r($item); ?></a>
                                                                    </li>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <li>
                                                                        <button type="button" class="btn btn-danger btn-xs">{{trans('crudbooster.no_files')}}</button>
                                                                    </li>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                                <br>

                                                                <div class="text-right mtop20">
                                                                    @if($stage->stage_id <= $business->business_stage_id)
                                                                        <a href="#" data-business="{{ $business->business_id }}" data-id="{{ $stage->stage_id }}" class="btn btn-sm btn-primary add-files">{{trans('crudbooster.add_files')}}</a>
                                                                        <a style="margin-top: 5px" href="#" data-business="{{ $business->business_id }}" data-id="{{ $stage->stage_id }}" class="btn btn-sm btn-primary add-notes">{{trans('crudbooster.add_notes')}}</a>
                                                                    @else
                                                                        <a href="#" data-business="{{ $business->business_id }}" data-id="{{ $stage->stage_id }}" class="disabled btn btn-sm btn-primary add-files">{{trans('crudbooster.add_files')}}</a>
                                                                        <a style="margin-top: 5px" href="#" data-business="{{ $business->business_id }}" data-id="{{ $stage->stage_id }}" class="disabled btn btn-sm btn-primary add-notes">{{trans('crudbooster.add_notes')}}</a>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="notes">
                                <!-- Sidebar -->
                                <div id="div_add_note">
                                    <?php
                                    if(count($notes) == 0) {
                                    echo "<div style='text-align: center; color: red; padding-bottom: 20px;'><i class='fa fa-search'></i>";?> {{ trans('crudbooster.table_data_not_found') }}  <?php echo "</div>";
                                    }
                                    ?>

                                    @foreach($notes as $note)
                                        <div class="row invoice-info" style="padding-left: 20px; padding-top: 15px;">
                                            <div class="col-sm-8 invoice-col">
                                                {{--<div style="background-color: #f5f5f5;"><strong>Note {{ $note->id }}</strong></div>--}}
                                                <div>{{ $note->name }}</div>
                                                <div class="row">
                                                    <div  class="col-sm-3" style="padding-top: 5px;"><i class="fa fa-clock-o"></i> {{ $note->created_at }}</div>
                                                    <div  class="col-sm-1" style="padding-top: 5px;">
                                                        <a class="btn btn-xs btn-warning btn-delete" title="{{trans('crudbooster.delete')}}" href="javascript:;" onclick="swal({
                                                                title: '{{trans('crudbooster.are_you_sure')}}',
                                                                text: '{{trans('crudbooster.message_delete')}}',
                                                                type: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#ff0000',
                                                                confirmButtonText: '{{trans('crudbooster.yes')}}',
                                                                cancelButtonText: '{{trans('crudbooster.no')}}',
                                                                closeOnConfirm: false },
                                                                function(){  location.href='http://127.0.0.1:8000/crm/eazy_notes/delete/{{ $note->id }}' });"><i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                    <div class="row" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px;">
                                        <input type="hidden" id="note_lead_id" value="{{ $id }}">
                                        <div class="col-md-10">
                                            <textarea class="form-control" type="text" id="note_value" name="note_value" rows="3" value=""> </textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" id="add_note" class="btn btn-xl btn-primary" >{{trans('crudbooster.add_note')}}</button>
                                        </div>
                                    </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tasks">
                                <a title="{{trans('crudbooster.add_task')}}" id="addTasks" class='btn btn-primary pull-right' href='#'><i class="fa fa-book"></i></a>

                                <div class="table-responsive" style="padding-left: 20px; padding-right: 20px">
                                    <?php
                                    if(count($tasks) == 0) {
                                    echo "<div style='text-align: center; color: red; padding-bottom: 20px;'><i class='fa fa-search'></i>";?> {{ trans('crudbooster.table_data_not_found') }}  <?php echo "</div>";
                                    }
                                    else {
                                    ?>

                                    <table id="table_tasks" class='table table-striped table-bordered'>
                                        <thead>
                                        <tr>
                                            <th>{{trans('crudbooster.name')}}</th>
                                            <th>{{trans('crudbooster.created_at')}}</th>
                                            <th style="text-align: center">{{trans('crudbooster.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php    }
                                        ?>

                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{$task->name}}</td>
                                                <td>{{$task->created_at}}</td>
                                                <td style="text-align: center">
                                                    {{--<a class="btn btn-xs btn-primary btn-detail" title="{{trans('crudbooster.detail')}}" href="http://127.0.0.1:8000/crm/eazy_tasks/detail/{{$task->id}}?return_url=http%3A%2F%2F127.0.0.1%3A8000%2Fcrm%2Feazy_tasks%3Fforeign_key%3Dcustomers_id%26label%3DTasks%26parent_columns%3Dname%26parent_id%3D{{$id}}%26parent_table%3Daccount%26return_url%3Dhttp%253A%252F%252F127.0.0.1%253A8000%252Fcrm%252Faccount%253Fm%253D50"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-xs btn-success btn-edit" title="{{trans('crudbooster.edit')}}" href="http://127.0.0.1:8000/crm/eazy_tasks/edit/{{$task->id}}?return_url=http%3A%2F%2F127.0.0.1%3A8000%2Fcrm%2Feazy_tasks%3Fforeign_key%3Dcustomers_id%26label%3DTasks%26parent_columns%3Dname%26parent_id%3D{{$id}}%26parent_table%3Daccount%26return_url%3Dhttp%253A%252F%252F127.0.0.1%253A8000%252Fcrm%252Faccount%253Fm%253D50&parent_id=3288&parent_field="><i class="fa fa-pencil"></i></a>
                                                    --}}
                                                    <a class="btn btn-xs btn-warning btn-delete" title="{{trans('crudbooster.delete')}}" href="javascript:;" onclick="swal({
                                                            title: '{{trans('crudbooster.are_you_sure')}}',
                                                            text: '{{trans('crudbooster.message_delete')}}',
                                                            type: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#ff0000',
                                                            confirmButtonText: '{{trans('crudbooster.yes')}}',
                                                            cancelButtonText: '{{trans('crudbooster.no')}}',
                                                            closeOnConfirm: false },
                                                            function(){  location.href='{{CRUDBooster::adminpath("eazy_tasks/delete/$task->id")}}' });"><i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>


    </section>

    {{--Modal para agregar una Tarea--}}
    @include('leads.modal_tasks')


    <div class="modal fade" tabindex="-1" role="dialog" id="newStageModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #337ab7; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{trans('crudbooster.Stage\'s Information')}}</h4>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="col-md-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h3 class="jumbotron">Multiple File Upload</h3>
                            <form method="post" action="{{url('file')}}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <input type="hidden" id="stages_id" name="stages_id">
                                <input type="hidden" id="business_id" name="business_id" value="<?php echo($id);?>">

                                <div class="input-group control-group increment" >
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus-sign"></i></button>
                                    </div>
                                </div>
                                <div class="clone hide">
                                    <div class="control-group input-group extra-input" style="margin-top:10px">
                                        <input type="file" name="filename[]" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">{{trans('crudbooster.close')}}</button>
                    <button type="submit" class="btn btn-primary" id="">{{trans('crudbooster.save')}}</button>
                </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="newNoteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #337ab7; color: white;">
                    <button type="button" id="closeModal5" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{trans('crudbooster.note_creation')}}</h4>
                </div>

                <form id="form_builout" action="" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="note_detail" class="summernote"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="saveNote">{{trans('crudbooster.add')}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



@endsection