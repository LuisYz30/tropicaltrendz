document.addEventListener('DOMContentLoaded', function () {
    const currentURL = window.location.pathname + window.location.search;
    localStorage.setItem('redirectAfterLogin', currentURL);

    const redirectInput = document.getElementById('redirectAfterLogin');
    if (redirectInput) {
        redirectInput.value = localStorage.getItem('redirectAfterLogin');
    }
});
