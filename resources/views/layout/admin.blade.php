<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ URL::asset('admincss/app.css') }}">
</head>
<body>

    @include('layout.adminnavbar')

    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            <div class="container">
                @yield('content') {{-- Content will be injected here --}}
            </div>
        </div>
    </div>

    @include('layout.adminfooter')
</body>
</html>
