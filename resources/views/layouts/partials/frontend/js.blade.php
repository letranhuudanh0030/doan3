@if (Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
@endif


