
document.addEventListener('DOMContentLoaded', function() {
    const guestBtn = document.getElementById('guest-btn');
    const profileSidebar = document.getElementById('profile-sidebar');

    guestBtn.addEventListener('click', function(e) {
        e.preventDefault();
        profileSidebar.classList.toggle('active');
    });
});
