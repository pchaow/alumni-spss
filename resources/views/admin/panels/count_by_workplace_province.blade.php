<?php


$sql = "SELECT count(*) as `amount` , `alumni`.`branch` as `branch` , `workplace`.`province_office` as `province`

FROM
`alumni`
JOIN
`workplace`
ON alumni.id=workplace.alumni_id
group by `alumni`.`branch`, `workplace`.`province_office`";

$result = DB::select($sql);

$provinces = collect($result)->groupBy('province');

//dd($provinces);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนศิษย์เก่าแยกตามสาขาและจังหวัดตามสถานที่ทำงาน
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>จังหวัด</th>
                <th>สาขา</th>
                <th>จำนวนศิษย์เก่า</th>
            </tr>
            </thead>
            <tbody>

            ​@foreach($provinces as $key => $value)
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
