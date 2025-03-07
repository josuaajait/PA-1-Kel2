<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{URL::asset('adminimg/icons/icon-48x48.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

	<title>Admin Profile</title>

	<link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">




		@include('layout.adminsidebar')

		<div class="main">
			
		@include('layout.adminnavbar')

			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i></a>
					<main>
						<section class="card p-4 shadow">
							<h2 class="mb-3">Profile</h2>
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="name" value="John Doe">
									</div>
									<div class="mb-3">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" value="johndoe@example.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" value="Administrator" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter new password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </section>

				
			</main>
		</div>
		
		
	</div>

	<script src="{{URL::asset('adminjs/app.js')}}"></script>

</body>

			@include('layout.adminfooter')

</html>