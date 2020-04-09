<!-- Bootstrap core JavaScript-->
{{-- <script src="{{ asset('source_admin/vendor/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{ asset('source_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

<!-- Core plugin JavaScript-->
{{-- <script src="{{ asset('source_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}

<!-- Custom scripts for all pages-->
<script src="{{ asset('source_admin/js/sb-admin-2.min.js') }}"></script>
@if (Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
@endif