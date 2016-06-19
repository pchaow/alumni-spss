@extends('admin.layout')

@section('css')
<link href="/assets/css/search_custom.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="/admin">หน้าหลัก</a></li>
        <li class="active">ช่วยเหลือ</li>
    </ol>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <i class="fa fa-info fa-fw"></i> ช่วยเหลือ
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <h3>ระบบมีปัญหาติดต่อได้ที่ ... </h3>
            </div>
        </div>
@endsection