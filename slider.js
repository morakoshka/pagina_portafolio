// simple slider logic
document.addEventListener('DOMContentLoaded', function(){
    const container = document.querySelector('#hero-slider .slides');
    const slides = Array.from(container.children);
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const dotsWrap = document.querySelector('.slider-dots');
    let idx = 0;
    let timer = null;
    const interval = 5000;

    // create dots
    slides.forEach((_, i) => {
        const btn = document.createElement('button');
        if (i === 0) btn.classList.add('active');
        btn.addEventListener('click', () => { goTo(i); restartTimer(); });
        dotsWrap.appendChild(btn);
    });
    const dots = Array.from(dotsWrap.children);

    function update(){
        container.style.transform = `translateX(-${idx * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === idx));
    }
    function prev(){ idx = (idx - 1 + slides.length) % slides.length; update(); }
    function next(){ idx = (idx + 1) % slides.length; update(); }
    function goTo(i){ idx = i; update(); }

    prevBtn.addEventListener('click', () => { prev(); restartTimer(); });
    nextBtn.addEventListener('click', () => { next(); restartTimer(); });

    // autoplay
    function startTimer(){ timer = setInterval(next, interval); }
    function stopTimer(){ clearInterval(timer); timer = null; }
    function restartTimer(){ stopTimer(); startTimer(); }

    // pause on hover
    const slider = document.querySelector('#hero-slider .slider');
    slider.addEventListener('mouseenter', stopTimer);
    slider.addEventListener('mouseleave', startTimer);

    // init
    update();
    startTimer();
});