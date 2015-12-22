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
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>ระดับการศึกษาที่สำเร็จ</label>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>สาขาวิชาที่สำเร็จการศึกษา</label>
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
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

    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-file-text-o"></i> ผลลัพธ์การค้นหา
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ นามสกุล</th>
                        <th>สาขาวิชาที่สำเร็จการศึกษา</th>
                        <th>ระดับการศึกษาที่สำเร็จ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr>
                    <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr> <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr> <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr> <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr> <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr> <tr>
                        <td>5XXXXXX</td>
                        <td>นายกอไก่ ใจดี</td>
                        <td>รัฐศาสตร์</td>
                        <td>ปริญญาโท</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
