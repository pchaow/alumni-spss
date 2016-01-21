<?php


$sql = "SELECT count(*) as `amount` , `alumni`.`branch` as `branch` , `alumni`.`year_of_graduation` as `yearGrad` FROM `alumni` group by `alumni`.`branch`, `alumni`.`year_of_graduation`";

$result = DB::select($sql);

$yearGradGroup = collect($result)->groupBy('yearGrad');


//dd($yearGradGroup);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนศิษย์เก่าแยกตามสาขาและปีที่จบการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

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
                    <td colspan="2">รวม</td>
                    <td>{{$sum}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
