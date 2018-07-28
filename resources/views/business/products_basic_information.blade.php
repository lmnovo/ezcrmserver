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
                    <select data-placeholder="{{trans('crudbooster.select_data')}}" class="form-control" id="assign_to" placeholder="Select" name="assign_to" required>
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
                    <select data-placeholder="{{trans('crudbooster.select_data')}}" class="form-control" id="stages_group" placeholder="Select" name="stages_group" required >
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