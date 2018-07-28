<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')

    <link href="{{ asset("vendor/switchery/dist/switchery.min.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('vendor/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('vendor/custom.min.js') }}"></script>

    <style type="text/css">
        .switchery {
            width: 32px;
            height: 20px
        }
        .switchery>small {
            width: 20px;
            height: 20px
        }
    </style>

    <script>
        $(document).ready(function()
        {
            $('#suscribe_campaigns_email').on('change',function() {
                var input = $( this );
                var id = $('#lead_id').val();

                if(input.is( ":checked" )) {
                    $.ajax({
                        url: '../subscriptionchange',
                        data: "id="+id+"&subscribed="+1,
                        type:  'get',
                        dataType: 'json',
                        success : function(data) {
                            swal("Suscribed", "This email account it will receive campaigns of email marketing", "success");
                        }
                    });
                } else {
                    $.ajax({
                        url: '../subscriptionchange',
                        data: "id="+id+"&subscribed="+0,
                        type:  'get',
                        dataType: 'json',
                        success : function(data) {
                            swal("Unsuscribed", "This email account it will not receive more campaigns of email marketing", "error");
                        }
                    });
                }
            });

        });
    </script>

    @if($index_statistic)
        <div id='box-statistic' class='row'>
            @foreach($index_statistic as $stat)
                <div  class="{{ ($stat['width'])?:'col-sm-3' }}">
                    <div class="small-box bg-{{ $stat['color']?:'red' }}">
                        <div class="inner">
                            <h3>{{ $stat['count'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </div>
                        <div class="icon">
                            <i class="{{ $stat['icon'] }}"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!is_null($pre_index_html) && !empty($pre_index_html))
        {!! $pre_index_html !!}
    @endif


    @if(g('return_url'))
        <p><a href='{{g("return_url")}}'><i class='fa fa-chevron-circle-{{ trans('crudbooster.left') }}'></i> &nbsp; {{trans('crudbooster.form_back_to_list',['module'=>ucwords(str_replace('_',' ',g('parent_table')))])}}</a></p>
    @endif

    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">

                        @if( $lead->photo == null )
                            <img style="width: 65%;" class="profile-user-img img-responsive img-circle" src="<?php echo e(asset('assets/images/image-not-found.png')); ?>" alt="Perfil de Usuario picture">
                        @else
                            <img style="width: 65%;" class="profile-user-img img-responsive img-circle" src="{{CRUDBooster::mainpath("../../$lead->photo")}}" alt="Perfil de Usuario picture">
                        @endif

                        <h3 class="profile-username text-center">
                            {{ $lead->name }} {{ $lead->lastname }}
                        </h3>

                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-map-marker user-profile-icon"></i>
                                @if($lead->address == null)
                                    <span style="color: red">{{trans('crudbooster.no_address')}}</span>
                                @else
                                    {{ $lead->address }}
                                @endif
                            </li>
                        </ul>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item" style="height: 55px;">
                                <a title="{{trans('crudbooster.send_email')}}" class='btn btn-success pull-right' style="margin: 2px" href='{{CRUDBooster::mainpath("send-email/$id")}}'><i class="fa fa-envelope-o"></i></a>
                                <a title="{{trans('crudbooster.send_sms')}}" class='btn btn-primary pull-right' style="margin: 2px" href='{{CRUDBooster::mainpath("send-sms/$id")}}'><i class="glyphicon glyphicon-phone"></i></a>
                                {{--<a title="{{trans('crudbooster.add_quote')}}" class='btn btn-danger pull-right' style="margin: 2px" href='{{CRUDBooster::adminpath("business/add-business/$id")}}'><i class="glyphicon glyphicon-briefcase"></i></a>--}}

                            </li>
                            <li class="list-group-item">
                                <b>Negociations</b> <a class="pull-right">0</a>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>Email</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $lead->email }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>Phone</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $lead->phone }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>Assigned To</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $lead->user_fullname }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>State</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $lead->states }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>City</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $lead->city }}
                                </p>
                            </li>
                            <li class="list-group-item" style="height: 55px">
                                <b>Type</b> <p class="text-muted" style="text-align: right; color: #3c8dbc;">
                                    {{ $lead->leads_type }}
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
                        <li class="active tabs_leads_notes"><a href="#notes" data-toggle="tab"><i class='fa fa-file-text-o'></i> Notes</a></li>
                        <li class="tabs_leads_tasks"><a href="#tasks" data-toggle="tab"><i class='fa fa-calendar-minus-o'></i> Tasks</a></li>
                        <li class="tabs_leads_campaigns"><a href="#campaigns" data-toggle="tab"><i class='fa fa-envelope-o'></i> Campaigns & Emails</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="notes">
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
                                                        function(){  location.href='http://18.220.213.59/crm/notes/delete/{{ $note->id }}' });"><i class="fa fa-trash"></i>
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
                                                {{--<a class="btn btn-xs btn-primary btn-detail" title="{{trans('crudbooster.detail')}}" href="http://18.220.213.59/crm/eazy_tasks/detail/{{$task->id}}?return_url=http%3A%2F%2F127.0.0.1%3A8000%2Fcrm%2Feazy_tasks%3Fforeign_key%3Dcustomers_id%26label%3DTasks%26parent_columns%3Dname%26parent_id%3D{{$id}}%26parent_table%3Daccount%26return_url%3Dhttp%253A%252F%252F127.0.0.1%253A8000%252Fcrm%252Faccount%253Fm%253D50"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-xs btn-success btn-edit" title="{{trans('crudbooster.edit')}}" href="http://18.220.213.59/crm/eazy_tasks/edit/{{$task->id}}?return_url=http%3A%2F%2F127.0.0.1%3A8000%2Fcrm%2Feazy_tasks%3Fforeign_key%3Dcustomers_id%26label%3DTasks%26parent_columns%3Dname%26parent_id%3D{{$id}}%26parent_table%3Daccount%26return_url%3Dhttp%253A%252F%252F127.0.0.1%253A8000%252Fcrm%252Faccount%253Fm%253D50&parent_id=3288&parent_field="><i class="fa fa-pencil"></i></a>
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
                        <div class="tab-pane" id="campaigns">

                            <div class="row">
                                <div class="form-group" style="padding-left: 5px">
                                    <label class="control-label col-md-6 col-sm-9 col-xs-9">{{ trans('crudbooster.campaigns_email') }}</label>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        <div class="">
                                            <label>
                                                @if($lead->subscribed == 1)
                                                    <input type="checkbox" id="suscribe_campaigns_email" class="js-switch" checked />
                                                @else
                                                    <input type="checkbox" id="suscribe_campaigns_email" class="js-switch" />
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="table-responsive" style="padding-left: 20px; padding-right: 20px">
                                    <?php
                                    if(count($campaigns) == 0) {
                                    echo "<div style='text-align: center; color: red; padding-bottom: 20px;'><i class='fa fa-search'></i>";?> {{ trans('crudbooster.table_data_not_found') }}  <?php echo "</div>";
                                    }
                                    else {
                                    ?>

                                    <table id="table_tasks" class='table table-striped table-bordered'>
                                        <thead>
                                        <tr>
                                            <th>{{trans('crudbooster.name')}}</th>
                                            <th>{{trans('crudbooster.subject')}}</th>
                                            <th>{{trans('crudbooster.type')}}</th>
                                            <th style="text-align: center">{{trans('crudbooster.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php    }
                                        ?>

                                        @foreach($campaigns as $campaign)
                                            <tr>
                                                <td>{{$campaign->campaign_name}}</td>
                                                <td>{{$campaign->subject}}</td>
                                                <td>{{$campaign->type}}</td>
                                                <td style="text-align: center">
                                                    <a class="btn btn-xs btn-primary btn-detail" title="{{trans('crudbooster.detail')}}" href="{{CRUDBooster::adminpath("settings_campaigns/detail/$campaign->campaign_id")}}"><i class="fa fa-eye"></i></a>
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

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->

    </section>


    {{--Modal para agregar una Tarea--}}
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