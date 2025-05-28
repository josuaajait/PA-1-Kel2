@include('layout.header')
@include('layout.navbar')

<style>
    /* Efek scroll header */
    #header.scrolled {
        background-color: #fff !important;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container my-5 pt-5">
    <h1 class="mb-4 text-center fw-bold">Tentang Kami</h1>

    @if ($aboutUs)
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">Deskripsi</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 fs-5">{{ $aboutUs->deskripsi }}</p>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h2 class="h5 mb-0">Sejarah</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 fs-5">{{ $aboutUs->sejarah }}</p>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-warning text-dark">
                        <h2 class="h5 mb-0">Visi</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 fs-5">{{ $aboutUs->visi }}</p>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-danger text-white">
                        <h2 class="h5 mb-0">Misi</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 fs-5">{{ $aboutUs->misi }}</p>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="alert alert-info text-center fs-5" role="alert">
            Tidak ada informasi yang tersedia saat ini.
        </div>
    @endif
</div>

@include('layout.footer')
@include('layout.script')
