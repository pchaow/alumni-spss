<?php


$sql = "SELECT count(*) as `amount` , `alumni`.`branch` as `branch` , `workplace`.`province_office` as `province`

FROM
`alumni`
JOIN
`workplace`
ON alumni.id=workplace.alumni_id
WHERE
`education` = 'ปริญญาตรี'
group by `alumni`.`branch`, `workplace`.`province_office`";

$result = DB::select($sql);

$provinces = collect($result)->groupBy('province');

//dd($provinces);

$array = $provinces->toArray();

$resultArray = [];
foreach ($array as $key => $value) {
    $obj = [];
    foreach ($value as $data) {
        if ($key == '-') {
            $obj['province'] = 'ไม่ระบุ';
        } else {
            $obj['province'] = $key;
        }

        $obj[$data->branch] = $data->amount;
    }

    if (!array_key_exists('รัฐศาสตร์', $obj)) {
        $obj['รัฐศาสตร์'] = 0;
    }
    if (!array_key_exists('พัฒนาสังคม', $obj)) {
        $obj['พัฒนาสังคม'] = 0;
    }

    $resultArray[] = $obj;
}

//dd($resultArray);

$lava = new \Khill\Lavacharts\Lavacharts(); // See note below for Laravel

$population = $lava->DataTable();

$population = $population
        ->addStringColumn('จังหวัด')
        ->addNumberColumn("รัฐศาสตร์")
        ->addNumberColumn("พัฒนาสังคม")
        ->setDateTimeFormat('Y');

foreach ($resultArray as $value) {
    try {
        $population = $population->addRow([$value['province'], $value['รัฐศาสตร์'], $value['พัฒนาสังคม']]);
    } catch (Exception $e) {
        dd($value);
    }

}
$lava->BarChart('WorkplaceProvinceCount', $population, [
        'title' => 'กราฟสรุปจำนวนศิษย์เก่าแยกตามสาขาและจังหวัดตามสถานที่ทำงาน',
        'isStacked' => true,
]);

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> ตารางสรุปจำนวนศิษย์เก่าแยกตามสาขาและจังหวัดตามสถานที่ทำงาน
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="count_by_workplace_province_graph_panel" style="height: 1000px;"></div>

        <?php
        echo $lava->render('BarChart', 'WorkplaceProvinceCount', 'count_by_workplace_province_graph_panel');
        ?>

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
                            <td rowspan="{{count($value)}}">{{$key == '-' ? 'ไม่ระบุ' : $key}}</td>
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
