<footer class="footer footer-light @if(isset($configData['footerType'])){{$configData['footerClass']}}@endif">
  <p class="clearfix mb-0">
    <span class="float-left d-inline-block"><script>document.write(new Date().getFullYear())</script> &copy; PEA</span>
    <span class="float-right d-sm-inline-block d-none">Crafted with
      <i class="bx bxs-heart pink mx-50 font-small-3"></i>by
      <a class="text-uppercase" href="tel:0840416820" target="_blank">PEA Meter</a>
    </span>
  </p>
  @if($configData['isScrollTop'] === true)
  <button class="btn btn-primary btn-icon scroll-top" type="button" style="display: inline-block;">
  <i class="bx bx-up-arrow-alt"></i>
  </button>
  @endif
</footer>

