<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Testimonial Management">
    <meta name="author" content="Your Company">
    <meta name="keywords" content="admin, dashboard, testimonial">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 

    <title>Admin Testimoni</title>

    <link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .testimonial-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.1);
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .rating-stars {
            color: #FFD700;
            font-size: 1.2rem;
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .status-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .sort-dropdown {
            min-width: 150px;
        }
        
        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1>Testimoni Pelanggan</h1>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle sort-dropdown" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-sort me-2"></i>Urutkan Berdasarkan
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'highest_rating']) }}">Rating Tertinggi</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'lowest_rating']) }}">Rating Terendah</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Terbaru</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Terlama</a></li>
                                </ul>
                            </div>
                        </div>

                        @if($testimonis->count())
                        <div class="row">
                            @foreach($testimonis as $testimoni)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card testimonial-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="user-avatar me-3">
                                                {{ substr($testimoni->user->nama ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $testimoni->user->nama ?? 'Pelanggan' }}</h5>
                                                <small class="text-muted">{{ $testimoni->created_at->format('d M Y H:i') }}</small>
                                            </div>
                                        </div>
                                        
                                        <div class="rating-stars mb-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimoni->rate)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2">{{ $testimoni->rate }}/5</span>
                                        </div>
                                        
                                        <p class="mb-3">{{ $testimoni->deskripsi }}</p>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="status-badge bg-{{ $testimoni->status === 'approved' ? 'success' : 'warning' }}">
                                                {{ $testimoni->status === 'approved' ? 'Disetujui' : 'Menunggu' }}
                                            </span>
                                            
                                            <div class="action-buttons">
                                                <form action="{{ route('admin.testimoni.destroy', $testimoni->testimoni_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus testimoni ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $testimonis->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="far fa-comment-dots"></i>
                            <h4 class="mt-3">Belum Ada Testimoni</h4>
                            <p class="text-muted">Tidak ada testimoni yang ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.adminscript')
    
    <script>
        // Highlight current sorting option
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const sortParam = urlParams.get('sort');
            
            if (sortParam) {
                const dropdownItems = document.querySelectorAll('.dropdown-item');
                dropdownItems.forEach(item => {
                    if (item.getAttribute('href').includes(sortParam)) {
                        item.classList.add('active');
                    }
                });
            }
        });
    </script>
</body>

@include('layout.adminfooter')
</html>