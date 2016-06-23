@extends('admin.layout')


@section('content')


    <div class="row">
        <div>
            <ol class="breadcrumb">
                <li><a href="/admin">หน้าหลัก</a></li>
                <li class="active">ค้นหาข้อมูลบัณฑิต</li>
            </ol>
            </div>
        <div class="col-lg-12">
            <h1 class="page-header">ค้นหาข้อมูลบัณฑิต</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-search"></i> เงื่อนไขการค้นหา
            </div>

            <form role="form" action="{{url('admin/search')}}" method="POST">
                {{csrf_field()}}
                <div class="panel-body" style="">
                    <form class="form">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>ปีที่เข้าศึกษา</label>
                                    <select name="education_year" id="year_of_education" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        @foreach($yearOfStartStudy as $value)
                                            <?php
                                            $selectedStr = "";
                                            if (isset($form) and $form['education_year'] == $value->yearOfStudy) {
                                                $selectedStr = 'selected="selected"';
                                            }
                                            ?>
                                            <option {{$selectedStr}} value="{{$value->yearOfStudy}}">{{$value->yearOfStudy}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>ปีที่สำเร็จการศึกษา</label>
                                    <select name="year_of_graduation" id="year_of_graduation" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        @foreach($yearOfGraduation as $value)
                                            <?php
                                            $selectedStr = "";
                                            if (isset($form) and $form['year_of_graduation'] == $value->yearOfGraduation) {
                                                $selectedStr = 'selected="selected"';
                                            }
                                            ?>
                                            <option {{$selectedStr}} value="{{$value->yearOfGraduation}}">{{$value->yearOfGraduation}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ระดับการศึกษาที่สำเร็จ</label>
                                    <select name="education" id="education" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        @foreach($degreeStudy as $value)
                                            <?php
                                            $selectedStr = "";
                                            if(isset($form) and  $form['education']){

                                            if ($form['education'] == $value->degree) {
                                                // $ystart = $_GET['yearGradStart'];
                                                $selectedStr = 'selected="selected"';
                                                ?>
                                                <Script>
                                                    $('#course').ready(function(){
                                                        var major = "<?php echo $form['course'];?>";
                                                        $.get('../../ajax-branch?degree_id=<?php echo $form['education'];?>', function(data){
                                                            //success data
                                                            console.log(data);
                                                            $('#course').empty();
                                                            $('#course').append('<option value="">ไม่ระบุ</option>');
                                                            $.each(data, function (index, branch) {
                                                                //console.log(years.yearofgraduation);
                                                                    if(branch.branch==major){
                                                                        $('#course').append('<option selected value="'+branch.branch+'">'+branch.branch+'</option>');
                                                                    }else{
                                                                        $('#course').append('<option value="'+branch.branch+'">'+branch.branch+'</option>');
                                                                    }





                                                            });
                                                        });
                                                    });

                                                </Script>
                                        <?php
                                            }
                                            }

                                            ?>
                                            <option {{$selectedStr}} value="<?php echo $value->degree;?>"><?php echo $value->degree;?></option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>สาขาวิชาที่สำเร็จการศึกษา</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value="">ไม่ระบุ</option>
                                        @foreach($branch as $value)
                                            <?php
                                            $selectedStr = "";
                                            if (isset($form) and $form['course'] == $value->branch) {
                                                $selectedStr = 'selected="selected"';
                                            }
                                            ?>
                                            <option {{$selectedStr}} value="<?php echo $value->branch;?>"><?php echo $value->branch;?></option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>รหัสนิสิต</label>
                                    <input name="student_id" id="student_id" value="{{$form['student_id'] or ''}}"
                                           placeholder="กรอกรหัสนิสิต เช่น 55123456" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input name="firstname" id="firstname" class="form-control" placeholder="กรอกชื่อ เช่น ชลติพันธ์"
                                           value="{{$form['firstname'] or ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>นามสกุล</label>
                                    <input name="lastname" id="lastname" class="form-control" placeholder="กรอกนามสกุล เช่น เปล่งวิทยา"
                                           value="{{$form['lastname'] or ''}}">
                                </div>
                            </div>


                        </div>

                        <div class="row" style="">
                            <div class="col-lg-12" style="text-align: center">
                                <button class="btn btn-success" type="submit">ค้นหา</button>

                            </div>
                        </div>

                    </form>
                </div>

            </form>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">

                <div class="panel-heading">
                    <i class="fa fa-file-text-o"></i> ผลลัพธ์การค้นหา
                </div>
                <div class="panel-body">
                    @if(isset($form))
                    <div class="row">
                        @if(isset($form) && count($data_alumni) != 0 )
                            <a class="btn btn-danger" href='/admin/export_excel?{{http_build_query($form)}}'>ส่งออกเป็น
                                Excel</a>
                        @endif
                    </div>
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-lg-1">

                        </div>
                        <div class="col-lg-11" style="text-align: center;">
                            @if(isset($form))
                                <!--พบข้อมูลทั้งหมดจำนวน $data_alumni->total() รายการ-->
                                    พบข้อมูลทั้งหมดจำนวน {{$count}} รายการ
                            @endif
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>รหัสนิสิต</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ระดับการศึกษาที่สำเร็จ</th>
                            <th>หลักสูตรที่สำเร็จการศึกษา</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;?>

                        @if(count($data_alumni) != 0)

                            @foreach ($data_alumni as $r)

                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$r["student_id"]}}</td>
                                    <td>{{$r["title"] . ' ' . $r["firstname"] . ' ' . $r["lastname"]}}</td>
                                    <td>{{$r["degree"] }}</td>
                                    <td>{{$r["course"]}}</td>

                                    <td>
                                        <a type="button" href="/admin/profile/{{$r->id}}" target="_blank"
                                           class="btn btn-primary">View</a>

                                    </td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center">ไม่พบข้อมูล</td>
                            </tr>
                        @endif
                        @endif
                        </tbody>

                    </table>

                    <!--<div align="center">!! $data_alumni->render() !!</div>-->


                </div>

            </div>
        </div>
    </div>

    <script>
        $('#education').on('change',function(e){
            //console.log(e);
            var education = e.target.value;
            //ajax
            $.get('../../ajax-branch?degree_id='+education, function(data){
                //success data
                //console.log(data);
                $('#course').empty();
                 $('#course').append('<option value="">ไม่ระบุ</option>');
                $.each(data, function (index, branch) {
                    //console.log(years.yearofgraduation);
                    $('#course').append('<option value="'+branch.branch+'">'+branch.branch+'</option>');


                });
            });
        });

    </script>



@endsection
