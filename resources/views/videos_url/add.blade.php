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
								<h5>{{$heading}}</h5>
                               
							</div>
						</div>
                        <a href="{{ route('url.list')}}"><button title="back" class="btn btn-sm btn-primary">Back</button></a>
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
                                                <input type="hidden" name="url_id" value="{{$url_id}}">
                                                <!-- Row start -->
                                                <div class="row gx-3">
                                                    <div class="col-lg-12 col-sm-4 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">URL</label>
                                                            <span class="notification error_validation text-danger" id="error_date">{{ $errors->first('url') }}</span>

                                                            <input type="text" name="url" autocomplete="off" value="{{ old('url',$url)}}" class="form-control" placeholder="Enter URL" />
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <!-- Row end -->
                                                <hr />
                                                <!-- Row start -->
                                                <div class="row gx-3">
                                                    <div class="col-xxl-12">
                                                        <div class="d-flex gap-2 justify-content-end">
                                                            <a href="{{route('url.list')}}"><button type="button" class="btn btn-outline-secondary">
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
        