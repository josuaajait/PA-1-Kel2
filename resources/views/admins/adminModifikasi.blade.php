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

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Admin Modifikasi</title>

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
                        <h1>Modifikasi</h1>
                        <form action="#" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="request">Custom Request</label>
                                <textarea name="request" class="form-control"></textarea>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="container">
                <div class="col-md-12">
                    <h1>Data</h1>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Pemesanan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Custom Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>KD001</td>
                                <td>2025-02-24</td>
                                <td>John Doe</td>
                                <td>08123456789</td>
                                <td>Request 1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layout.adminfooter')
</body>

</html>