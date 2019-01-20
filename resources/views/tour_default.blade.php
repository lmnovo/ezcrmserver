<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template_tour')
@section('content')

    <link href="{{ asset("assets/pricing/page_pricing.css")}}" rel="stylesheet" type="text/css" />

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

    <!-- Your html goes here -->
    <div class='row' style="background-color: whitesmoke; padding-bottom: 20px">

        <div class="col-md-7 col-sm-6" style="text-align: center;">
            <div id="crm_register_button" style="display: block; text-align: center;">
                <h3 style="margin-top: 5%;margin-left: 10%;margin-right: 10%;margin-bottom: 5%; color: #204d74; text-align: center; font-family: 'Droid Arabic Naskh', serif;">
                    {{trans("crudbooster.text_tour_promotion")}}
                </h3>

                <div style="text-align: center">
                    <a class="btn btn-primary" style="padding: 8px; font-size: 18px;" href="{{CRUDBooster::adminpath("register")}}">{{ trans('crudbooster.crm_gratis') }}</a>
                </div>
            </div>

        </div>


        <div class="col-md-5 col-sm-6">
            <img width="100%" src="{{asset('assets/images/background_photo_mobile_devices.jpg')}}">
        </div>

    </div>


    <!--=== Content Part ===-->
    <div class="container content">
        <!-- Pricing "No Spacing" -->
        <div class="row space-pricing pricing-zoom">
            <div class="col-md-3 col-sm-5" style="margin-left: -15px">
                <div class="pricing">
                    <div class="pricing-head">
                        <h3>Begginer <span>Only One User</span></h3>
                        <h4><i>$</i>100<i>.00</i> <span>Monthly</span></h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li><i class="fa fa-briefcase"></i> Administrate your Business</li>
                        <li><i class="fa fa-product-hunt"></i> Catalog</li>
                        <li><i class="fa fa-book"></i> Invoice</li>
                        <li><i class="fa fa-envelope"></i> Email Marketing</li>
                        <li><i class="fa fa-phone"></i> SMS Marketing</li>
                        <li><i class="fa fa-folder-open"></i> Project Management</li>
                        <li><i class="fa fa-bell"></i> Reminders, Notifications and More!</li>
                    </ul>
                    <div class="pricing-footer">
                        <p></p>
                        <div style="text-align: center">
                            <a class="btn btn-primary" href="#"><i class="fa fa-shopping-cart"></i> {{ trans('crudbooster.purchase_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5" style="margin-left: -15px">
                <div class="pricing">
                    <div class="pricing-head">
                        <h3>Pro <span>Five Users</span></h3>
                        <h4><i>$</i>300<i>.00</i> <span>Monthly</span></h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li><i class="fa fa-briefcase"></i> Administrate your Business</li>
                        <li><i class="fa fa-product-hunt"></i> Catalog</li>
                        <li><i class="fa fa-book"></i> Invoice</li>
                        <li><i class="fa fa-envelope"></i> Email Marketing</li>
                        <li><i class="fa fa-phone"></i> SMS Marketing</li>
                        <li><i class="fa fa-folder-open"></i> Project Management</li>
                        <li><i class="fa fa-bell"></i> Reminders, Notifications and More!</li>
                    </ul>
                    <div class="pricing-footer">
                        <p></p>
                        <div style="text-align: center">
                            <a class="btn btn-primary" href="#"><i class="fa fa-shopping-cart"></i> {{ trans('crudbooster.purchase_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5" style="margin-left: -15px">
                <div class="pricing">
                    <div class="pricing-head">
                        <h3>Premium <span>Ten Users </span></h3>
                        <h4><i>$</i>500<i>.00</i><span>Monthly</span></h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li><i class="fa fa-briefcase"></i> Administrate your Business</li>
                        <li><i class="fa fa-product-hunt"></i> Catalog</li>
                        <li><i class="fa fa-book"></i> Invoice</li>
                        <li><i class="fa fa-envelope"></i> Email Marketing</li>
                        <li><i class="fa fa-phone"></i> SMS Marketing</li>
                        <li><i class="fa fa-folder-open"></i> Project Management</li>
                        <li><i class="fa fa-bell"></i> Reminders, Notifications and More!</li>
                    </ul>
                    <div class="pricing-footer">
                        <p></p>
                        <div style="text-align: center">
                            <a class="btn btn-primary" href="#"><i class="fa fa-shopping-cart"></i> {{ trans('crudbooster.purchase_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5" style="margin-left: -15px">
                <div class="pricing">
                    <div class="pricing-head">
                        <h3>Elite<span>More Than Ten Users </span></h3>
                        <h4><i>$</i>600<i>.00</i> <span>Monthly</span></h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li><i class="fa fa-briefcase"></i> Administrate your Business</li>
                        <li><i class="fa fa-product-hunt"></i> Catalog</li>
                        <li><i class="fa fa-book"></i> Invoice</li>
                        <li><i class="fa fa-envelope"></i> Email Marketing</li>
                        <li><i class="fa fa-phone"></i> SMS Marketing</li>
                        <li><i class="fa fa-folder-open"></i> Project Management</li>
                        <li><i class="fa fa-bell"></i> Reminders, Notifications and More!</li>
                    </ul>
                    <div class="pricing-footer">
                        <p></p>
                        <div style="text-align: center">
                            <a class="btn btn-primary" href="#"><i class="fa fa-shopping-cart"></i> {{ trans('crudbooster.purchase_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/row-->
        <!-- End Pricing "No Spacing" -->
    </div><!--/container-->



    </div>





    <script type="text/javascript">
        $(document).ready(function() {

            $('#crm_gratis').on('click',function(){
                $('#crm_register_form').css('display','block');
                $('#crm_register_button').css('display','none');
            });


        });
    </script>
@endsection