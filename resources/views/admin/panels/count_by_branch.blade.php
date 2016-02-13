<?php


$sql = "SELECT count(*) as `amount` , `alumni`.`branch` as `branch` , `alumni`.`year_of_graduation` as `yearGrad` FROM `alumni` WHERE `education` = 'ปริญญาตรี' group by `alumni`.`branch`, `alumni`.`year_of_graduation`";

$result = DB::select($sql);

$yearGradGroup = collect($result)->groupBy('yearGrad');

$array = $yearGradGroup->toArray();

$resultArray1 = [];
foreach ($array as $key => $value) {
    $obj = [];
    foreach ($value as $data) {
        $obj['year'] = $key;
        $obj[$data->branch] = $data->amount;
    }
    $resultArray1[] = $obj;
}

//dd($resultArray1);

$lava1 = new \Khill\Lavacharts\Lavacharts(); // See note below for Laravel

$population1 = $lava1->DataTable();

$population1 = $population1
        ->addStringColumn('ปีที่จบการศึกษา')
        ->addNumberColumn("รัฐศาสตร์")
        ->addNumberColumn("พัฒนาสังคม")
        ->setDateTimeFormat('Y');

foreach ($resultArray1 as $value) {
    $population1 = $population1->addRow([$value['year'], $value['รัฐศาสตร์'], $value['พัฒนาสังคม']]);
}
$lava1->ColumnChart('BranchCountYear', $population1, [
        'title' => 'จำนวนนิสิตที่จบการศึกษาแยกตามสาขาและปีที่จบ'
]);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนศิษย์เก่าแยกตามสาขาและปีที่จบการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_branch_graph_panel" style="height: 500px;"></div>

        <?php
        echo $lava1->render('ColumnChart', 'BranchCountYear', 'count_by_branch_graph_panel');
        ?>

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีที่จบการศึกษา</th>
                <th>สาขา</th>
                <th>จำนวนศิษย์เก่า</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($yearGradGroup as $key => $value)
                <?php
                $firstRow = true;
                $sum = 0;
                ?>
                @foreach($value as $subValue)
                    <tr>
                        <?php $sum = $sum + $subValue->amount; ?>
                        @if($firstRow)
                            <td rowspan="{{count($value)}}">{{$key}}</td>
                        @endif
                        <td>{{$subValue->branch}}</td>
                        <td>{{$subValue->amount}}</td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

                <tr class="success">
                    <td colspan="2" style="text-align: right">รวม</td>
                    <td>{{$sum}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
