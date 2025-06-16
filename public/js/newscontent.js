document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.news-item').forEach(item => {
        item.addEventListener('click', () => {
            const newsId = item.getAttribute('data-id');
            fetch('/news/view/' + newsId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    const viewsSpan = item.querySelector('.views-count');
                    if(viewsSpan) {
                        viewsSpan.textContent = data.views;
                    }
                }
            });
        });
    });
});