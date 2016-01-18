@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">นำเข้า</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="<?php echo url('admin/import_excel')?>" method="POST"
                  enctype="multipart/form-data" runat="server">
                <div class="panel panel-default">


                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> นำเข้าข้อมูลจากแบบสอบถาม
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <label>เลือกไฟล์</label>
                                <input type="file" id="file_excel" name="file_excel" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </form>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> นำเข้าข้อมูลจากสำนักทะเบียน
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>เลือกไฟล์</label>
                            <input type="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

@endsection


@section('javascript')

    <script src="/bower/startbootstrap-sb-admin-2/dist/js/morris-data.js"></script>

@endsection