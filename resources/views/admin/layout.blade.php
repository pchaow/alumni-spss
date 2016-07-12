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
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @yield('css')
    <style type="text/css">
        #toTopImg {
            position: fixed;
            bottom: 20px;
            right: 30px;
            cursor: pointer;
            display: none;
            z-index: 999999;
            background: #eeeeee none repeat scroll 0 0;
            display: block;
            padding: 12px 15px;
        }
    </style>

    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/bower/jquery/dist/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/bower/jquery/dist/jquery.min.js"><\/script>')</script>
    <script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="/bower/holderjs/holder.min.js"></script>


    <!-- Metis Menu Plugin JavaScript -->
    <script src="/bower/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/bower/raphael/raphael-min.js"></script>
    <script src="/bower/morrisjs/morris.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/bower/highcharts/highcharts.js"></script>
    <script src="/bower/highcharts/modules/map.js"></script>
    <script src="/bower/highcharts/modules/drilldown.js"></script>
    <script src="/bower/highcharts/modules/exporting.js"></script>
    <script src="/bower/highcharts/modules/offline-exporting.js"></script>
    <script src="/bower/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js"></script>


    @yield('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').append('<div id="toTopImg" style="display:none"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>');
            $(window).scroll(function () {
                if ($(this).scrollTop() != 0) {
                    $('#toTopImg').fadeIn();
                } else {
                    $('#toTopImg').fadeOut();
                }
            });
            $('#toTopImg').click(function () {
                $("html, body").animate({scrollTop: 0}, 600);
                return false;
            });
        });
    </script>
</head>

<body>
<div id="wrapper">
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation"
             style="margin-bottom: 0; background-color:#8B1C62;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin/index" style="color: white;">SAS : SPSS Alumni System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        {{--
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        --}}
                        <li><a href="/admin/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" style="padding-bottom: 40px;">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            ยินดีต้อนรับ,
                            @if(Auth::user())
                                คุณ{{Auth::user()->firstname}} {{Auth::user()->lastname}}
                            @else
                                คุณผู้ใช้ มหาวิทยาลัย
                            @endif
                        </li>
                        <li>
                            <a href="/admin/index"><i class="fa fa-dashboard fa-fw"></i> หน้าหลัก</a>
                        </li>

                        <li>
                            <a href="/admin/search"><i class="fa fa-search fa-fw"></i> ค้นหาบัณฑิต</a>
                        </li>
                        <li>
                            <a href="/admin/stats/mainmenu"><i class="fa fa-bar-chart-o fa-fw"></i> รายงานสถิติ</a>

                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="/admin/import"><i class="fa fa-cloud-upload fa-fw"></i> นำเข้าข้อมูล</a>
                        </li>
                        <li>
                            <a href="/admin/contact"><i class="fa fa-info fa-fw"></i> ช่วยเหลือ</a>
                        </li>
                    </ul>
                </div>


            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            @yield('content')
        </div>


        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>


</body>
</html>
