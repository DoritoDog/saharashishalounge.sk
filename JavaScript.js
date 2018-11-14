var images = ["sahara15", "sahara14", "sahara4"];
var currentIndex = 0;

function nextSlide() {
    currentIndex++;
    if (currentIndex > 2) {
        currentIndex = 0;
    }
    var image = images[currentIndex];
    document.getElementById("showcase").style.backgroundImage = "url('Sahara/" + image + ".jpg')";
}

function prevSlide() {
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex = 2;
    }
    var image = images[currentIndex];
    document.getElementById("showcase").style.backgroundImage = "url('Sahara/" + image + ".jpg')";
}

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        var navbar = document.getElementById("navigation-bar");
        navbar.style.backgroundColor = "rgba(255, 255, 255, 1.00)";
        navbar.style.border = "1px solid #eb6e00";
        var links = document.getElementsByClassName('navbar-link');
        for (var i = 0; i < links.length; i++) {
            links[i].style.color = '#eb6e00';
        }
    } else {
        var navbar = document.getElementById("navigation-bar");
        navbar.style.backgroundColor = "rgba(0, 0, 0, 0.00)";
        navbar.style.border = "none";
        var links = document.getElementsByClassName('navbar-link');
        for (var i = 0; i < links.length; i++) {
            links[i].style.color = 'white';
        }
    }
}

window.onload = function () {
    var rating = 4.6;
    document.getElementById('star-percent').style.width = (rating * 20) + '%';
}

var currentMenuSlide = 0;
function refreshMenuShowcase() {
    var slides = [
        {
            "imgs": ['coffee', 'cake', 'sahara4'],
            "names": ['Kava', "Dezert", "Smoothie"]
        },
        {
            "imgs": ['hot chocolate', 'tea', 'tuna melt'],
            "names": ['Horúca čokoláda', "Čaj", "Tuna melt"]
        },
    ];

    // Check for overflow or underflow
    if (currentMenuSlide > slides.length - 1) {
        currentMenuSlide = 0;
    } else if (currentMenuSlide < 0) {
        currentMenuSlide = slides.length - 1;
    }

    var menuImgs = document.getElementsByClassName("menu-img");
    var text = document.getElementsByClassName('menu-item-text');

    for (var i = 0; i < menuImgs.length; i++) {
        menuImgs[i].src = 'Sahara/' + slides[currentMenuSlide].imgs[i] + '.jpg';
        text[i].innerHTML = slides[currentMenuSlide].names[i];
    }
}