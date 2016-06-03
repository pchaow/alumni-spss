<?php
$yearGradStart = $_GET['yearGradStart'];
$yearGradEnd = $_GET['yearGradEnd'];


$sql = "SELECT `alumni`.`yearofgraduation`,`alumni`.`degree` as `degree`,
`alumni`.`branch`,
count(*) as `amount`
FROM `alumni`
WHERE yearofgraduation BETWEEN $yearGradStart AND $yearGradEnd
group by `alumni`.`yearofgraduation`,`alumni`.`branch`" ;

$result = DB::select($sql);

$yeargardgroup = collect($result)->groupBy('yearofgraduation');
//dd($yeargardgroup);


$branchGroup = collect($result)->groupBy('branch');
//dd($branchGroup);
//$array = $degreeGroup->toArray();
$masterarray = [];
$subarray = [];
//$degreeGradGroup = collect($result)->groupBy('degree');
//dd($degreeGradGroup);
        $arrofyeargrad=[];

foreach ($yeargardgroup as $key=>$value) {
    $arrofyeargrad[]=$key;
}


foreach ($branchGroup as $key=>$value) {
    $sum=0;
    $branch = new stdClass();
    $branch->name = $key;



    $branch->stack = $value[0]->degree;
    $serieValue=[];



    $i=0;

foreach ($arrofyeargrad as $year) {

   foreach ($value as $subkey => $subvalue) {

       if($year == $subvalue->yearofgraduation){

           $serieValue[$i]=$subvalue->amount;
           break;

       }else{
           $serieValue[$i]= 0;
       }


       //$serieValue=[];

     $sum=$sum+$subvalue->amount;

   }
    $i++;
}
    $branch->data = $serieValue;

    $masterarray[] = $branch;


}
//dd($masterarray);
//dd($valueofbranch);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนบัณฑิตตามสาขาวิชา ปีการศึกษาที่จบ
        <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_year_graph_panel" style="height: 500px;"></div>

        <script>
            $(function () {
                $('#count_by_year_graph_panel').highcharts({

                    chart: {
                        type: 'column'
                    },

                    title: {
                        text: 'จำนวนบัณฑิตตามสาขาวิชา ปีการศึกษาที่จบ <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?>'
                    },

                    xAxis: {
                        title: {text: 'ปีการศึกษาที่จบ'},
                        categories: <?php echo json_encode($arrofyeargrad); ?>

            },

                yAxis: {
                    allowDecimals: false,
                            min: 0,
                            title: {
                        text: 'จำนวนบัณฑิต(คน)'
                    }
                },

                tooltip: {
                    formatter: function () {
                        return '<b>' + this.x + '</b><br/>' +
                                this.series.name + ': ' + this.y + '<br/>'; //+
                                //'Total: ' + this.y.stackTotal;
                    }
                },

                plotOptions: {
                    column: {
                        //stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            //format: '{point.y:.1f}%'
                        }
                    }

                },

                series: <?php echo json_encode($masterarray); ?>
            });

                var chart = $('#count_by_year_graph_panel').highcharts(),
                        $button = $('#button');
                $button.click(function () {
                    var series = chart.series[0];
                    if (series.visible) {
                        series.hide();
                        $button.html('แสดงทั้งหมด');
                    } else {
                        series.show();
                        $button.html('ซ่อนปริญญาโท');
                    }


                });


            });
        </script>
        <button id="button" class="autocompare">ซ่อนปริญญาโท</button>
      </div>

    <h3>จำนวนบัณฑิตตามสาขาวิชา ปีการศึกษาที่จบ <?php if($yearGradStart==$yearGradEnd){echo $yearGradStart;}else {echo $yearGradStart; echo " ถึง "; echo $yearGradEnd;} ?></h3>
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>ปีการศึกษาที่จบ</th>
            <th>ระดับปริญญา</th>
            <th>สาขาวิชา</th>
            <th>จำนวนบัณฑิต(คน)</th>
        </tr>
        </thead>
        <tbody>
        <?php  $total = 0;?>
        ​@foreach($yeargardgroup  as $key => $value)
            <?php
            $firstRow = true;

            $sum = 0;

            ?>
            @foreach($value as $subValue)
                <tr>
                    <?php $sum = $sum + $subValue->amount;
                     $total = $total + $subValue->amount;?>
                    @if($firstRow)
                        <td rowspan="{{count($value)}}">{{$key}}</td>
                    @endif
                        <td>{{$subValue->degree}}</td>
                        <td>{{$subValue->branch}}</td>
                    <td>{{$subValue->amount}}</td>
                </tr>
                <?php
                $firstRow = false;
                ?>
            @endforeach

            <tr class="success">
                <td colspan="3" style="text-align: right">รวม</td>
                <td>{{$sum}}</td>
            </tr>
        @endforeach
        <tr >
            <td colspan="3" style="text-align: right">รวมทั้งหมด</td>

            <td>{{$total}}</td>
        </tr>
        </tbody>
    </table>
</div>