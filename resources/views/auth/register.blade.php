@include('layout.header')

<style>
    .register h2 {
  font-family: 'Oswald', sans-serif; /* Replace 'Oswald' with your chosen font name */
}
</style>
<body>
    <section id="register" class="register section bg-light py-5">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <!-- Logo -->
                    <div class="text-center mb-3">
                        <img src="{{ URL::asset('img/firman-taylor-logo.jpg') }}" alt="Firman Taylor Logo" style="max-width: 150px; border-radius: 50%;">
                    </div>
                    
                    <h2 class="text-center mb-4" style="font-family: 'Roboto', sans-serif;">Register</h2>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li> {{-- Tampilkan semua pesan error --}}
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <!-- Jika guest sudah mendaftar, kita minta data customer lainnya -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp">Nomor Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('layout.script')
</body>
</html>