
{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

{{-- sweetalert2 --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>


<script src="{{ asset('sketch-food/js/bootstrap.bundle.js') }}"></script>

 <!-- iconify -->
 <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>


@stack('js-navbar')
 @stack('js-login')
 @stack('js-register')
 @stack('js-reservation')
 @stack('js-input-reservation')
