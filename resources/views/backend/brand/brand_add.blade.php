@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Brand Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							
                          
							<div class="col-lg-10">
                            <form method="post" action="{{route('store.brand')}}" enctype="multipart/form-data">
                            @csrf
								<div class="card">
									<div class="card-body">
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">User Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="brand_name"  />
											</div>
										</div>
										
                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Brand Iamge</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="file" name="brand_image" class="form-control" id="image"/>
											</div>
										</div>
                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0"></h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{!empty($adminData->photo) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg')  }}" alt="Admin" style="width:100px; height:100px;">
											
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
											</div>
										</div>
									</div>
								</div>
                                </form>
							    </div>
                          
						</div>
					</div>
				</div>
			</div>

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#image').change(function(e){
                        var reader =new FileReader();
                        reader.onload = function(e){
                            $('#showImage').attr('src', e.target.result);

                        }
                        reader.readAsDataURL(e.target.files['0']);
                    });
                });

            </script>
         

@endsection