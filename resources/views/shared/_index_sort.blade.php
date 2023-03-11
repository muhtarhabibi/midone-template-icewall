@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.sort_link', function() {
                var sort_field = $(this).data('sort');
                var sort_by = 'asc';
                if($(this).hasClass('asc')) {
                    sort_by = 'desc';
                }
                $('#sort_value').val(sort_field + '|' + sort_by);
                $('#search_form').submit();
            });
        })
    </script>
@endpush