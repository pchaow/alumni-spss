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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    $fb = app(SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
                    $login_url = $fb->getLoginUrl(['email', 'user_managed_groups']);
                    ?>
                    <h3 class="panel-header">ข่าวประกาศจากเฟสบุค
                        @if(Auth::user()->facebook_token)
                            <small><a href="/facebook/logout">Logout from Facebook</a></small>
                        @else

                        @endif
                    </h3>
                </div>
                <div class="panel-body">
                    @if(Auth::user()->facebook_token)
                        <?php
                        $fb = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
                        $response = $fb->get('/563173463853702/feed?limit=5&fields=id,from{picture,name},message,created_time', Auth::user()->facebook_token);
                        $groupData = $response->getGraphEdge();
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach($groupData as $post)
                                    <?php
                                    /* @var \Facebook\GraphNodes\GraphNode $post */
                                    //                    dd($post);
                                    ?>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object"
                                                     src="{{$post->getField('from')->getField('picture')->getField('url')}}"
                                                     data-holder-rendered="true"
                                                     style="width: 64px; height: 64px;">
                                            </a>
                                        </div>
                                        <div class="media-body">

                                            <h4 class="media-heading">
                                                {{$post->getField('from')->getField('name')}}
                                            </h4>
                                            <span>{{$post->getField('created_time')->setTimeZone( new DateTimeZone('Asia/Bangkok'))->format("c")}}</span><br/>
                                            {{$post->getField('message')}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        คลิกลิงค์ <a href="{{$login_url}}">Login with Facebook</a> เพื่อเชื่อมต่อบัญชีกับเฟสบุค
                        <small></small>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection


@section('javascript')


@endsection
