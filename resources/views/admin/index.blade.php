@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <a href="/admin/search">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-search fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h3>ค้นหา</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left">ค้นหาข้อมูลศิษย์เก่า</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" style="color: #5cb85c;"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="/admin/stats/mainmenu">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bar-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h3>รายงาน</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left">รายงานสถิติต่างๆ</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" style="color: #f0ad4e;"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="/admin/import">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cloud-upload fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h3>นำเข้า</h3>
                                <!--div>New Comments!</div-->
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <span class="pull-left">นำเข้าข้อมูลบัณฑิต</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" style="color: #d9534f;"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a target="_blank"
               href="https://www.facebook.com/groups/371288036329445/">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-facebook-official fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h3>FB Group</h3>
                                <!--div>New Comments!</div-->
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <span class="pull-left">กลุ่มศิษย์เก่า</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>
    </div>
    <!-- /.row -->

@endsection


@section('javascript')


@endsection
