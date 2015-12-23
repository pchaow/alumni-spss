@extends('user.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">แก้ไขข้อมูลส่วนตัว</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-lg-12">
            <form role="form">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        ข้อมูลส่วนตัว
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">


                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label>คำนำหน้าชื่อ</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label>ชื่อ</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>นามสกุล</label>
                                        <input class="form-control">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>รหัสบัตรประชาชน</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>รหัสนิสิต</label>
                                        <input class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>วัน/เดือน/ปี เกิด</label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>GPA</label>
                                        <input class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>ระดับการศึกษา</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>คณะ</label>
                                        <input class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>สาขาวิชา</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>หลักสูตร</label>
                                        <input class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="col-lg-6" style="padding-left: 0px">
                                            <label>บ้านเลขที่</label>
                                            <input class="form-control">
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0px">
                                            <label>หมู่</label>
                                            <input class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <div class="col-lg-6" style="padding-left: 0px">
                                            <label>ซอย</label>
                                            <input class="form-control">
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0px">
                                            <label>ถนน</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label>ตำบล</label>
                                        <select class="form-control"></select>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>อำเภอ</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>จังหวัด</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>รหัสไปรษณีย์</label>
                                        <input class="form-control">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-lg-3">
                                        <label>โทรศัพท์บ้าน</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>โทรศัพท์มือถือ</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>E-Mail</label>
                                        <input class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        ข้อมูลการทำงาน
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>สถานที่ทำงาน</label>
                                    <input class="form-control">
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="col-lg-6" style="padding-left: 0px">
                                            <label>เลขที่</label>
                                            <input class="form-control">
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0px">
                                            <label>หมู่</label>
                                            <input class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <div class="col-lg-6" style="padding-left: 0px">
                                            <label>อาคาร</label>
                                            <input class="form-control">
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0px">
                                            <label>ชั้น</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label>ซอย</label>
                                        <select class="form-control"></select>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>ถนน</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>ตำบล</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>อำเภอ</label>
                                        <input class="form-control">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-lg-3">
                                        <label>จังหวัด</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>รหัสไปรษณี</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>โทรศัพท์</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>โทรสาร</label>
                                        <input class="form-control">
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="form-group col-lg-3">
                                        <label>E-Mail ที่ทำงาน</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>หน่วยงานที่ทำ</label>
                                        <select class="form-control">
                                            <option>รัฐบาล</option>
                                            <option>เอกชน</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>ตำแหน่ง</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>เงินเดือน</label>
                                        <input type="number" class="form-control">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-lg-6">
                                        <label>ประเภทงาน</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>สถานะการทำงาน</label>
                                        <select class="form-control">
                                            <option>ทำงานแล้ว</option>
                                            <option>ยังไม่ได้ทำงาน</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>สาเหตุที่ไม่มีงานทำ</label>
                                        <input class="form-control">
                                    </div>

                                </div>


                            </div>

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        ข้อมูลอื่นๆ
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>นำความรู้ที่เรียนมาประยุกต์ใช้กับงานที่ทำ</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>ปัญหาในการทำงาน</label>
                                        <input class="form-control">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>งานตรงกับสายที่เรียนมา</label>
                                        <select class="form-control">
                                            <option>ตรง</option>
                                            <option>ไม่ตรง</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>ความสามารถพิเศษที่ช่วยในการทำงาน</label>
                                        <input class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>ระยะเวลาที่ได้งานทำ</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>ปัญหาในการทำงาน</label>
                                        <input class="form-control">
                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

                <div class="form-group">
                    <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                    <button type="submit" class="btn btn-default">ล้างข้อมูล</button>
                </div>
            </form>


        </div>
        <!-- /.col-lg-12 -->
    </div>



@endsection
