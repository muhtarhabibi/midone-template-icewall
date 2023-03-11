@push('scripts')
    <form id='destroy-form' method='POST'>
        @csrf
        @method('DELETE')
    </form>
    {{-- <script>
        $(document).ready(function() {
            $(document).on('click', '.destroy', function() {
                if(confirm('Apakah anda yakin?') ) {
                    $('#destroy-form').attr('action',$(this).data('href'));
                    $('#destroy-form').submit();
                }
            });
        })
    </script> --}}
@endpush