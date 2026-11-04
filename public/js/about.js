
/* =====================================================
   SOFT ALLURE DECOR
   ABOUT US PAGE JAVASCRIPT
===================================================== */

document.addEventListener("DOMContentLoaded", () => {

    "use strict";

    /* -----------------------------------------------
       01. Check reduced motion preference
    ----------------------------------------------- */

    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    /* -----------------------------------------------
       02. Reveal elements on scroll
    ----------------------------------------------- */

    const revealSelectors = [
        ".sa-about-story-image",
        ".sa-about-story-content",
        ".sa-about-purpose-header",
        ".sa-about-purpose-card",
        ".sa-about-offerings-header",
        ".sa-about-offering-card",
        ".sa-about-why-header",
        ".sa-about-why-card",
        ".sa-about-approach-header",
        ".sa-about-approach-step",
        ".sa-about-cta-content"
    ];

    const revealElements = document.querySelectorAll(
        revealSelectors.join(",")
    );

    if (reduceMotion || !("IntersectionObserver" in window)) {
        return;
    }

    /* Add initial reveal styles */

    revealElements.forEach((element) => {
        element.classList.add("sa-about-reveal");
    });

    /* Observer */

    const revealObserver = new IntersectionObserver(
        (entries, observer) => {

            entries.forEach((entry) => {

                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add("is-visible");

                observer.unobserve(entry.target);

            });

        },
        {
            threshold: 0.08,
            rootMargin: "0px 0px 40px 0px"
        }
    );

    revealElements.forEach((element) => {
        revealObserver.observe(element);
    });

    /* -----------------------------------------------
       03. Staggered animations for cards
    ----------------------------------------------- */

    const staggerGroups = [
        ".sa-about-purpose-grid",
        ".sa-about-offerings-grid",
        ".sa-about-why-grid",
        ".sa-about-approach-timeline"
    ];

    staggerGroups.forEach((selector) => {

        const group = document.querySelector(selector);

        if (!group) {
            return;
        }

        const children = Array.from(group.children);

        children.forEach((child, index) => {

            const delay = Math.min(index * 90, 360);

            child.style.setProperty(
                "--sa-reveal-delay",
                `${delay}ms`
            );

        });

    });

});
