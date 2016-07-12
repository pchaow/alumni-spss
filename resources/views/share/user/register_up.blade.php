@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Register from University of Phayao Login</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('share.error')
        </div>
    </div>
    <div class="row" id="user-profile-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User's profile
                </div>
                <div class="panel-body">

                    <form method="post" action="/login/up/callback?register=register">
                        {{csrf_field()}}
                        <input type="hidden" name="upregister[upprofile_id]" value="{{$upregister->id}}">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input value="{{$upregister->firstname}}" type="text" name="upregister[firstname]"
                                   class="form-control" placeholder="Firstname" required>
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input value="{{$upregister->lastname}}" type="text" name="upregister[lastname]"
                                   class="form-control"
                                   placeholder="Lastname" required>
                        </div>

                        <div class="form-group">
                            <label>E-Mail</label>
                            <input value="" type="email" name="upregister[email]"
                                   class="form-control"
                                   placeholder="E-Mail" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="upregister[password]" class="form-control"
                                   placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <label>Verify Password</label>
                            <input type="password" name="upregister[vpassword]" class="form-control"
                                   placeholder="Verify Password" required>
                        </div>


                        <button type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default" href="/admin">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection