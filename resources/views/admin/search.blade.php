@extends('admin.layout')

@section('css')
    <link href="/assets/css/search_custom.css" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ค้นหาข้อมูลศิษย์เก่า</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="panel panel-green">
            <div class="panel-heading">
                <i class="fa fa-search"></i> เงื่อนไขการค้นหา
            </div>
            <div class="panel-body" style="">
                <form class="form">
                    <div class="row">

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>ปีที่เข้าศึกษา</label>
                                <select class="form-control">
                                    <option>ไม่ระบุ</option>
                                    <option>2557</option>
                                    <option>2556</option>
                                    <option>2555</option>
                                    <option>2554</option>
                                    <option>2553</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>ระดับการศึกษาที่สำเร็จ</label>
                                <select class="form-control">
                                    <option>ไม่ระบุ</option>
                                    <option>ปริญญาตรี</option>
                                    <option>ปริญญาโท</option>
                                    <option>ปริญญาเอก</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>หลักสูตรที่สำเร็จการศึกษา</label>
                                <select class="form-control">
                                    <option>ไม่ระบุ</option>
                                    <option>รัฐศาสตรบัณฑิต (ร.บ.)</option>
                                    <option>ศิลปศาสตรบัณฑิต (ศศ.บ.) สาขาวิชาพัฒนาสังคม</option>
                                    <option>หลักสูตรรัฐประศาสนศาสตรมหาบัณฑิต (รป.ม.) สาขาวิชานโยบายสาธารณะ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>เพศ</label>
                                <select class="form-control">
                                    <option>ไม่ระบุ</option>
                                    <option>ชาย</option>
                                    <option>หญิง</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>รหัสนิสิต</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>ชื่อ</label>
                                <input class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input class="form-control">
                            </div>
                        </div>


                    </div>

                    <div class="row" style="">
                        <div class="col-lg-12" style="text-align: center">
                            <button class="btn btn-success" type="submit">ค้นหา</button>
                            <button class="btn btn-default" type="reset">รีเซ็ต</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $i = 10; $s = 1; ?>
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-file-text-o"></i> ผลลัพธ์การค้นหา
            </div>
            <div class="panel-body">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-lg-1">
                        <button class="btn btn-success"><i class="fa fa-cloud-download"></i> ส่งออกเป็น Excel</button>
                    </div>
                    <div class="col-lg-11" style="text-align: center;">
                        พบข้อมูลทั้งหมดจำนวน {{$i}} รายการ

                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ นามสกุล</th>
                        <th>สาขาวิชาที่สำเร็จการศึกษา</th>
                        <th>ระดับการศึกษาที่สำเร็จ</th>
                        <th>จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 10; $s = 1; ?>
                    @for($s=0;$s<$i;$s++)
                        <tr>
                            <td>5XXXXXX</td>
                            <td>นายกอไก่ ใจดี</td>
                            <td>รัฐศาสตร์</td>
                            <td>ปริญญาโท</td>
                            <td style="text-align: center;">
                                <button type="button" class="btn btn-primary" >View</button>
                                <button type="button" class="btn btn-default">Edit</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
