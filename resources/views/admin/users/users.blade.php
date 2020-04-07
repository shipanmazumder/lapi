@extends('layout.default')
@section('title_area')
    All Users
@endsection
@section('main_section')

    <div class="content">
        <div class="container">
            <!-- Start Widget -->
                @isset($edit)
                    <div class="row">
                        {!! Form::open(['url' => 'admin/user-edit/'.$single->id]) !!}
                        @method("PUT")
                            <div class="col-sm-12">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                              User Information modify
                                            </a>
                                        </h3>
                                    </div>
                                        <div class="panel-body">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name">Name</label><small class="req">*</small><br/>
                                                    <input type="text" value="{{$single->name}}" name="name" required placeholder="Name" class="form-control">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label><small class="req">*</small><br/>
                                                    <input type="email" value="{{$single->email}}" name="email" required placeholder="Email" class="form-control">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="role_id">Role</label><small class="req">*</small><br/>
                                                    <select name="role_id" id="role_id" required class="form-control selectpicker">
                                                        <option value="">--Select--</option>
                                                        @isset($roles)
                                                            @foreach($roles as $value)
                                                                <option {{ $value->id==$single->role_id?"selected":"" }} value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('role_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password"  placeholder="Password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group pull-left m-t-22">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Update" name="submit" />
                                                </div>
                                            </div>
                                        </div> <!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col -->
                        {!! Form::close() !!}
                    </div>
                @endisset
                <div class="row">
                    <div class="col-md-12">
                          <div class="panel panel-border panel-info">
                               <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Users List
                                        </a>
                                    </h3>
                                </div>
                              <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 m-b-10 pull-left">
                                            <div class="">
                                                <div class="col-md-12 m-b-10 pull-right">
                                                    <div class="form-group">
                                                    <label for="filter_by">Filter By</label>
                                                        <select id="filter_by"  name="filter_by"  class="form-control selectpicker" >
                                                            <option value="">All</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Ban</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 m-b-10 pull-right  m-t-22">
                                            <div class="">
                                                <div class="col-md-12 m-b-10 pull-right">
                                                    <div class="input-group">
                                                        <input type="text" name="search_key" placeholder="Search Email" id="search_key" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-info" id="add_button" type="button">
                                                                <i class="md md-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <div class="row">
                                        <div class="col-md-12">
                                            <div  style="overflow: hidden">
                                                <div class="table-responsive">
                                                    <div id="user_loading">
                                                        <div class="cv-spinner">
                                                            <span class="spinner"></span>
                                                        </div>
                                                    </div>
                                                    <table id="users" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
        </div> <!-- container -->
    </div>
    <script !src="">
        $(document).ready(function () {
            $("#search_key").on("change",function () {
			    get_view(false);
                return false;
            });
            $("#filter_by").on("change",function () {
                get_view(false);
                return false;
            });
            $("#users").on("click",'.pagination li a',function () {
                var page_url=$(this).attr("href");
                if(page_url=="javascript:void(0)")
                {
                    return false;
                }
                get_view(page_url);
                return false;
            });
            get_view(false);
         function get_view(page_url)
        {
			var filter_by=$("#filter_by").val();
        	var search_key=$("#search_key").val();
        	var base_url="{{url('admin/user-view')}}";
        	if(page_url)
			{
				base_url=page_url;
			}
            $.ajax({
                url:base_url,
                type:"get",
                dataType:"json",
				data:{
                	"search_key":search_key,
					"filter_by":filter_by
				},
                beforeSend: function(){
                		$("#user_loading").fadeIn(300);　
                },
                success:function(data){
                   $("#users tbody").html(data.html);
                	$("#user_loading").fadeOut(300);　
                },
                error:function (e) {
                	$("#user_loading").fadeOut(300);
				}
            });
        }
        });
    </script>
@endsection
