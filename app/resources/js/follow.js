document.addEventListener('DOMContentLoaded', function () {
    const followBtn = document.getElementById('follow-btn');

    if (followBtn) {
        followBtn.addEventListener('click', function () {
            const userId = this.dataset.userId;

            fetch(`/follow/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                followBtn.textContent = data.following ? 'フォロー解除' : 'フォロー';
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
