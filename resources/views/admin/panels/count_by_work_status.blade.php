<?php


$sql = "SELECT count(*) as `amount` , `alumni`.`branch` as `branch` , `alumni`.`year_of_graduation` as `yearGrad` , `questionnaire`.`functional_status` as `work_status` FROM `alumni` JOIN `Questionnaire` On alumni.id = questionnaire.alumni_id group by `alumni`.`branch`, `alumni`.`year_of_graduation`, `questionnaire`.`functional_status`";

$result = DB::select($sql);

$yearGradGroup = collect($result)->groupBy('yearGrad');


//dd($yearGradGroup);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนศิษย์เก่าตามสถานะการทำงานแยกตามสาขาและปีที่จบการศึกษา
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ปีที่จบการศึกษา</th>
                <th>สาขา</th>
                <th>สถานะการทำงาน</th>
                <th>จำนวนศิษย์เก่า</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($yearGradGroup as $key => $value)
                <?php
                $firstRow = true;

                ?>
                @foreach($value as $subValue)
                    <tr>

                        @if($firstRow)
                            <td rowspan="{{count($value)}}">{{$key}}</td>
                        @endif
                        <td>{{$subValue->branch}}</td>
                            <td>{{$subValue->work_status}}</td>
                        <td>{{$subValue->amount}}</td>
                    </tr>
                    <?php
                    $firstRow = false;
                    ?>
                @endforeach

            
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.panel-body -->
</div>
