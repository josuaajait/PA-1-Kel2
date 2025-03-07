@include('layout.header')
@include('layout.navbar')
<br><br><br><br>

<!-- Produk Section -->
<body>
    <section class="container">
    <div class="card" style="max-width: 320px">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxzaG9lfGVufDB8MHx8fDE3MjEwNDEzNjd8MA&ixlib=rb-4.0.3&q=80&w=1080" class="card-img-top" alt="Product Image">
        <div class="card-body">
            <h5 class="card-title">Red Nike</h5>
            <p class="card-text">Short product description goes here.</p>
            <div class="d-flex justify-content-between align-items-center">
                <span class="h5 mb-0">$99.99</span>
                <div>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                    <small class="text-muted">(4.5)</small>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light">
            <button class="btn btn-primary btn-sm">Add to Cart</button>
            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-heart"></i></button>
        </div>
    </div>
    </section>
@include('layout.script')
</body>
@include('layout.footer')
</html>