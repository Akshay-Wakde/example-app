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
		<link rel="shortcut icon" href="assets/images/favicon.svg" />

		<!-- Title -->
		<title>Admin Templates - Dashboard Templates - Admin Dashboards</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css" />

		<!-- Main css -->
		<link rel="stylesheet" href="assets/css/main.min.css" />

		<!-- Login css -->
		<link rel="stylesheet" href="assets/css/login.css" />
	</head>

	<body class="login-container">
		<!-- Login box start -->
		<div class="container">
                @if(\Session::has('alert'))
                <div class="alert alert-success">
                <div>{{Session::get('alert')}}</div>
                </div>
                @endif
			<form action="{{$loginAction}}" method="POST">
                @csrf
				<div class="login-box rounded-2 p-5">
					<div class="login-form">
						<a href="index.html" class="login-logo mb-3">
							<img src="assets/images/logo.svg" alt="Crowdnub Admin" />
						</a>
						<h5 class="fw-light mb-5">Sign in to access dashboard.</h5>
						<div class="mb-3">
							<label class="form-label">Your Email</label>
                            <span class="text-danger" id="error_username">{{ $errors->first('email') }}</span>

							<input type="text" class="form-control" name="email" placeholder="Enter your email" />
						</div>
						<div class="mb-3">
							<label class="form-label">Your Password</label>
                            <span class="text-danger" id="error_password">{{ $errors->first('password') }}</span>
							<input type="password" class="form-control" name="password" placeholder="Enter password" />
						</div>
						<div class="d-flex align-items-center justify-content-between">
							<div class="form-check m-0">
								<input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
								<label class="form-check-label" for="rememberPassword">Remember</label>
							</div>
							<a href="forgot-password.html" class="text-blue text-decoration-underline">Lost password?</a>
						</div>
						<div class="d-grid py-3">
							<button type="submit" class="btn btn-lg btn-primary">
								Login
							</button>
						</div>
						<div class="text-center py-3">or login with</div>
						<div class="d-flex gap-2 justify-content-center">
							<button type="submit" class="btn btn-outline-light">
								<img src="assets/images/google.svg" class="login-icon" alt="Login with Google" />
							</button>
							<button type="submit" class="btn btn-outline-light">
								<img src="assets/images/facebook.svg" class="login-icon" alt="Login with Facebook" />
							</button>
						</div>
						<div class="text-center pt-3">
							<span>Not registered?</span>
							<a href="{{$signupBtn}}" class="text-blue text-decoration-underline ms-2">
								Create an account</a>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- Login box end -->
	</body>

</html>