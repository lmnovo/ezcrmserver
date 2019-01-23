<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')

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

    <html>

    <head>
        <title>Pie Chart</title>
        <script src="{{ asset('assets/chartjs/Chart.bundle.js') }}"></script>
        <script src="{{ asset('assets/chartjs/utils.js') }}"></script>
        <script src="{{ asset('vendor/jqvmap/dist/jquery.vmap.js') }}"></script>
        <script src="{{ asset('vendor/jqvmap/dist/maps/jquery.vmap.usa.js') }}"></script>

        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
            .chart-container {
                width: 75%;
                margin-left: 40px;
                margin-right: 40px;
            }
            .container {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
        </style>
    </head>

    <body>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title" style="text-align: center;">
                    <h4>{{trans("crudbooster.chart_1")}}</h4>
                </div>
                <div class="x_content">
                    <canvas id="chart-legend-pointstyle"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title" style="text-align: center;">
                    <h4>{{trans("crudbooster.chart_2")}}<small> {{trans("crudbooster.by_months")}}</small></h4>
                </div>
                <div class="x_content">
                    <canvas id="chart-legend-normal"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>

        function createPieTypeLeadConfig(colorName) {
            var config = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            {{ $data['total_leads'] }}
                        ],
                        backgroundColor: [
                            window.chartColors.blue,
                            window.chartColors.red
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        "Leads",
                        "Clients"
                    ]
                },
                options: {
                    legend: {
                        display: true,
                        labels: {
                            fontColor: 'rgb(0, 0, 0)'
                        },
                        position: 'top'
                    }
                }
            };
            return config;
        }

        var color = Chart.helpers.color;
        function createConfig(colorName) {
            return {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Quotes 2019",
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        borderDash: [5, 5],
                        fill: false,
                        data: [
                            {{ $data['quotes_2019'] }}
                        ],
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        labels: {
                            fontColor: 'rgb(0, 0, 0)'
                        },
                        position: 'top'
                    }
                }
            };
        }

        var cv1 = document.getElementById('chart-legend-pointstyle');
        var ctx1 = cv1.getContext('2d');
        var chart1 = new Chart(ctx1, createPieTypeLeadConfig('blue'));
        cv1.onclick = function(evt){
            var activePoint1 = chart1.getElementAtEvent(evt);
            var tipo = '';

            if ( activePoint1[0]._index == 0 ) {
                tipo = 'Leads';
            }
            if ( activePoint1[0]._index == 1 ) {
                tipo = 'Clients';
            }

            //window.location = 'http://127.0.0.1:8000/crm/account?filter_column%5Baccount.id%5D%5Btype%5D=&filter_column%5Baccount.id%5D%5Bsorting%5D=&filter_column%5Baccount.telephone%5D%5Btype%5D=&filter_column%5Baccount.telephone%5D%5Bsorting%5D=&filter_column%5Bstates.abbreviation%5D%5Btype%5D=&filter_column%5Bstates.abbreviation%5D%5Bvalue%5D=&filter_column%5Baccount.email%5D%5Btype%5D=&filter_column%5Baccount.email%5D%5Bsorting%5D=&filter_column%5Baccount.date_created%5D%5Btype%5D=&filter_column%5Baccount.date_created%5D%5Bsorting%5D=&filter_column%5Bcustomer_type.name%5D%5Btype%5D=%3D&filter_column%5Bcustomer_type.name%5D%5Bvalue%5D='+tipo+'&filter_column%5Bcustomer_type.name%5D%5Bsorting%5D=&filter_column%5Baccount.quotes%5D%5Btype%5D=&filter_column%5Baccount.quotes%5D%5Bsorting%5D=&filter_column%5Baccount.id_usuario%5D%5Btype%5D=&filter_column%5Baccount.id_usuario%5D%5Bsorting%5D=&lasturl=http%3A%2F%2F127.0.0.1%3A8000%2Fcrm%2Faccount%3Fm%3D50';
        };

        var cv = document.getElementById('chart-legend-normal');
        var ctx = cv.getContext('2d');
        var chart = new Chart(ctx, createConfig('red'));
        cv.onclick = function(evt){
            var activePoint = chart.getElementAtEvent(evt);
            //var mes = chart.data.labels[activePoint[0]._index];
            var mes = (activePoint[0]._index) + 1;
            var anno = '';
            var url_link = '';

            if (mes < 10) {
                mes = '0'+mes;
            }

            /*if ( activePoint[0]._datasetIndex == 0 ) {
                anno = '2019';
                url_link = 'http://127.0.0.1:8000/crm/orders?filter_column%5Buser_trucks.id%5D%5Btype%5D=&filter_column%5Buser_trucks.id%5D%5Bsorting%5D=&filter_column%5Bproducts_type.name%5D%5Btype%5D=&filter_column%5Bproducts_type.name%5D%5Bsorting%5D=&filter_column%5Buser_trucks.id_account%5D%5Btype%5D=&filter_column%5Buser_trucks.id_account%5D%5Bsorting%5D=&filter_column%5Buser_trucks.truck_date_created%5D%5Btype%5D=between&filter_column%5Buser_trucks.truck_date_created%5D%5Bvalue%5D%5B%5D='+anno+'-'+mes+'-01&filter_column%5Buser_trucks.truck_date_created%5D%5Bvalue%5D%5B%5D='+anno+'-'+mes+'-31&filter_column%5Buser_trucks.truck_date_created%5D%5Bsorting%5D=asc&filter_column%5Buser_trucks.truck_budget%5D%5Btype%5D=&filter_column%5Buser_trucks.truck_budget%5D%5Bsorting%5D=&filter_column%5Buser_trucks.id_account%5D%5Btype%5D=&filter_column%5Buser_trucks.id_account%5D%5Bvalue%5D=&filter_column%5Bsources.name%5D%5Btype%5D=&filter_column%5Bsources.name%5D%5Bvalue%5D=&filter_column%5Buser_trucks.truck_aprox_price%5D%5Btype%5D=&filter_column%5Buser_trucks.truck_aprox_price%5D%5Bsorting%5D=&lasturl=http%3A%2F%2F127.0.0.1%3A8000%2Fcrm%2Forders%3Fm%3D45';
            }*/
            //console.log('activePoint', activePoint[0]);
            //console.log('datos', activePoint[0]._datasetIndex);

            window.location = url_link;
        };


    </script>

    </body>

    </html>

@endsection