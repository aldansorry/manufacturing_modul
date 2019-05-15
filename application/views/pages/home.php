<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $data->product ?></span></div>
                                            <div class="stat-heading">Product</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $data->bom ?></span></div>
                                            <div class="stat-heading">Bom</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $data->manufactur ?></span></div>
                                            <div class="stat-heading">Manufactur</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $data->users ?></span></div>
                                            <div class="stat-heading">Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Manufacturing Status</h4>
                                <canvas id="pieChart" height="100px"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                <h4 class="mb-3">Montly Manufacturing </h4>
                                <canvas id="singelBarChart" height="315" width="631" class="chartjs-render-monitor" style="display: block; width: 631px; height: 315px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<script>
    <?php 
    $index = 0;
    $string_data = "";
    while($index < 5){
        $is_exist = false;
        foreach ($status as $key => $value) {
            if ($value->status == $index) {
                $is_exist = true;
                break;
            }
        }
        if($is_exist){
            $string_data .= $value->jumlah.",";
        }else{
            $string_data .= "0,";
        }
        $index++;
    }
    $string_data = substr($string_data, 0,-1);

    $string_data_manufactur = "";
    $index = 0;
    while($index < 5){
        $is_exist = false;
        foreach ($manufacturing as $key => $value) {
            if ($value->month == $index) {
                $is_exist = true;
                break;
            }
        }
        if($is_exist){
            $string_data_manufactur .= $value->jumlah.",";
        }else{
            $string_data_manufactur .= "0,";
        }
        $index++;
    }
    $string_data = substr($string_data, 0,-1);
    ?>

    var arrayData = [ <?php echo $string_data; ?> ];

    $(document).ready(function(){
      //pie chart
      var ctx = document.getElementById( "pieChart" );
      ctx.height = 300;
      var myChart = new Chart( ctx, {
        type: 'pie',
        data: {
            datasets: [ {
                data: arrayData,
                backgroundColor: [
                "rgba(255, 102, 102,0.8)",
                "rgba(165, 165, 165,0.9)",
                "rgba(91, 255, 255,0.8)",
                "rgba(37, 83, 249,0.7)",
                "rgba(121, 255, 112,0.5)"
                ],
                hoverBackgroundColor: [
                "rgb(255, 102, 102)",
                "rgb(165, 165, 165)",
                "rgb(91, 255, 255)",
                "rgb(37, 83, 249)",
                "rgb(121, 255, 112)"
                ]

            } ],
            labels: [
            "Canceled",
            "Checking",
            "Confirmed",
            "Progress",
            "Done",
            ]
        },
        options: {
            responsive: true
        }
    } );

      var data_manufacturing = [ <?php echo $string_data_manufactur ?> ];

      var ctx = document.getElementById( "singelBarChart" );
    ctx.height = 600;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
            datasets: [
                {
                    label: "Jumlah Manufacturing",
                    data: data_manufacturing,
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 194, 146, 0.5)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    } );
  })
</script>