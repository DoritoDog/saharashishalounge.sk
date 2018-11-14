function setImage(img) {
    var mainImg = document.getElementById('main-img');
    mainImg.src = img;
}

function nextImage() {
    if (!(currentImgIndex + 1 >= bottomImages.length)) currentImgIndex++;
    else currentImgIndex = 0;

    currentImage = bottomImages[currentImgIndex];
    setImage(currentImage.src);
}

function previousImage() {
    if (currentImgIndex - 1 >= 0) currentImgIndex--;
    else currentImgIndex = bottomImages.length - 1;

    currentImage = bottomImages[currentImgIndex];
    setImage(currentImage.src);
}

var mainImg;
var bottomImages;
var currentImgIndex = 0;
var currentImage;

window.onload = function () {
    mainImg = document.getElementById('main-img');
    bottomImages = document.getElementsByClassName('gallery-img');
    
    currentImage = bottomImages[currentImgIndex];
    setImage(currentImage.src);

    for (var i = 0; i < bottomImages.length; i++) {
        bottomImages[i].addEventListener('click', function () {
            currentImgIndex = this.index;
            currentImage = bottomImages[currentImgIndex];
            setImage(this.src);
        });
        bottomImages[i].index = i;
    }
}