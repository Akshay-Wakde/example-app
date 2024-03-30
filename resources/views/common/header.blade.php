<!DOCTYPE html>
<html lang="en">

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Meta -->
		<meta name="description" content="Best Bootstrap Admin Dashboards" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" />

		<!-- Title -->
		<title>Admin Templates - Dashboard Templates - Admin Dashboards</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="{{asset('assets/fonts/bootstrap/bootstrap-icons.css')}}" />

		<!-- Main css -->
		<link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}" />

		<!-- *************
			************ Vendor Css Files *************
		************ -->

		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="{{asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />
	</head>

	<body>

<!-- Page wrapper start -->
<div class="page-wrapper">

	<!-- Page header starts -->
	<div class="page-header">

		<div class="toggle-sidebar" id="toggle-sidebar">
			<i class="bi bi-list"></i>
		</div>

		<!-- Header actions ccontainer start -->
		<div class="header-actions-container">

			<!-- Search container start -->
			<div class="search-container me-4 d-xl-block d-lg-none">

				<!-- Search input group start -->
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" />
					<button class="btn btn-outline-secondary" type="button">
						<i class="bi bi-search"></i>
					</button>
				</div>
				<!-- Search input group end -->

			</div>
			<!-- Search container end -->

			<!-- Header actions start -->
			<div class="header-actions d-xl-flex d-lg-none gap-4">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-envelope-open fs-5 lh-1"></i>
						<span class="count-label"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-end shadow-lg">
						<div class="dropdown-item">
							<div class="d-flex py-2 border-bottom">
								<img src="{{asset('assets/images/user.png')}}" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
								<div class="m-0">
									<h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
									<p class="mb-1">Membership has been ended.</p>
									<p class="small m-0 text-secondary">Today, 07:30pm</p>
								</div>
							</div>
						</div>
						<div class="dropdown-item">
							<div class="d-flex py-2 border-bottom">
								<img src="{{asset('assets/images/user2.png')}}" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
								<div class="m-0">
									<h6 class="mb-1 fw-semibold">Benjamin Michiels</h6>
									<p class="mb-1">Congratulate, James for new job.</p>
									<p class="small m-0 text-secondary">Today, 08:00pm</p>
								</div>
							</div>
						</div>
						<div class="dropdown-item">
							<div class="d-flex py-2">
								<img src="{{asset('assets/images/user1.png')}}" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
								<div class="m-0">
									<h6 class="mb-1 fw-semibold">Jehovah Roy</h6>
									<p class="mb-1">Lewis added new schedule release.</p>
									<p class="small m-0 text-secondary">Today, 09:30pm</p>
								</div>
							</div>
						</div>
						<div class="d-grid mx-3 my-1">
							<a href="javascript:void(0)" class="btn btn-primary">View all</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Header actions start -->

			<!-- Header profile start -->
			<div class="header-profile d-flex align-items-center">
				<div class="dropdown">
					<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
						<span class="user-name d-none d-md-block">Michelle White</span>
						<span class="avatar">
							<img src="{{asset('assets/images/user7.png')}}" alt="Admin Templates" />
							<span class="status online"></span>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
						<div class="header-profile-actions">
							<a href="profile.html">Profile</a>
							<a href="account-settings.html">Settings</a>
							<a href="{{route('logout')}}">Logout</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Header profile end -->

		</div>
		<!-- Header actions ccontainer end -->

	</div>
	<!-- Page header ends -->
