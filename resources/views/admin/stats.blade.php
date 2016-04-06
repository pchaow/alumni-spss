@extends('admin.layout')

@section('css')
    <link href="/assets/css/search_custom.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="../admin">หน้าหลัก</a></li>
        <li class="active">รายการสถิติ</li>
    </ol>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> รายการสถิติ
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

            <div class="row">
                <table class="table table-bordered table-hover table-striped">

                    <tbody>
                    <tr>
                        <td>
                            <a href="/admin/stat_by_graduates">- จำนวนบัณฑิต</a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="/admin/stat/map">- จำนวนนิสิตตามภูมิลำเนาในประเทศไทย</a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/admin/stat_work_status_by_branch_year_menu">- ภาวะการมีงานทำ
                                ตามสาขาวิชาและปีการศึกษา</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/admin/stat_workplace_type_menu">- ประเภทงานบัณฑิต ตามสาขาวิชาและปีการศึกษา</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/admin/stat_work_status">&nbsp;&nbsp;&nbsp;&nbsp;- ภาพรวมสถานะการทำงาน</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/admin/stat_work_direct_branch">&nbsp;&nbsp;&nbsp;&nbsp;- ภาพรวมทำงานตรงสายงาน</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
