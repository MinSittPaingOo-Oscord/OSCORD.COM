<?php
// welcome_container.php
?>

<style>
    #welcomeCarousel {
      position: relative;
      width: 100vw;
      height: 100vh;
    }

    .welcome-slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 0.6s ease-in-out;
      background-size: cover;
      background-position: center;
    }

    .welcome-slide.active {
      opacity: 1;
    }

    #welcomeIndicators {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 10px;
      z-index: 10;
    }

    .welcome-dot {
      width: 9px;
      height: 9px;
      background-color: white;
      border-radius: 50%;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .welcome-dot.active {
      background-color: #00f2ff; /* Active dot color */
    }

    .welcome-dot:hover {
      background-color: #888;
    }

    /* Desktop images (default) */
    .welcome-slide:nth-child(1) { background-image: url('./image/wel1.png'); }
    .welcome-slide:nth-child(2) { background-image: url('./image/wel2.png'); }
    .welcome-slide:nth-child(3) { background-image: url('./image/wel3.png'); }
    .welcome-slide:nth-child(4) { background-image: url('./image/wel4.png'); }
    .welcome-slide:nth-child(5) { background-image: url('./image/wel5.png'); }
    .welcome-slide:nth-child(6) { background-image: url('./image/wel6.png'); }
    .welcome-slide:nth-child(7) { background-image: url('./image/wel7.png'); }
    .welcome-slide:nth-child(8) { background-image: url('./image/wel8.png'); }

    /* iPad/Tablet images */
    @media (max-width: 1080px) {
      .welcome-slide:nth-child(1) { background-image: url('./image/ipad1.png'); }
      .welcome-slide:nth-child(2) { background-image: url('./image/ipad2.png'); }
      .welcome-slide:nth-child(3) { background-image: url('./image/ipad3.png'); }
      .welcome-slide:nth-child(4) { background-image: url('./image/ipad4.png'); }
      .welcome-slide:nth-child(5) { background-image: url('./image/ipad5.png'); }
      .welcome-slide:nth-child(6) { background-image: url('./image/ipad6.png'); }
      .welcome-slide:nth-child(7) { background-image: url('./image/ipad7.png'); }
      .welcome-slide:nth-child(8) { background-image: url('./image/ipad8.png'); }
    }

    /* Phone images */
    @media (max-width: 767px) {
      .welcome-slide:nth-child(1) { background-image: url('./image/phone1.png'); }
      .welcome-slide:nth-child(2) { background-image: url('./image/phone2.png'); }
      .welcome-slide:nth-child(3) { background-image: url('./image/phone3.png'); }
      .welcome-slide:nth-child(4) { background-image: url('./image/phone4.png'); }
      .welcome-slide:nth-child(5) { background-image: url('./image/phone5.png'); }
      .welcome-slide:nth-child(6) { background-image: url('./image/phone6.png'); }
      .welcome-slide:nth-child(7) { background-image: url('./image/phone7.png'); }
      .welcome-slide:nth-child(8) { background-image: url('./image/phone8.png'); }
    }
</style>

<div id="welcomeCarousel">
  <!-- Slides -->
  <div class="welcome-slide active"></div>
  <div class="welcome-slide"></div>
  <div class="welcome-slide"></div>
  <div class="welcome-slide"></div>
  <div class="welcome-slide"></div>
  <div class="welcome-slide"></div>
  <div class="welcome-slide"></div>
  <div class="welcome-slide"></div>

  <!-- Indicators -->
  <div id="welcomeIndicators">
    <span class="welcome-dot active" onclick="welcomeCurrentSlide(0)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(1)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(2)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(3)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(4)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(5)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(6)"></span>
    <span class="welcome-dot" onclick="welcomeCurrentSlide(7)"></span>
  </div>
</div>

<script>
  let welcomeSlideIndex = 0;
  const welcomeSlides = document.querySelectorAll('.welcome-slide');
  const welcomeDots = document.querySelectorAll('.welcome-dot');

  function welcomeShowSlide(index) {
    if (index >= welcomeSlides.length) welcomeSlideIndex = 0;
    if (index < 0) welcomeSlideIndex = welcomeSlides.length - 1;

    welcomeSlides.forEach(slide => slide.classList.remove('active'));
    welcomeDots.forEach(dot => dot.classList.remove('active'));

    welcomeSlides[welcomeSlideIndex].classList.add('active');
    welcomeDots[welcomeSlideIndex].classList.add('active');
  }

  function welcomeCurrentSlide(n) {
    welcomeSlideIndex = n;
    welcomeShowSlide(welcomeSlideIndex);
  }

  // Auto-advance every 5 seconds
  setInterval(() => {
    welcomeSlideIndex++;
    welcomeShowSlide(welcomeSlideIndex);
  }, 10000);

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') {
      welcomeSlideIndex++;
      welcomeShowSlide(welcomeSlideIndex);
    } else if (e.key === 'ArrowLeft') {
      welcomeSlideIndex--;
      welcomeShowSlide(welcomeSlideIndex);
    }
  });

  // Touch swipe support (basic)
  let welcomeTouchStartX = 0;
  document.addEventListener('touchstart', e => welcomeTouchStartX = e.changedTouches[0].screenX);
  document.addEventListener('touchend', e => {
    const welcomeTouchEndX = e.changedTouches[0].screenX;
    if (welcomeTouchStartX - welcomeTouchEndX > 50) { // Swipe left
      welcomeSlideIndex++;
      welcomeShowSlide(welcomeSlideIndex);
    }
    if (welcomeTouchEndX - welcomeTouchStartX > 50) { // Swipe right
      welcomeSlideIndex--;
      welcomeShowSlide(welcomeSlideIndex);
    }
  });
</script>