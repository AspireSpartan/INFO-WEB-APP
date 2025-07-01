{{-- /resources/views/Admin_Side_Screen/Admin-Dashboard.blade.php --}}



@include('Components.Admin.Ad-Header.Ad-Header', [
    'newsItems' => $newsItems ?? [],
    'contactMessages' => $contactMessages ?? [],
    'blogfeeds' => $blogfeeds ?? [],
    'pageContent' => $pageContent ?? []
])

    


