@if(Auth::user()->role === 'admin')
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

    <title>Admin Produk</title>

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
                        <h1>Produk</h1>
                        <a href="{{ route('admins.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Actions</th> <!-- Add this column -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks as $produk)
                                    <tr>
                                        <td>{{ $produk->id }}</td>
                                        <td>{{ $produk->name }}</td>
                                        <td>{{ $produk->description }}</td>
                                        <td>{{ $produk->price }}</td>
                                        <td>
                                            <img src="{{ asset('storage/produk_images/' . $produk->image) }}" class="img-fluid" style="max-width: 150px;" alt="{{ $produk->name }}">
                                        </td>
                                        <td>
                                            <!-- View (Read) Button -->
                                            <a href="{{ route('admins.produk.show', $produk->id) }}" class="btn btn-info btn-sm">View Details</a>

                                            <!-- Edit Button -->
                                            <a href="{{ route('admins.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                                            <!-- Delete Button (Form for security) -->
                                            <form action="{{ route('admins.produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layout.adminscript')
</body>

@include('layout.adminfooter')
</html>
@endif