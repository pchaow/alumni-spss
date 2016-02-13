@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ข้อมูลนิสิตเก่า</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> ข้อมูลทั่วไป
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label for="">ชื่อ-สกุล</label>
                            นายวนศาสตร์ โสมพันธุ์
                        </div>
                        <div class="form-group">
                            <label for="">รหัสนิสิต</label>
                            55023500
                        </div>
                        <div class="form-group">
                            <label for="">คณะ</label>
                            ศิลปศาสตร์
                        </div>
                        <div class="form-group">
                            <label for="">สาขา</label>
                            รัฐศาสตร์
                        </div>
                        <div class="form-group">
                            <label for="">หลักสูตร</label>
                            รัฐศาสตร์บัณฑิต
                        </div>

                        <div class="form-group">
                            <label for="">ระดับ</label>
                            ปริญญาตรี
                        </div>

                        <div class="form-group">
                            <label for="">ภูมิลำเนา</label>
                            อำเภอภูซาง จังหวัดพะเยา
                        </div>
                        <div class="form-group">
                            <label for="">สถานที่ทำงาน</label>
                            บริษัทพัฒนาโปรแกรมจำกัด  กรุงเทพมหานคร
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