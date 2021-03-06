@include('Admin.header')
        <!-- Main Header -->
 @include('Admin.adminNav')      

<div style="min-height: 700px;" class="content-wrapper">
  <section class="content-header">
    <h1>Admin Panel</h1>
  </section>
  <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
<section class="content">
  <div class="alert-field" id="alert-field"></div>   
    <div class="row">
      <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number">
                            @if(!empty($users))
                              {{$users}}
                            @else
                            <span>No users</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-user-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Sign-ups</span>
                        <span class="info-box-number">
                            0
                        </span>
                    </div>
                </div>
            </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-comment"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Ban</span>
                        <span class="info-box-number">
                            @if(!empty($ban))
                              {{$ban}}
                            @else
                            <span>No ban</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-comments"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Posts</span>
                        <span class="info-box-number">
                             @if(!empty($posts))
                              {{$posts}}
                            @else
                            <span>No posts</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            </div>

    <div class="row">
     </div>
        <div class="col-md-8">
            <div class="row">
 <div class="col-md-8">
     <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Recent Updates</h3>
    </div>
    <div class="box-body">
        <p>
           Recent forum stats includes the latest post and thread.
        </p>
    </div>
</div>
</div>
 </div>
</div>
</div>
</section>
</div>
        
@include('Admin.footer')