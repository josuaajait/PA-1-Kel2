@include('layout.header')
@include('layout.navbar')

<br><br><br><br>

<section class="testimonial-section py-5">
    <div class="container">
        <!-- Header Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-3">Testimoni Pelanggan Kami</h2>
                <p class="lead text-muted">Dengar pengalaman langsung dari pelanggan kami</p>
        
            </div>
        </div>

        <!-- Sorting and Filter Controls -->
        <div class="row mb-4">
            <div class="col-md-6">
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

        <!-- Testimonial Cards -->
        @if($testimonis->count())
            <div class="row g-4">
                @foreach($testimonis as $testimoni)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card testimonial-card h-100 shadow-sm">
                        @if($testimoni->gambar_testimoni)
                        <div class="testimonial-img-container">
                            <img src="{{ asset('storage/' . $testimoni->gambar_testimoni) }}" class="card-img-top" alt="Gambar Testimoni">
                        </div>
                        @endif
                        
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar me-3">
                                    <div class="avatar-initials bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                        {{ substr($testimoni->user->nama ?? 'U', 0, 1) }}
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $testimoni->user->nama ?? 'Anonymous' }}</h5>
                                    <small class="text-muted">{{ $testimoni->created_at->translatedFormat('d F Y') }}</small>
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
                                <span class="ms-2">{{ number_format($testimoni->rate, 1) }}/5</span>
                            </div>
                            
                            <p class="testimonial-text">"{{ $testimoni->deskripsi }}"</p>
                            
                            @if($testimoni->produk)
                            <div class="product-info mt-3 pt-3 border-top">
                                <small class="text-muted">Produk:</small>
                                <p class="mb-0 fw-semibold">{{ $testimoni->produk->nama_produk ?? '' }}</p>
                            </div>
                            @endif
                        </div>
                        
                        @auth
                        @if(auth()->id() === $testimoni->user_id)
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('user.testimoni.edit', $testimoni->testimoni_id) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('user.testimoni.destroy', $testimoni->testimoni_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus testimoni ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $testimonis->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="row">
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <div class="empty-state-icon">
                            <i class="far fa-comment-dots fa-4x text-muted mb-4"></i>
                        </div>
                        <h4 class="mb-3">Belum ada testimoni</h4>
                        <p class="text-muted mb-4">Jadilah yang pertama memberikan testimoni tentang produk kami</p>
                        @auth
                        <a href="{{ route('user.testimoni.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tulis Testimoni
                        </a>
                        @else
                        <p>Silakan <a href="{{ route('login') }}">login</a> untuk memberikan testimoni</p>
                        @endauth
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .testimonial-section {
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
    }
    
    .testimonial-card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        overflow: hidden;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .testimonial-img-container {
        height: 200px;
        overflow: hidden;
    }
    
    .testimonial-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .testimonial-card:hover .testimonial-img-container img {
        transform: scale(1.05);
    }
    
    .testimonial-text {
        font-style: italic;
        color: #555;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .avatar-initials {
        font-weight: bold;
        font-size: 1.2rem;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .rating {
        font-size: 1.1rem;
    }
    
    .empty-state {
        max-width: 600px;
        margin: 0 auto;
        padding: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .empty-state-icon {
        color: #6c757d;
        opacity: 0.6;
    }
    
    @media (max-width: 768px) {
        .testimonial-section {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .testimonial-img-container {
            height: 150px;
        }
    }
</style>

<script>
    // Simple search functionality
    document.getElementById('searchTestimonials').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.testimonial-card');
        
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            if(text.includes(searchTerm)) {
                card.parentElement.style.display = 'block';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
</script>

@include('layout.script')
@include('layout.footer')