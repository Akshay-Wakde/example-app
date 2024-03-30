@include('common.header')
           
            @include('common.sidebar')
				</nav>
				<!-- Sidebar wrapper end -->

				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">

					<!-- Main header starts -->
					<div class="main-header d-flex align-items-center justify-content-between position-relative">
						<div class="d-flex align-items-center justify-content-center">
							<div class="page-icon">
								<i class="bi bi-window-split"></i>
							</div>
							<div class="page-title d-none d-md-block">
								<h5>Banners</h5>
                               
							</div>
						</div>
                        <a href="{{ route('banner.list')}}"><button title="back" class="btn btn-sm btn-primary">Back</button></a>
					</div>
					<!-- Main header ends -->

					<!-- Content wrapper start -->
					<div class="content-wrapper">

						<!-- Row start -->
						<div class="row gx-3">
							<div class="col-sm-12 col-12">
								<!-- Card start -->
								<div class="card">
                                        <div class="card-header">
                                            <div class="card-title">{{$heading}}</div>
                                        </div>
                                        @if(session()->has('message'))
                                        <div class="alert notification alert-{{ session('message') }}"> 
                                        {!! session('content') !!}
                                        </div>
                                        @endif
                                        <div class="card-body">
                                            <form action="{{$action}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="banner_id" value="{{$banner_id}}">
                                                <!-- Row start -->
                                                <div class="row gx-3">
                                                    <div class="col-lg-6 col-sm-4 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Banner Name</label>
                                                            <span class="notification error_validation text-danger" id="error_date">{{ $errors->first('banner_name') }}</span>

                                                            <input type="text" name="banner_name" autocomplete="off" value="{{ old('banner_name',$banner_name)}}" class="form-control" placeholder="Enter Banner Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-4 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Image</label><span class="text-primary"> (Default Size 1920x1280)</span>
                                                            @if($button=="Save")
                                                            <span class="notification error_validation text-danger" id="error_date">{{ $errors->first('image_name') }}</span>

                                                            <input type="file" name="image_name" class="form-control" placeholder="select file" />
                                                            @else
                                                            <span class="notification error_validation text-danger" id="error_date">{{ $errors->first('image_name') }}</span>
                                                            <input type="file" name="image_name" class="form-control" placeholder="select file" />
                                                            <input type="hidden" name="old_image_name" value="{{$image_name}}">
                                                            <input type="hidden" name="old_image_url" value="{{$image_url}}">
                                                            <a href="{{asset($image_url)}}" target="_blank"><img src="{{asset($image_url)}}" height="30%" width="30%"></a>
                                                        
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <!-- Row end -->
                                                <hr />
                                                <!-- Row start -->
                                                <div class="row gx-3">
                                                    <div class="col-xxl-12">
                                                        <div class="d-flex gap-2 justify-content-end">
                                                            <a href="{{route('banner.list')}}"><button type="button" class="btn btn-outline-secondary">
                                                                Cancel
                                                            </button></a>
                                                            <button type="submit" class="btn btn-success">
                                                                {{$button}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Row end -->
                                            </form>
									    </div>
							    </div>
								<!-- Card end -->

							</div>
						</div>
						<!-- Row end -->

					</div>
					<!-- Content wrapper end -->

				</div>
				<!-- Content wrapper scroll end -->
        @include('common.footer')
		
     