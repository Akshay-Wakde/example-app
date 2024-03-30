@include('common.header')
            <!-- Data Tables -->
            <link rel="stylesheet" href="{{asset('assets/vendor/datatables/dataTables.bs5.css')}}" />
            <link rel="stylesheet" href="{{asset('assets/vendor/datatables/dataTables.bs5-custom.css')}}" />
                
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
								<h5>{{$title}}</h5>
							</div>
						</div>
                        

                        <a href="{{ $add_route}}"><button title="Add Banner" class="btn btn-sm btn-primary">Add URL</button></a>
						<!-- Live updates start -->
						<!-- <ul class="updates d-flex align-items-end flex-column overflow-hidden" id="updates">
							<li>
								<a href="javascript:void(0)">
									<i class="bi bi-envelope-paper text-red font-1x me-2"></i>
									<span>12 emails from David Michaiah.</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0)">
									<i class="bi bi-bar-chart text-blue font-1x me-2"></i>
									<span>15 new features updated successfully.</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0)">
									<i class="bi bi-folder-check text-yellow font-1x me-2"></i>
									<span>The media folder is created successfully.</span>
								</a>
							</li>
						</ul> -->
						<!-- Live updates end -->
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
                                        
										<div class="card-title">{{$title}}</div>

									</div>
                                        @if(session()->has('message'))
                                        <div class="alert notification alert-{{ session('message') }}"> 
                                        {!! session('content') !!}
                                        </div>
                                        @endif
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="basicExample" class="table custom-table allDatatable banner_datatable">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th>Sr.</th>
                                                            <th>URL</th>
                                                            <th>Online</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
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

				<!-- Is Online Modal Row start -->
				<div class="modal fade" id="isOnlineModal" data-bs-backdrop="static" data-bs-keyboard="false"
					tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" >
								@csrf
								<div class="modal-body">Do you want show URL on website ?</div>
								<div class="modal-footer">
									<input type="hidden" name="change_url_id" id="change_url_id">
									<input type="hidden" name="change_status" id="change_status">
									<button type="button" onclick = "tableDraw()" class="btn btn-secondary" data-bs-dismiss="modal">
										No
									</button>
									<button type="button" onclick = "ChangeOnlineStatus()" class="btn btn-primary">
										Yes , Please.
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Is Online Modal Row end -->
				<!-- Is Delete Modal Row start -->
				<div class="modal fade" id="isDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
					tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" >
								@csrf
								<div class="modal-body">Do you want to delete URL?</div>
								<div class="modal-footer">
									<input type="hidden" name="change_delete_id" id="change_delete_id">
									<button type="button" onclick = "tableDraw()" class="btn btn-secondary" data-bs-dismiss="modal">
										No
									</button>
									<button type="button" onclick = "deleteUrlConfirm()" class="btn btn-primary">
										Yes , Please.
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Is Delete Modal Row end -->
        @include('common.footer')
        <!-- Data Tables -->
		<script src="{{asset('assets/vendor/datatables/dataTables.min.js')}}"></script>
		<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/vendor/datatables/custom/custom-datatables.js')}}"></script>
        <script type="text/javascript">

            setTimeout(function(){$(".notification").fadeOut();},3000);
            
            $(function () {

                var table = $('.banner_datatable').DataTable({
                    processing: true,
                    "language": {
                        processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> '},
                    serverSide: true,
                    ajax:{
                                "url": "{{ route('url.ajax') }}",
                                "data":{ _token: "{{csrf_token()}}"}
                            },

                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'url', name: 'url'},
                        {data: 'is_online', name: 'is_online'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]

                });

                

            });

        </script>
		<script>
	//Is Online URL Start
		function isOnlineChange(url_id,is_online){
			$('#change_url_id').val(url_id);
			$('#change_status').val(is_online);
		}
		function tableDraw(){
			var basicExample = $("#basicExample").DataTable();
				basicExample.row(0).invalidate().draw();
		}

		function ChangeOnlineStatus(){

			var url_id = $('#change_url_id').val();
			var is_online = $('#change_status').val();
			$.ajax({
               type:'POST',
               url:'{{route("url.ChangeIsOnline")}}',
               data:{
				"_token": "{{ csrf_token() }}",
				url_id:url_id,
				is_online:is_online
			   },
               success:function(result) {
				$('#isOnlineModal').modal('toggle');
				// $("#basicExample").DataTable().ajax.reload();
				tableDraw();
               }
            });
		}
	//Is Online URL Start

		function deleteUrl(url_id){
			$('#change_delete_id').val(url_id);
		}

		function deleteUrlConfirm(){
			var url_id = $('#change_delete_id').val();
			
			$.ajax({
               type:'POST',
               url:'{{route("url.DeleteUrl")}}',
               data:{
				"_token": "{{ csrf_token() }}",
				url_id:url_id
			   },
               success:function(result) {
				$('#isDeleteModal').modal('toggle');
				tableDraw();
               }
            });
		}
		</script>
     