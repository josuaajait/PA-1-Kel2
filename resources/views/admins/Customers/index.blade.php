<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Customer</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 
</head>
<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Data Customer</h1>
                    <a href="{{ route('register') }}" class="btn btn-primary mb-3">Tambah Data Customer</a>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $customer->nama }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->no_hp }}</td>
                                            <td>
                                                <a href="{{ route('admins.customers.edit', $customer) }}" class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $customers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('layout.adminfooter')
        </div>
    </div>

    @include('layout.adminscript')
</body>
</html>
