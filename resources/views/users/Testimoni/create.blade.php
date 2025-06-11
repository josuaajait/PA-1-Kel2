@include('layout.header')
@include('layout.navbar')

<style>
    .star-rating {
        display: inline-flex;
        font-size: 3rem;
        justify-content: flex-start;
        gap: 5px;
        flex-direction: row-reverse;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>

<br><br><br><br>

<section class="section light-background">
    <div class="container" data-aos="fade-up">
        <h2 class="mb-4">Beri Testimoni</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.testimoni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3" style="text-align: left;">
                <label class="form-label">Rating</label>
                <br>
                <div class="star-rating">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rate" value="{{ $i }}"
                            {{ old('rate') == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}" title="{{ $i }} bintang">&#9733;</label>
                    @endfor
                </div>
                @error('rate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar_testimoni" class="form-label">Foto (opsional)</label>
                <input type="file" name="gambar_testimoni" class="form-control" accept="image/*">
                @error('gambar_testimoni')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
        </form>
    </div>
</section>

@include('layout.script')
@include('layout.footer')
