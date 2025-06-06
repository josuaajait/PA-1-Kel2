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

  <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Admin Dashboard</title>

	<link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		
	@include('layout.adminsidebar')

		<div class="main">
			
			@include('layout.adminnavbar')

			<div class="container">
                <div class="row">
                    <div class="col-md-12"><br>
                        <h1>Dashboard</h1>
                        <p>Welcome to the admin dashboard!</p>
                    </div>
                </div>
            </div>
	
			@include('layout.adminfooter')

		</div>
	</div>

	@include('layout.adminscript')
</body>

</html>