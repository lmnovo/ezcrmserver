@extends('crudbooster::admin_template')
@section('content')

    <script src='http://18.222.4.15/p/jquery-ui.custom.min.js'></script>
    <script src="http://18.222.4.15/p/jquery.ui.touch-punch.min.js"></script>
    <script src="http://18.222.4.15/p/chosen.jquery.min.js"></script>
    <script src="http://18.222.4.15/p/spinbox.min.js"></script>
    <script src="http://18.222.4.15/p/bootstrap-datepicker.min.js"></script>
    {{--<script src="http://18.222.4.15/p/bootstrap-timepicker.min.js"></script>--}}
    <script src="http://18.222.4.15/p/moment.min.js"></script>
    <script src="http://18.222.4.15/p/daterangepicker.min.js"></script>
    <script src="http://18.222.4.15/p/bootstrap-datetimepicker.min.js"></script>
    <script src="http://18.222.4.15/p/bootstrap-colorpicker.min.js"></script>
    <script src="http://18.222.4.15/p/jquery.knob.min.js"></script>
    <script src="http://18.222.4.15/p/autosize.min.js"></script>
    <script src="http://18.222.4.15/p/jquery.inputlimiter.min.js"></script>
    <script src="http://18.222.4.15/p/bootstrap-tag.min.js"></script>

    <!-- ace scripts -->
    <script src="http://18.222.4.15/p/ace-elements.min.js"></script>
    <script src="http://18.222.4.15/p/ace.min.js"></script>

    <script>
        $(document).ready(function()
        {
            $('#stages_group').select2();
            $('#assign_to').select2();
            $('#state').select2();
            $('#date_limit').datepicker({
                autoclose: true,
                todayHighlight: true
            });

        });
    </script>

    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading' style="background-color: #337ab7; color: white;">
            <strong><i class="fa fa-shopping-bag"></i> {{trans('crudbooster.basic_information')}} </strong>
        </div>
        <div class='panel-body'>


            <?php
            $action = CRUDBooster::mainpath("editsave");
            $return_url = ($return_url)?:g('return_url');
            ?>

            <form class='form-horizontal' id="form" enctype="multipart/form-data" action='<?php echo e($action); ?>'>

                <input type="hidden" id="send_email" name="send_email" value="">
                <input type="hidden" id="lead_id" name="lead_id" value="{{ $lead->id }}">
                <input type="hidden" id="business_id" name="business_id" value="{{ $id }}">

                <div class="row">
                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.Business_Name')}}*</label>
                        <input type='text' name='business_name' required class='form-control' value="{{ $business->name }}"/>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.assign_to')}}*</label>
                        <select class="form-control" id="assign_to" placeholder="Select" name="assign_to" required>
                            <option value="">**Select Data**</option>
                            @foreach($users as $user_item)
                                @if($lead->cms_users_id == $user_item->id)
                                    <option selected="true" value="{{ $user_item->id }}" id="{{ $user_item->id }}">{{ $user_item->name }}</option>;
                                @else
                                    <option value="{{ $user_item->id }}" id="{{ $user_item->id }}">{{ $user_item->name }}</option>;
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.total_amount')}}*</label>
                        <input type='text' name='total' required class='form-control' value="{{ $business->total }}"/>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.date_limit')}}*</label>
                        <div class="input-group">
                            <input id='date_limit' required name='date_limit' class="form-control date-picker" value="{{ $business->date_limit }}" type="text" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-top: 10px;">

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.Stages\'s Group')}}*</label>
                        <select class="form-control" id="stages_group" placeholder="Select" name="stages_group" required >
                            <option value="">**Select Data**</option>
                            @foreach($stages_groups as $stage_group_item)
                                @if($business->stages_groups_id == $stage_group_item->id)
                                    <option selected="true" value="{{ $stage_group_item->id }}" id="{{ $stage_group_item->id }}">{{ $stage_group_item->name }}</option>;
                                @else
                                    <option value="{{ $stage_group_item->id }}" id="{{ $stage_group_item->id }}">{{ $stage_group_item->name }}</option>;
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class='col-sm-9'>
                        <label>{{trans('crudbooster.description')}}</label>
                        <textarea name='description' rows="3" class='form-control'> {{ $business->description }} </textarea>
                    </div>
                </div>
        </div>
    </div>

        <div class='panel panel-default'>
            <div class='panel-heading' style="background-color: #337ab7; color: white;">
                <strong>

                    <a class="btn btn-primary" style="color: white !important;" href='{{CRUDBooster::adminpath("account/detail/leads")}}'><i class="fa fa-user"></i> <strong>{{trans('crudbooster.lead_information')}}</strong></a>
                </strong>
            </div>
            <div class='panel-body'>

                <div class="row">
                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.name')}}*</label>
                        <input type='text' name='name' required class='form-control' value="{{ $lead->name }}"/>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.lastname')}}*</label>
                        <input type='text' name='lastname' required class='form-control' value="{{ $lead->lastname }}"/>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.email')}}*</label>
                        <input type='text' name='email' required class='form-control' value="{{ $lead->email }}"/>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.phone')}}*</label>
                        <input type='text' name='phone' required class='form-control' value="{{ $lead->phone }}"/>
                    </div>
                </div>

                <div class="row" style="padding-top: 10px;">
                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.city')}}*</label>
                        <input type='text' name='city' required class='form-control' value="{{ $lead->city }}"/>
                    </div>

                    <div class='col-sm-3'>
                        <label>{{trans('crudbooster.state')}}*</label>
                        <select class="form-control" id="state" placeholder="Select" name="state" required>
                            <option value="">**Select Data**</option>
                            @foreach($states_list as $state_item)
                                @if($lead->states_id == $state_item->id)
                                    <option selected="true" value="{{ $state_item->id }}" id="{{ $state_item->id }}">{{ $state_item->name }}</option>;
                                @else
                                    <option value="{{ $state_item->id }}" id="{{ $state_item->id }}">{{ $state_item->name }}</option>;
                                @endif
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>
        </div>


        <div class='panel-footer'>
            <button type="submit" id="saveBusiness" title="{{trans('crudbooster.save')}}" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a title="{{trans('crudbooster.send_email')}}" id="send-email-personal" class="btn btn-success" style="margin: 2px" href="#"><i class="fa fa-envelope-o"></i></a>
        </div>
    </form>



@endsection