@extends('admin.layouts.app')

@section('content')
    <div class="block-header">
        <h2>Control Board</h2>
    </div>
    <div class="row clearfix">
        <!-- Products -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">shopping_basket</i> <!-- Updated icon for products -->
                </div>
                <div class="content">
                    <div class="text">TOTAL PRODUCTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalProducts }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>

        <!-- Deals -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">local_offer</i> <!-- Updated icon for deals -->
                </div>
                <div class="content">
                    <div class="text">TOTAL DEALS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalDeals }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i> <!-- Updated icon for revenue -->
                </div>
                <div class="content">
                    <div class="text">TOTAL REVENUE</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalRevenue }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>

        <!-- Reviews -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">rate_review</i> <!-- Updated icon for reviews -->
                </div>
                <div class="content">
                    <div class="text">TOTAL REVIEWS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $totalReviews }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>Monthly Sales Performance
                            </h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <div class="switch panel-switch-btn">
                                <span class="m-r-10 font-12">REAL TIME</span>
                                <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                            </div>
                        </div>
                    </div>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div id="real_time_chart" class="dashboard-flot-chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js2')
        <script>
            $(function () {
                var realtime = 'on';

                // Function to fetch real-time data from server
                function fetchMonthlyOrders() {
                    // Fetch the data from an API endpoint, you can use an actual route for this.
                    return $.getJSON("{{ route('seller.monthly-orders') }}", function (data) {
                        return data;
                    });
                }

                // Function to initialize the real-time chart
                function initRealTimeChart(chartData) {
                    var plot = $.plot('#real_time_chart', [chartData], {
                        series: {
                            shadowSize: 0,
                            color: 'rgb(0, 188, 212)'
                        },
                        grid: {
                            borderColor: '#f3f3f3',
                            borderWidth: 1,
                            tickColor: '#f3f3f3'
                        },
                        lines: {
                            fill: true
                        },
                        yaxis: {
                            min: 0
                        },
                        xaxis: {
                            min: 1,
                            max: 12,
                            tickFormatter: function (val) {
                                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                return months[val - 1];
                            }
                        }
                    });

                    return plot;
                }

                // Function to update the chart with new data
                function updateRealTimeChart(plot) {
                    fetchMonthlyOrders().then(function (data) {
                        var chartData = data.map(function (order) {
                            return [order.month, order.total_orders];
                        });

                        plot.setData([chartData]);
                        plot.draw();

                        if (realtime === 'on') {
                            setTimeout(function () {
                                updateRealTimeChart(plot);
                            }, 3000); // Fetch new data every 3 seconds
                        }
                    });
                }

                // Initial data from the server passed to the view
                var monthlyOrders = @json($monthlyOrders);

                // Prepare the data for the chart
                var chartData = monthlyOrders.map(function (order) {
                    return [order.month, order.total_orders];
                });

                // Initialize the real-time chart with initial data
                var plot = initRealTimeChart(chartData);

                // Update the chart in real-time
                updateRealTimeChart(plot);

                // Toggle real-time updates on/off
                $('#realtime').on('change', function () {
                    realtime = this.checked ? 'on' : 'off';
                });
            });
        </script>
@endpush
