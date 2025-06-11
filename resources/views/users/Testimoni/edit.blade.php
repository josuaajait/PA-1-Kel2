{{-- resources/views/users/testimoni/edit.blade.php --}}
@include('layout.header')
@include('layout.navbar')

<br><br><br><br>

<section class="section light-background">
    <div class="container" data-aos="fade-up">
        <h2 class="mb-4">Edit Testimoni Anda</h2>

        <form action="{{ route('user.testimoni.update', $testimoni->testimoni_id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Rating --}}
            <div class="mb-3">
                <label for="rate" class="form-label">Rating (1 - 5)</label>
                <div id="star-rating" style="font-size: 30px; text-align: left;">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star"
                            data-value="{{ $i }}"
                            style="cursor: pointer; color: {{ $testimoni->rate >= $i ? '#ffc107' : '#ccc' }}">★</span>
                    @endfor
                    <input type="hidden" name="rate" id="rate-input" value="{{ old('rate', $testimoni->rate) }}">
                </div>
                @error('rate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $testimoni->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Testimoni</label>
                <input type="text" class="form-control" value="{{ $testimoni->created_at->format('d M Y') }}" disabled>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('user.testimoni.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</section>

{{-- Script interaktif untuk bintang --}}
<script>
    const stars = document.querySelectorAll('.star');
    const rateInput = document.getElementById('rate-input');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            rateInput.value = rating;

            stars.forEach(s => {
                if (s.getAttribute('data-value') <= rating) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#ccc';
                }
            });
        });
    });
</script>

@include('layout.script')
@include('layout.footer')
