@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ข้อมูลศิษย์เก่า</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-8">
            <div class="panel panel-default">
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
                            {{$alumni->education}}
                        </div>

                        <div class="form-group">
                            <label for="">ภูมิลำเนา</label>
                            {{$alumni->amphur}} {{$alumni->province}}
                        </div>
                        <div class="form-group">
                            <label for="">สถานที่ทำงาน</label>
                            <?php
                                $lastestWorkplace = $alumni->workplace()->orderBy('created_at')->first();
                            ?>
                            {{$lastestWorkplace->office}} จังหวัด{{$lastestWorkplace->province_office}}
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> รูป
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <img src="/images/wanasat.png" style="width: 100%">
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    <!-- /.row -->

@endsection


@section('javascript')


@endsection