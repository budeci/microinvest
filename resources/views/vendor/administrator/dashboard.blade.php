@extends('administrator::layout')

@section('content')
    <div class="content body">
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>

                        <p>Active Lots</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Lots <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Users <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lots Status</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-xs-6">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title">To Do List</h3>

                        <div class="box-tools pull-right">
                            <ul class="pagination pagination-sm inline">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <li>
                                <!-- drag handle -->
                                <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <!-- checkbox -->
                                <input type="checkbox" value="">
                                <!-- todo text -->
                                <span class="text">Design a nice theme</span>
                                <!-- Emphasis label -->
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <input type="checkbox" value="">
                                <span class="text">Make the theme responsive</span>
                                <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <input type="checkbox" value="">
                                <span class="text">Let theme shine like a star</span>
                                <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <input type="checkbox" value="">
                                <span class="text">Let theme shine like a star</span>
                                <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <input type="checkbox" value="">
                                <span class="text">Check your messages and notifications</span>
                                <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <input type="checkbox" value="">
                                <span class="text">Let theme shine like a star</span>
                                <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item
                    </button>
                </div>
                <!-- /.box -->
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Area Chart</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Line Chart</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            "use strict";

            // AREA CHART
            var area = new Morris.Area({
                element: 'revenue-chart',
                resize: true,
                data: [
                    {y: '2011 Q1', item1: 2666, item2: 2666},
                    {y: '2011 Q2', item1: 2778, item2: 2294},
                    {y: '2011 Q3', item1: 4912, item2: 1969},
                    {y: '2011 Q4', item1: 3767, item2: 3597},
                    {y: '2012 Q1', item1: 6810, item2: 1914},
                    {y: '2012 Q2', item1: 5670, item2: 4293},
                    {y: '2012 Q3', item1: 4820, item2: 3795},
                    {y: '2012 Q4', item1: 15073, item2: 5967},
                    {y: '2013 Q1', item1: 10687, item2: 4460},
                    {y: '2013 Q2', item1: 8432, item2: 5713}
                ],
                xkey: 'y',
                ykeys: ['item1', 'item2'],
                labels: ['Item 1', 'Item 2'],
                lineColors: ['#a0d0e0', '#3c8dbc'],
                hideHover: 'auto'
            });

            // LINE CHART
            var line = new Morris.Line({
                element: 'line-chart',
                resize: true,
                data: [
                    {y: '2011 Q1', item1: 2666},
                    {y: '2011 Q2', item1: 2778},
                    {y: '2011 Q3', item1: 4912},
                    {y: '2011 Q4', item1: 3767},
                    {y: '2012 Q1', item1: 6810},
                    {y: '2012 Q2', item1: 5670},
                    {y: '2012 Q3', item1: 4820},
                    {y: '2012 Q4', item1: 15073},
                    {y: '2013 Q1', item1: 10687},
                    {y: '2013 Q2', item1: 8432}
                ],
                xkey: 'y',
                ykeys: ['item1'],
                labels: ['Item 1'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto'
            });

            //DONUT CHART
            var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                colors: ["#3c8dbc", "#f56954", "#00a65a"],
                data: [
                    {label: "Download Sales", value: 50},
                    {label: "In-Store Sales", value: 30},
                    {label: "Mail-Order Sales", value: 20}
                ],
                hideHover: 'auto'
            });
            //BAR CHART
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                    {y: '2006', a: 100, b: 90},
                    {y: '2007', a: 75, b: 65},
                    {y: '2008', a: 50, b: 40},
                    {y: '2009', a: 75, b: 65},
                    {y: '2010', a: 50, b: 40},
                    {y: '2011', a: 75, b: 65},
                    {y: '2012', a: 100, b: 90}
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['CPU', 'DISK'],
                hideHover: 'auto'
            });
        });
    </script>
@endsection

