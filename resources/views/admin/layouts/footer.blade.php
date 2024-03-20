<!-- Footer opened -->
 <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> &copy; {{ __('Copyright') }} <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. {{ __('All Rights Reserved') }} <a href="{{ config('app.url') }}"> {{ config('app.name') }} </a>. </p>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="text-center text-md-right">
            {{-- <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
            <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
            <li class="list-inline-item"><a href="#">Privacy Policy </a> </li> --}}
          </ul>
        </div>
      </div>
    </footer>
<!-- Footer closed -->
