document.querySelectorAll('.booking-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const button = this.querySelector('.book-btn');
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Sending...';

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            button.innerHTML = '<i class="fas fa-check me-1"></i> Sent';
            button.classList.replace('btn-primary', 'btn-success');
        })
        .catch(error => {
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-calendar-check me-1"></i> Book Now';
        });
    });
});