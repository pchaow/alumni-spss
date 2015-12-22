<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

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

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">SAS : SPSS Alumni System</a>
    </div>
    <!-- /.navbar-header -->

</nav>

<div class="row" style="padding-top:40px;">

    <div class="col-lg-4 col-lg-offset-2 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-graduation-cap"></i>
                ศิษย์เก่า
            </div>
            <div class="panel-body">
                <form action="#" method="post" class="form-signin">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>รหัสประจำตัวประชาชน</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="รหัสประจำตัวปรชาชน 13 หลัก">
                        </div>
                        <p class="help-block">Example block-level help text here.</p>
                    </div>

                    <div class="form-group">
                        <label>วันเกิด</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="date" class="form-control" placeholder="วันเกิด">
                        </div>
                        <p class="help-block">Example block-level help text here.</p>
                    </div>

                    <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>

                </form>
            </div>

        </div>
    </div>

    <div class="col-lg-4 col-xs-12">
        <div class="panel panel-green">
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
                        <p class="help-block">Example block-level help text here.</p>
                    </div>

                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input name="login[password]" type="password" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <p class="help-block">Example block-level help text here.</p>
                    </div>

                    <button type="submit" class="btn btn-success">เข้าสู่ระบบ</button>

                </form>
            </div>

        </div>
    </div>


</div>


</body>
</html>