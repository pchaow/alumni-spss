<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/banner.ico">

    <title>SAS : SPASs Alumni System</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bower/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bower/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/bower/startbootstrap-sb-admin-2/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/bower/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/bower/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bower/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

<nav class="navbar navbar-default navbar-static-top" role="navigation"
     style="margin-bottom: 0; background-color:#8B1C62;">
    <div class="navbar-header">
        <a class="navbar-brand" href="/admin/index" style="color: white;">SAS : SPSS Alumni System</a>
    </div>
    <!-- /.navbar-header -->

</nav>

<div class="row" style="padding-top:40px;">

   <!-- <div class="col-lg-4 col-lg-offset-2 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-graduation-cap"></i>
                ศิษย์เก่า
            </div>
            <div class="panel-body">
                <form  action="/user/index" method="get" class="form-signin">
                   csrf_field()}}
                    <div class="form-group">
                        <label>รหัสประจำตัวประชาชน</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="person_id" class="form-control" placeholder="รหัสประจำตัวประชาชน 13 หลัก">
                        </div>
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label>รหัสนิสิต</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="student_id" class="form-control" placeholder="รหัสนิสิต">
                        </div>
                        <p class="help-block"></p>
                    </div>

                    <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>

                </form>
            </div>

        </div>
    </div> -->
       <div class="col-lg-4 col-xs-12"></div>

    <div class="col-lg-4 col-xs-12">
        <div class="panel panel-info" style="color:#8B1C62;">
            <div class="panel-heading">
                <i class="fa fa-briefcase"></i>
                บุคลากรคณะรัฐศาสตร์ฯ มหาวิทยาลัยพะเยา
            </div>
            <div class="panel-body">
                <form action="/admin/auth/signin" method="post" class="form-signin">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>บัญชีผู้ใช้ มหาวิทยาลัยพะเยา</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input name="login[username]" type="text" class="form-control" placeholder="บัญชีผู้ใช้ มหาวิทยาลัยพะเยา">
                        </div>
                        <p class="help-block">กรุณากรอก Username</p>
                    </div>

                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input name="login[password]" type="password" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <p class="help-block">กรุณากรอก Password</p>
                    </div>

                    <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>

                </form>
            </div>

        </div>
    </div>

       <div class="col-lg-4 col-xs-12"></div>
</div>


</body>
</html>
