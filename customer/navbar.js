
var currentURL = window.location.href;
var navLinks = document.querySelectorAll('.navbar a');

navLinks.forEach(function(link) {
    if (link.href === currentURL) {
        link.parentNode.classList.add('active');
    }
});
