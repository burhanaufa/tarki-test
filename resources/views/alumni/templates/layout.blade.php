<!DOCTYPE html>
<html lang="en">
	@include('alumni.templates.head')
<body id="page-top">
	@include('alumni.templates.menu')
	 
	@yield('content')

	@include('alumni.templates.footer')

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('assets/alumni/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/alumni/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('assets/alumni/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Contact Form JavaScript -->
  <script src="{{ asset('assets/alumni/js/jqBootstrapValidation.js') }}"></script>
  <script src="{{ asset('assets/alumni/js/contact_me.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('assets/alumni/js/freelancer.min.js') }}"></script>

</body>

</html>