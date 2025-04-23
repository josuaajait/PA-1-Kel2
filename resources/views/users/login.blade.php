@include('layout.header')
<body>
    <section id="login" class="login section bg-light py-5">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2 class="text-center mb-4">Login</h2>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="text-center mt-3">
                            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('layout.script')
</body>
</html>

