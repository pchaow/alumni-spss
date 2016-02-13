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
            <a href="/admin/stats">
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
                        <span class="pull-left">นำเข้าข้อมูลศิษย์เก่า</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" style="color: #d9534f;"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a target="_blank"
               href="https://www.facebook.com/%E0%B8%A3%E0%B8%B1%E0%B8%90%E0%B8%A8%E0%B8%B2%E0%B8%AA%E0%B8%95%E0%B8%A3%E0%B9%8C-%E0%B8%A1%E0%B8%AB%E0%B8%B2%E0%B8%A7%E0%B8%B4%E0%B8%97%E0%B8%A2%E0%B8%B2%E0%B8%A5%E0%B8%B1%E0%B8%A2%E0%B8%9E%E0%B8%B0%E0%B9%80%E0%B8%A2%E0%B8%B2-217829844912090/">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-facebook-official fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h3>FB Page</h3>
                                <!--div>New Comments!</div-->
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <span class="pull-left">Facebook Page</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-8">
            @include('admin.panels.summary_by_branch')
            @include('admin.panels.count_by_branch')
        </div>
        <div class="col-lg-4">
            <div class="fb-page"
                 data-href="https://www.facebook.com/%E0%B8%A3%E0%B8%B1%E0%B8%90%E0%B8%A8%E0%B8%B2%E0%B8%AA%E0%B8%95%E0%B8%A3%E0%B9%8C-%E0%B8%A1%E0%B8%AB%E0%B8%B2%E0%B8%A7%E0%B8%B4%E0%B8%97%E0%B8%A2%E0%B8%B2%E0%B8%A5%E0%B8%B1%E0%B8%A2%E0%B8%9E%E0%B8%B0%E0%B9%80%E0%B8%A2%E0%B8%B2-217829844912090/"
                 data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false"
                 data-show-facepile="true"></div>
        </div>
    </div>
    <!-- /.row -->

@endsection


@section('javascript')


@endsection