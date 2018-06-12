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

        });
    </script>

    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <span style="border-radius: 3%" class="info-box-icon bg-aqua">
                            <i class="fa fa-briefcase"></i>
                        </span>

                        <h3 class="profile-username text-center" style="padding: 10px">{{ $business->name }}</h3>
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
            <!-- /.col -->
                <div class="col-md-9">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#stages" data-toggle="tab"><i class='fa fa-clock-o'></i> {{trans('crudbooster.Stages')}}</a></li>
                            <li><a href="#notes" data-toggle="tab"><i class='fa fa-file-text-o'></i> {{trans('crudbooster.notes')}}</a></li>
                            <li><a href="#tasks" data-toggle="tab"><i class='fa fa-calendar-minus-o'></i> {{trans('crudbooster.tasks')}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="stages">
                                <ul class="timeline">

                                    @foreach($stages as $stage)
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-blue">Stage {{ $stage->stage_number }}</span>
                                        </li>

                                        <li>
                                            @if($stage->stage_id == $business->stage_id)
                                                    <i class="fa fa-check-circle bg-blue"></i>
                                                @else
                                                    <i class="fa fa-check-circle bg-white"></i>
                                            @endif

                                            <div class="timeline-item">
                                                <span class="time" style="font-size: 12px">Date Limit:  <i class="fa fa-clock-o"></i> {{ $stage->business_date_limit }}</span>

                                                <h3 class="timeline-header">
                                                    <a href="#">{{ $stage->stage_name }}</a>
                                                </h3>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="notes">
                                <!-- Sidebar -->
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
                                                            function(){  location.href='http://127.0.0.1:8000/crm/notes/delete/{{ $note->id }}' });"><i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

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
                <!-- /.col -->


    </section>



    <div class="modal fade" tabindex="-1" role="dialog" id="taskLeadModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #337ab7; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{trans('crudbooster.task_creation')}}</h4>
                </div>

                <form id="form_product" data-parsley-validate  action="" method="post" class="form-horizontal">

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="col-md-10">
                                <input type="hidden" id="lead_id" value="{{ $id }}">

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.name')}}*</label>
                                    <div class="col-md-8">
                                        <input type="text" title="Name" required class="form-control" name="name" id="name" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 col-sm-3 control-label">{{trans('crudbooster.date')}}*</label>
                                    <div class="col-md-8">
                                        <input type="text" title="Date" required class="form-control" name="date" id="date" value="">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">{{trans('crudbooster.close')}}</button>
                        <button type="button" class="btn btn-primary " id="addSaveTask">{{trans('crudbooster.add')}}</button>
                    </div>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



@endsection