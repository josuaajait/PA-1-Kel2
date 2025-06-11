@include('layout.header')
@include('layout.navbar')

<br><br><br><br>

<section class="testimonial-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-3">Testimoni Pelanggan Kami</h2>
                <p class="lead text-muted">Dengar pengalaman langsung dari pelanggan kami</p>
            </div>
        </div>
                        <!-- Sorting Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-sort me-1"></i> Urutkan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item {{ request('sort') === 'highest_rating' ? 'active' : '' }}" 
                              href="?sort=highest_rating">Rating Tertinggi</a></li>
                        <li><a class="dropdown-item {{ request('sort') === 'lowest_rating' ? 'active' : '' }}" 
                              href="?sort=lowest_rating">Rating Terendah</a></li>
                        <li><a class="dropdown-item {{ !request('sort') || request('sort') === 'newest' ? 'active' : '' }}" 
                              href="?sort=newest">Terbaru</a></li>
                        <li><a class="dropdown-item {{ request('sort') === 'oldest' ? 'active' : '' }}" 
                              href="?sort=oldest">Terlama</a></li>
                    </ul>
                </div>
            </div>
            
        @if($testimonis->count())
            <div class="row g-4">
                @foreach($testimonis as $testimoni)
                <div class="col-md-6 col-lg-4">
                    <div class="card testimonial-card h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar me-3">
                                    <div class="avatar-initials bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        {{ substr($testimoni->user->nama ?? 'U', 0, 1) }}
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $testimoni->user->nama ?? 'Anonymous' }}</h5>
                                    <small class="text-muted">{{ $testimoni->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                            
                            <div class="rating mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimoni->rate)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            
                            <p class="testimonial-text">"{{ $testimoni->deskripsi }}"</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end">
                            <a href="{{ route('user.testimoni.edit', $testimoni->testimoni_id) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-edit">Edit</i>
                            </a>
                            <form action="{{ route('user.testimoni.destroy', $testimoni->testimoni_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus testimoni ini?')">
                                    <i class="fas fa-trash">Hapus</i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $testimonis->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="far fa-comment-dots fa-4x text-muted mb-4"></i>
                        <h4 class="mb-3">Belum ada testimoni</h4>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .testimonial-section {
        background-color: #f8f9fa;
    }
    
    .testimonial-card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .testimonial-text {
        font-style: italic;
        color: #555;
    }
    
    .avatar-initials {
        font-weight: bold;
        font-size: 1.2rem;
    }
    
    .rating {
        font-size: 1.1rem;
    }
    
    .empty-state {
        max-width: 500px;
        margin: 0 auto;
    }
</style>

@include('layout.script')
@include('layout.footer')