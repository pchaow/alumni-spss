@extends('admin.layout')

@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/admin">หน้าหลัก</a></li>
            <li class="active">นำเข้าข้อมูลบัณฑิต</li>
        </ol>
        <div class="col-lg-12">
            <h1 class="page-header">นำเข้าข้อมูลบัณฑิต</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-lg-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form role="form" action="<?php echo url('admin/import_excel')?>" method="POST"
                  enctype="multipart/form-data" runat="server">
                {{csrf_field()  }}
                <div class="panel panel-danger">


                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> นำเข้าข้อมูลบัณฑิตจากไฟล์ excel
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <label>เลือกไฟล์ Excel</label>
                                <input type="file" id="file_excel" name="file_excel" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </form>


    </div> </div>
    <!-- /.row -->

@endsection


@section('javascript')

    <script src="/bower/startbootstrap-sb-admin-2/dist/js/morris-data.js"></script>

@endsection