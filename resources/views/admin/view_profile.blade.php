@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ข้อมูลส่วนตัวบัณฑิต</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> ข้อมูลส่วนตัว
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label for="">ชื่อ-สกุล</label>
                            {{$alumni->title}}{{$alumni->firstname}} {{$alumni->lastname}}
                        </div>
                        <div class="form-group">
                            <label for="">รหัสนิสิต</label>
                            {{$alumni->student_id}}
                        </div>
                        <div class="form-group">
                            <label for="">คณะ</label>
                            {{$alumni->faculty}}
                        </div>
                        <div class="form-group">
                            <label for="">สาขา</label>
                            {{$alumni->branch}}
                        </div>
                        <div class="form-group">
                            <label for="">หลักสูตร</label>
                            {{$alumni->course}}
                        </div>

                        <div class="form-group">
                            <label for="">ระดับ</label>
                            {{$alumni->degree}}
                        </div>

                        <div class="form-group">
                            <label for="">เบอร์โทรติดต่อ</label>
                            {{$alumni->telephone}}
                        </div>

                        <div class="form-group">
                            <label for="">อีเมลล์</label>
                            {{$alumni->email}}
                        </div>

                        <div class="form-group">
                            <label for="">ภูมิลำเนา</label>
                            บ้านเลขที่ {{$alumni->houseNo}} หมู่ที่ {{$alumni->houseMo}} ถนน {{$alumni->houseRoad}}  ตำบล {{$alumni->houseDistinct}} อำเภอ {{$alumni->houseAmphur}} จังหวัด {{$alumni->houseProvince}}
                        </div>
                        <div class="form-group">
                            <label for="">สถานที่ทำงาน</label>
                            <?php
                                $lastestWorkplace = $alumni->questionnaires()->orderBy('created_at')->first();
                                //dd($lastestWorkplace);
                            ?>
                            {{$lastestWorkplace->QuestionWorkplaceName}} จังหวัด {{$lastestWorkplace->QuestionWorkplaceProvince}}
                        </div>

                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>

    </div>
    <!-- /.row -->

@endsection


@section('javascript')


@endsection
