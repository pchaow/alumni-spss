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

            <form role="form" action="<?php echo url('admin/search')?>" method="POST">
                {{csrf_field()}}
                <div class="panel-body" style="">
                    <form class="form">
                        <div class="row">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>ปีที่เข้าศึกษา</label>
                                    <select name="year_of_graduation" id="year_of_graduation" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        <option value="2558">2558</option>
                                        <option value="2557">2557</option>
                                        <option value="2556">2556</option>
                                        <option value="2555">2555</option>
                                        <option value="2554">2554</option>
                                        <option value="2553">2553</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ระดับการศึกษาที่สำเร็จ</label>
                                    <select name="education" id="education" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        <option value="ปริญญาตรี">ปริญญาตรี</option>
                                        <option value="ปริญญาโท">ปริญญาโท</option>
                                        <option value="ปริญญาเอก">ปริญญาเอก</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>หลักสูตรที่สำเร็จการศึกษา</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        <option value="">รัฐศาสตรบัณฑิต (ร.บ.)</option>
                                        <option value="">ศิลปศาสตรบัณฑิต (ศศ.บ.) สาขาวิชาพัฒนาสังคม</option>
                                        <option value="">หลักสูตรรัฐประศาสนศาสตรมหาบัณฑิต (รป.ม.)
                                            สาขาวิชานโยบายสาธารณะ
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>เพศ</label>
                                    <select name="title" id="title" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        <option value="ชาย">ชาย</option>
                                        <option value="หญิง">หญิง</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>รหัสนิสิต</label>
                                    <input name="student_id" id="student_id" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input name="firstname" id="firstname" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>นามสกุล</label>
                                    <input name="lastname" id="lastname" class="form-control">
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
            </form>

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
                    @if($data_alumni != "")
                        <?php
                        foreach ($data_alumni as $r) {

                            print '
                            <tr>
                                <td>' . $r["student_id"] . '</td>
                                <td>' . $r["title"] . ' ' . $r["firstname"] . ' ' . $r["lastname"] . '</td>
                                 <td>' . $r["faculty"] . '</td>
                                 <td>' . $r["education"] . '</td>
                                <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" >View</button>
                                        <button type="button" class="btn btn-default">Edit</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            ';
                        }
                        ?>
                    @else
                        <tr> <td>ไม่พอข้อมูล</td> </tr>
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>





@endsection
