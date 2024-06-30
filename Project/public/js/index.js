document.addEventListener('DOMContentLoaded', function() {
  var imageList = [
    "img/anhbia.png",
    "img/bia1.jpg",
    "img/bia2.jpg",
    "img/bia3.jpg"
  ];
  var currentImageIndex = 0;
  var imageElement = document.querySelector(".banner-image");
  var leftArrow = document.querySelector(".arrow.left");
  var rightArrow = document.querySelector(".arrow.right");

  function showImage(index) {
    imageElement.src = imageList[index];
    imageElement.classList.add("show");
  }

  function changeImage(index) {
    currentImageIndex = index;
    showImage(currentImageIndex);
  }

  function nextImage() {
    currentImageIndex++;
    if (currentImageIndex >= imageList.length) {
      currentImageIndex = 0;
    }
    changeImage(currentImageIndex);
  }

  function prevImage() {
    currentImageIndex--;
    if (currentImageIndex < 0) {
      currentImageIndex = imageList.length - 1;
    }
    changeImage(currentImageIndex);
  }

  leftArrow.addEventListener('click', prevImage);
  rightArrow.addEventListener('click', nextImage);

  setInterval(nextImage, 3000); // Tự động chuyển ảnh sau mỗi 3 giây

  showImage(currentImageIndex);
});