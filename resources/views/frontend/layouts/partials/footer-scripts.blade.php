  <!-- Scripts -->
  <script src="{{ url('frontend/js/modernizr-3.5.0.min.js') }}"></script>
  <script src="{{ url('frontend/jquery/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ url('frontend/js/popper.min.js') }}"></script>
  <script src="{{ url('frontend/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('frontend/js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ url('frontend/slick/js/slick.min.js') }}"></script>
  <script src="{{ url('frontend//jquery/jquery.meanmenu.min.js') }}"></script>
  <script src="{{ url('frontend/js/ajax-form.js') }}"></script>
  <script src="{{ url('frontend/js/wow.min.js') }}"></script>
  <script src="{{ url('frontend/jquery/jquery.scrollUp.min.js') }}"></script>
  <script src="{{ url('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ url('frontend/jquery/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ url('frontend/js/waypoints.min.js') }}"></script>
  <script src="{{ url('frontend/jquery/jquery.counterup.min.js') }}"></script>
  <script src="{{ url('frontend/js/plugins.js') }}"></script>
  <script src="{{ url('frontend/swiper@9/swiper-bundle.min.js') }}"></script>
  <script src="{{ url('frontend/js/main.js') }}"></script>
  <script src="{{ url('frontend/izitoast/js/iziToast.min.js') }}"></script>

  @livewireScripts
  <script>
      // On page load or when changing themes, best to add inline in `head` to avoid FOUC
      if (localStorage.getItem("theme-color") === "dark" || (!("theme-color" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        document.getElementById("light--to-dark-button")?.classList.add("dark--mode");
      } 
      if (localStorage.getItem("theme-color") === "light") {
        document.getElementById("light--to-dark-button")?.classList.remove("dark--mode");
      } 
    </script>




  <a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;"><i class="icofont-rounded-up"></i></a>
