  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::asset('vendor/php-email-form/validate.js')}}"></script>
  <script src="{{URL::asset('vendor/aos/aos.js')}}"></script>
  <script src="{{URL::asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{URL::asset('vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{URL::asset('vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{URL::asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{URL::asset('vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{URL::asset('js/main.js')}}"></script>
  
  
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.0.1/dist/purecounter.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      AOS.init();  
      new PureCounter();
  });
</script>

<script>
  function showSizeModal() {
      var myModal = new bootstrap.Modal(document.getElementById('sizeModal'));
      myModal.show();
  }
</script>
<script>
    window.addEventListener('scroll', function () {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>

