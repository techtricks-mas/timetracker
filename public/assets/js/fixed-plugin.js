var pageName = window.location.pathname.split("/").pop().split(".")[0];

var dark_mode_toggle = document.querySelector("[dark-toggle]");

var root_html = document.querySelector("html");

var toggleicon = document.querySelector(".toggleicon");

var navbar = document.querySelector("[navbar-main]");
var navbar_close = document.querySelector("[sidenav-close]");

navbar.addEventListener('click', function () {
 const check = document.querySelector('aside');
    if (check.getAttribute('aria-expanded') == 'false') {
        check.classList.remove('-translate-x-full')
        check.setAttribute('aria-expanded', true)
        check.classList.add('translate-x-0')
    }
    else{
        check.classList.add('-translate-x-full')
        check.setAttribute('aria-expanded', false)
        check.classList.remove('translate-x-0')
    }
});
navbar_close.addEventListener('click', function () {
    const check = document.querySelector('aside');
    check.classList.add('-translate-x-full')
    check.setAttribute('aria-expanded', false)
    check.classList.remove('translate-x-0')
});

const theme_color = window.localStorage.getItem("dark-mode");
if (theme_color === "true") {
    dark_mode_toggle.setAttribute("manual", "true");
    dark_mode_toggle.setAttribute("checked", "true");
    dark_mode_toggle.classList.remove("white");
    dark_mode_toggle.classList.add("dark");
    toggleicon.classList.remove("fa-sun");
    toggleicon.classList.add("fa-moon");
}
else{
    dark_mode_toggle.setAttribute("manual", "true");
    dark_mode_toggle.classList.remove("dark");
    dark_mode_toggle.classList.add("white");
    toggleicon.classList.remove("fa-moon");
    toggleicon.classList.add("fa-sun");
}

dark_mode_toggle.addEventListener("click", function () {
    dark_mode_toggle.setAttribute("manual", "true");
    if (this.classList.contains("white")) {
        window.localStorage.setItem("dark-mode", "true");
        root_html.classList.add("dark");
        this.classList.remove("white");
        this.classList.add("dark");
        toggleicon.classList.remove("fa-sun");
        toggleicon.classList.add("fa-moon");
    } else {
        window.localStorage.setItem("dark-mode", "false");
        root_html.classList.remove("dark");
        this.classList.remove("dark");
        this.classList.add("white");
        toggleicon.classList.remove("fa-moon");
        toggleicon.classList.add("fa-sun");
    }
});
