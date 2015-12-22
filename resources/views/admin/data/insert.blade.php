@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Forms</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    1. ข้อมูลสมาชิก
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form">

                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label>คำนำหน้าชื่อ</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label>ชื่อ</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>นามสกุล</label>
                                        <input class="form-control">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>รหัสบัตรประชาชน</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>รหัสนิสิต</label>
                                        <input class="form-control">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>วัน/เดือน/ปี เกิด</label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>GPA</label>
                                        <input class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="col-lg-6" style="padding-left: 0px">
                                            <label>บ้านเลขที่</label>
                                            <input class="form-control">
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0px">
                                            <label>หมู่</label>
                                            <input class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <div class="col-lg-6" style="padding-left: 0px">
                                            <label>ซอย</label>
                                            <input class="form-control">
                                        </div>
                                        <div class="col-lg-6" style="padding-right: 0px">
                                            <label>ถนน</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label>ตำบล</label>
                                        <select class="form-control"></select>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label>อำเภอ</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>จังหวัด</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>รหัสไปรษณีย์</label>
                                        <input class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>โทรศัพท์</label>
                                        <input class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>E-Mail</label>
                                        <input class="form-control">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>GPA</label>
                                    <input class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>
                                <div class="form-group">
                                    <label>Static Control</label>

                                    <p class="form-control-static">email@example.com</p>
                                </div>
                                <div class="form-group">
                                    <label>File input</label>
                                    <input type="file">
                                </div>
                                <div class="form-group">
                                    <label>Text area</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Checkboxes</label>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 1
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 2
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 3
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Inline Checkboxes</label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">1
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">2
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">3
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Radio Buttons</label>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"
                                                   checked="">Radio 1
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2"
                                                   value="option2">Radio 2
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios3"
                                                   value="option3">Radio 3
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Inline Radio Buttons</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1"
                                               value="option1" checked="">1
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2"
                                               value="option2">2
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3"
                                               value="option3">3
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Selects</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Multiple Selects</label>
                                    <select multiple="" class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form">
                                <div class="form-group">
                                    <label>Text Input</label>
                                    <input class="form-control">

                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>
                                <div class="form-group">
                                    <label>Static Control</label>

                                    <p class="form-control-static">email@example.com</p>
                                </div>
                                <div class="form-group">
                                    <label>File input</label>
                                    <input type="file">
                                </div>
                                <div class="form-group">
                                    <label>Text area</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Checkboxes</label>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 1
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 2
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 3
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Inline Checkboxes</label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">1
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">2
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox">3
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Radio Buttons</label>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"
                                                   checked="">Radio 1
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2"
                                                   value="option2">Radio 2
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios3"
                                                   value="option3">Radio 3
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Inline Radio Buttons</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1"
                                               value="option1" checked="">1
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2"
                                               value="option2">2
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3"
                                               value="option3">3
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Selects</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Multiple Selects</label>
                                    <select multiple="" class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>



@endsection
