{{-- /resources/views/Admin_Side_Screen/Admin-Dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Admin View')

@section('content')
@include('Components.Admin.Ad-Header.Ad-Header', [
    'newsItems' => $newsItems ?? [],
    'contactMessages' => $contactMessages ?? [],
    'blogfeeds' => $blogfeeds ?? [],
    'pageContent' => $pageContent ?? []
])

    <script>
        function confirmBulkDelete() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selected_news_items[]"]:checked');
            const selectedIds = Array.from(checkboxes).map(cb => cb.value);

            if (selectedIds.length === 0) {
                alert('Please select at least one news item to delete.');
                return;
            }

            if (confirm(`Are you sure you want to delete ${selectedIds.length} selected news item(s)?`)) {
                const form = document.createElement('form');
                form.method = 'POST'; // This is correct, as Laravel spoofs DELETE from POST
                form.action = '{{ route('news.bulkDestroy') }}'; // This should resolve to /admin/news/bulk-delete

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // This is the crucial part for spoofing the DELETE m   ethod
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE'; // Ensure this is exactly 'DELETE'
                form.appendChild(methodInput);

                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection

