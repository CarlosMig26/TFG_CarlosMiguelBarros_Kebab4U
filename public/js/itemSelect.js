document.addEventListener('DOMContentLoaded', function() {
    let items = document.querySelectorAll('.item');

    items.forEach(function(item) {
        item.addEventListener('click', function() {
            let url = this.getAttribute('data-url');
            window.location.href = url;
        });
    });
});
