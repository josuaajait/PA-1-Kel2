@include('layout.header')
<body class="index-page">

  @include('layout.navbar')
  <main class="main">

  
  @yield('content')

  </main>


  @include('layout.script')
</body>
@include('layout.footer')
</html>
