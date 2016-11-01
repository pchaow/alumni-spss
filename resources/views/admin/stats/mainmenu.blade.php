@extends('admin.layout')



@section('content')
    <ol class="breadcrumb">
        <li><a href="../">หน้าหลัก</a></li>
        <li class="active">รายงานสถิติ</li>
    </ol>

    <div class="panel panel-warning">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> รายงานสถิติ
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

            <div class="col-lg-4 col-md-6">
                <a href="/admin/stats/graduates?view=index">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3>จำนวนบัณฑิต</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left">จำนวนบัณฑิต</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"
                                                        style="color: #5cb85c;"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6">
                <a href="/admin/stats/mapwork?view=index">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-globe fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3>สถานที่ทำงาน</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left">สถานที่ทำงานของบัณฑิต</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"
                                                        style="color: #f0ad4e;"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="/admin/stats/maphome">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3>ภูมิลำเนา</h3>
                                    <!--div>New Comments!</div-->
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">ภูมิลำเนาของบัณฑิต</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"
                                                        style="color: #d9534f;"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="/admin/stats/work_status?view=index">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-briefcase fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3>ภาวะการมีงานทำ</h3>
                                    <!--div>New Comments!</div-->
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">ภาวะการมีงานทำของบัณฑิต</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="/admin/stats/workplace_type?view=index">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-street-view fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3>ประเภทงาน</h3>
                                    <!--div>New Comments!</div-->
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">ประเภทงานของบัณฑิต</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="/admin/stats/duration_get_job?view=index">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3>ช่วงเวลาในการได้งานทำ</h3>
                                    <!--div>New Comments!</div-->
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">ช่วงเวลาในการได้งานทำ</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
