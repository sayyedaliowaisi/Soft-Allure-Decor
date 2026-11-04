
/* =====================================================
   SOFT ALLURE DECOR
   GALLERY / PROJECTS PAGE

   01. Category Filters
   02. Image Lightbox
   03. Keyboard Navigation
   04. Mobile Swipe
===================================================== */

document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    /* ================================================
       ELEMENTS
    ================================================ */

    const filterButtons = Array.from(
        document.querySelectorAll(".sa-projects-filter")
    );

    const projectCards = Array.from(
        document.querySelectorAll(".sa-project-card")
    );

    const countElement = document.getElementById(
        "sa-projects-count"
    );

    const emptyElement = document.getElementById(
        "sa-projects-empty"
    );

    const lightbox = document.getElementById(
        "sa-gallery-lightbox"
    );

    const lightboxImage = document.getElementById(
        "sa-lightbox-image"
    );

    const lightboxTitle = document.getElementById(
        "sa-lightbox-title"
    );

    const lightboxCategory = document.getElementById(
        "sa-lightbox-category"
    );

    const lightboxCounter = document.getElementById(
        "sa-lightbox-counter"
    );

    const closeButton = document.getElementById(
        "sa-lightbox-close"
    );

    const prevButton = document.getElementById(
        "sa-lightbox-prev"
    );

    const nextButton = document.getElementById(
        "sa-lightbox-next"
    );

    if (!projectCards.length) {
        return;
    }

    let visibleCards = [...projectCards];
    let currentIndex = 0;
    let lastFocusedElement = null;
    let previousBodyOverflow = "";
    let touchStartX = 0;
    let touchStartY = 0;

    /* ================================================
       01. CATEGORY FILTERS
    ================================================ */

    function filterProjects(category) {

        let visibleCount = 0;

        projectCards.forEach((card) => {

            const matches =
                category === "all" ||
                card.dataset.category === category;

            card.hidden = !matches;

            if (matches) {
                visibleCount++;
            }
        });

        visibleCards = projectCards.filter(
            (card) => !card.hidden
        );

        if (countElement) {
            countElement.textContent =
                `Showing ${visibleCount} ${
                    visibleCount === 1 ? "image" : "images"
                }`;
        }

        if (emptyElement) {
            emptyElement.hidden = visibleCount !== 0;
        }
    }

    filterButtons.forEach((button) => {

        button.addEventListener("click", () => {

            const category = button.dataset.filter || "all";

            filterButtons.forEach((item) => {

                const isActive = item === button;

                item.classList.toggle(
                    "is-active",
                    isActive
                );

                item.setAttribute(
                    "aria-pressed",
                    String(isActive)
                );
            });

            filterProjects(category);
        });
    });

    filterProjects("all");

    /* ================================================
       02. LIGHTBOX SETUP
    ================================================ */

    if (
        !lightbox ||
        !lightboxImage ||
        !lightboxTitle ||
        !lightboxCategory ||
        !lightboxCounter ||
        !closeButton ||
        !prevButton ||
        !nextButton
    ) {
        return;
    }

    function isLightboxOpen() {
        return !lightbox.hidden;
    }

    function updateLightbox() {

        const card = visibleCards[currentIndex];

        if (!card) {
            return;
        }

        const image = card.querySelector("img");

        const title = card.querySelector(
            ".sa-project-card-title"
        );

        const category = card.querySelector(
            ".sa-project-card-category"
        );

        if (!image) {
            return;
        }

        lightboxImage.src = image.currentSrc || image.src;

        lightboxImage.alt =
            image.alt || "Gallery project image";

        lightboxTitle.textContent =
            title?.textContent.trim() || "Gallery Image";

        lightboxCategory.textContent =
            category?.textContent.trim() || "";

        lightboxCounter.textContent =
            `${currentIndex + 1} / ${visibleCards.length}`;

        const multipleImages = visibleCards.length > 1;

        prevButton.hidden = !multipleImages;
        nextButton.hidden = !multipleImages;
    }

    function openLightbox(card) {

        const index = visibleCards.indexOf(card);

        if (index === -1) {
            return;
        }

        currentIndex = index;
        lastFocusedElement = document.activeElement;

        previousBodyOverflow = document.body.style.overflow;
        document.body.style.overflow = "hidden";

        lightbox.hidden = false;
        lightbox.setAttribute("aria-hidden", "false");

        updateLightbox();

        closeButton.focus();
    }

    function closeLightbox() {

        if (!isLightboxOpen()) {
            return;
        }

        lightbox.hidden = true;
        lightbox.setAttribute("aria-hidden", "true");

        lightboxImage.removeAttribute("src");

        document.body.style.overflow = previousBodyOverflow;

        if (
            lastFocusedElement &&
            typeof lastFocusedElement.focus === "function"
        ) {
            lastFocusedElement.focus();
        }
    }

    function showNext() {

        if (!visibleCards.length) {
            return;
        }

        currentIndex =
            (currentIndex + 1) % visibleCards.length;

        updateLightbox();
    }

    function showPrevious() {

        if (!visibleCards.length) {
            return;
        }

        currentIndex =
            (currentIndex - 1 + visibleCards.length) %
            visibleCards.length;

        updateLightbox();
    }

    /* ================================================
       03. CARD CLICK EVENTS
    ================================================ */

    projectCards.forEach((card) => {

        const button = card.querySelector(
            ".sa-project-card-button"
        );

        if (!button) {
            return;
        }

        button.addEventListener("click", () => {
            openLightbox(card);
        });
    });

    /* ================================================
       04. LIGHTBOX BUTTON EVENTS
    ================================================ */

    closeButton.addEventListener("click", closeLightbox);

    nextButton.addEventListener("click", showNext);

    prevButton.addEventListener("click", showPrevious);

    /* Click on dark background to close */

    lightbox.addEventListener("click", (event) => {

        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    /* ================================================
       05. KEYBOARD NAVIGATION
    ================================================ */

    document.addEventListener("keydown", (event) => {

        if (!isLightboxOpen()) {
            return;
        }

        if (event.key === "Escape") {
            event.preventDefault();
            closeLightbox();
            return;
        }

        if (event.key === "ArrowRight") {
            event.preventDefault();
            showNext();
            return;
        }

        if (event.key === "ArrowLeft") {
            event.preventDefault();
            showPrevious();
            return;
        }

        /* Keep keyboard focus inside lightbox */

        if (event.key === "Tab") {

            const focusable = Array.from(
                lightbox.querySelectorAll(
                    "button:not([disabled]):not([hidden])"
                )
            ).filter(
                (button) => button.getClientRects().length > 0
            );

            if (!focusable.length) {
                event.preventDefault();
                return;
            }

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (
                event.shiftKey &&
                document.activeElement === first
            ) {
                event.preventDefault();
                last.focus();
            } else if (
                !event.shiftKey &&
                document.activeElement === last
            ) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    /* ================================================
       06. MOBILE SWIPE
    ================================================ */

    lightbox.addEventListener(
        "touchstart",
        (event) => {

            if (event.touches.length !== 1) {
                return;
            }

            touchStartX = event.touches[0].clientX;
            touchStartY = event.touches[0].clientY;

        },
        { passive: true }
    );

    lightbox.addEventListener(
        "touchend",
        (event) => {

            if (!isLightboxOpen()) {
                return;
            }

            if (!event.changedTouches.length) {
                return;
            }

            const touchEndX =
                event.changedTouches[0].clientX;

            const touchEndY =
                event.changedTouches[0].clientY;

            const deltaX = touchEndX - touchStartX;
            const deltaY = touchEndY - touchStartY;

            /* Ignore vertical scrolling and small swipes */

            if (
                Math.abs(deltaX) < 55 ||
                Math.abs(deltaX) <= Math.abs(deltaY)
            ) {
                return;
            }

            if (deltaX < 0) {
                showNext();
            } else {
                showPrevious();
            }

        },
        { passive: true }
    );
});
