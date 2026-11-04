document.addEventListener("DOMContentLoaded", function () {

    /* ==========================================
       NAVBAR
    ========================================== */

    const header = document.getElementById("siteHeader");

    function updateNavbar() {
        if (!header) return;

        header.classList.toggle("scrolled", window.scrollY > 30);
    }

    updateNavbar();

    window.addEventListener("scroll", updateNavbar, { passive: true });


    /* ==========================================
       MOBILE MENU
    ========================================== */

    const menuToggle = document.getElementById("mobileMenuToggle");
    const menuClose = document.getElementById("mobileMenuClose");
    const mobileNav = document.getElementById("mobileNav");
    const menuOverlay = document.getElementById("mobileMenuOverlay");

    let previousFocus = null;

    function openMobileMenu() {
        if (!mobileNav) return;

        previousFocus = document.activeElement;

        mobileNav.classList.add("active");
        menuOverlay?.classList.add("active");

        mobileNav.setAttribute("aria-hidden", "false");
        menuToggle?.setAttribute("aria-expanded", "true");

        document.body.classList.add("menu-open");
        menuClose?.focus();
    }

    function closeMobileMenu() {
        if (!mobileNav) return;

        mobileNav.classList.remove("active");
        menuOverlay?.classList.remove("active");

        mobileNav.setAttribute("aria-hidden", "true");
        menuToggle?.setAttribute("aria-expanded", "false");

        document.body.classList.remove("menu-open");

        previousFocus?.focus?.();
    }

    menuToggle?.addEventListener("click", openMobileMenu);
    menuClose?.addEventListener("click", closeMobileMenu);
    menuOverlay?.addEventListener("click", closeMobileMenu);

    mobileNav?.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", closeMobileMenu);
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && mobileNav?.classList.contains("active")) {
            closeMobileMenu();
        }

        if (event.key === "Tab" && mobileNav?.classList.contains("active")) {
            const focusable = Array.from(
                mobileNav.querySelectorAll('a[href], button:not([disabled])')
            );

            if (!focusable.length) return;

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        }
    });


    /* ==========================================
       HERO SLIDER
    ========================================== */

    const hero = document.getElementById("homeHero");

    if (hero) {
        const backgroundSlides = Array.from(
            hero.querySelectorAll(".hero-slide")
        );

        const contentSlides = Array.from(
            hero.querySelectorAll(".hero-content-slide")
        );

        const currentCounter = document.getElementById("heroCurrentSlide");
        const prevButton = document.getElementById("heroPrev");
        const nextButton = document.getElementById("heroNext");

        const totalSlides = Math.min(
            backgroundSlides.length,
            contentSlides.length
        );

        let currentSlide = 0;
        let sliderTimer = null;

        const reducedMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

        function showSlide(index) {
            if (!totalSlides) return;

            currentSlide = (index + totalSlides) % totalSlides;

            backgroundSlides.forEach((slide, i) => {
                slide.classList.toggle("active", i === currentSlide);
            });

            contentSlides.forEach((slide, i) => {
                slide.classList.toggle("active", i === currentSlide);
            });

            if (currentCounter) {
                currentCounter.textContent = String(
                    currentSlide + 1
                ).padStart(2, "0");
            }
        }

        function stopSlider() {
            if (sliderTimer) {
                clearInterval(sliderTimer);
                sliderTimer = null;
            }
        }

        function startSlider() {
            stopSlider();

            if (totalSlides <= 1 || reducedMotion || document.hidden) {
                return;
            }

            sliderTimer = setInterval(() => {
                showSlide(currentSlide + 1);
            }, 6000);
        }

        prevButton?.addEventListener("click", function () {
            showSlide(currentSlide - 1);
            startSlider();
        });

        nextButton?.addEventListener("click", function () {
            showSlide(currentSlide + 1);
            startSlider();
        });

        hero.addEventListener("mouseenter", stopSlider);
        hero.addEventListener("mouseleave", startSlider);

        hero.addEventListener("focusin", stopSlider);
        hero.addEventListener("focusout", function (event) {
            if (!hero.contains(event.relatedTarget)) {
                startSlider();
            }
        });

        document.addEventListener("visibilitychange", function () {
            if (document.hidden) {
                stopSlider();
            } else {
                startSlider();
            }
        });

        showSlide(0);
        startSlider();
    }

});


/* ==========================================
   SCROLL TO TOP / SCROLL TO BOTTOM
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const scrollTopBtn = document.getElementById("saScrollTop");
    const scrollBottomBtn = document.getElementById("saScrollBottom");

    if (!scrollTopBtn || !scrollBottomBtn) return;

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    function updateScrollButtons() {
        const scrollY = window.scrollY;

        const maxScroll = Math.max(
            0,
            document.documentElement.scrollHeight - window.innerHeight
        );

        // Show Top button after scrolling down
        scrollTopBtn.hidden = scrollY < 250;

        // Hide Bottom button when page bottom is reached
        scrollBottomBtn.hidden = maxScroll <= 10 ||
            scrollY >= maxScroll - 80;
    }

    scrollTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: reducedMotion.matches ? "instant" : "smooth"
        });
    });

    scrollBottomBtn.addEventListener("click", function () {
        window.scrollTo({
            top: document.documentElement.scrollHeight,
            behavior: reducedMotion.matches ? "instant" : "smooth"
        });
    });

    window.addEventListener("scroll", updateScrollButtons, {
        passive: true
    });

    window.addEventListener("resize", updateScrollButtons);

    updateScrollButtons();
});
