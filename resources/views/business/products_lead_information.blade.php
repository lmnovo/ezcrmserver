<div class='panel panel-default'>
    <div class='panel-heading' style="background-color: #337ab7; color: white;">
        <strong>

            <a class="btn btn-primary" style="color: white !important;" href='{{CRUDBooster::adminpath("leads/detail/$lead->id")}}'><i class="fa fa-user"></i> <strong>{{trans('crudbooster.lead_information')}}</strong></a>
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
                <label>{{trans('crudbooster.city')}}</label>
                <input type='text' name='city' class='form-control' value="{{ $lead->city }}"/>
            </div>

            <div class='col-sm-3'>
                <label>{{trans('crudbooster.state')}}*</label>
                <select data-placeholder="{{trans('crudbooster.select_data')}}" class="form-control" id="state" placeholder="Select" name="state" required>
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
