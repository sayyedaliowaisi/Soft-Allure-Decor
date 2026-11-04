
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /*
    |--------------------------------------------------------------------------
    | ELEMENTS
    |--------------------------------------------------------------------------
    */

    const quantityInput = document.getElementById("spdQuantity");
    const decreaseButton = document.getElementById("spdDecrease");
    const increaseButton = document.getElementById("spdIncrease");

    const addButton = document.getElementById("spdAddEnquiry");
    const feedback = document.getElementById("spdFeedback");
    const quoteNow = document.getElementById("spdQuoteNow");

    const mainImage = document.getElementById("spdMainImage");
    const thumbnails = document.querySelectorAll(".spd-thumbnail");

    const zoomButton = document.getElementById("spdZoomButton");
    const lightbox = document.getElementById("spdLightbox");
    const lightboxImage = document.getElementById("spdLightboxImage");
    const closeLightbox = document.getElementById("spdLightboxClose");

    const STORAGE_KEY = "softAllureEnquiry";
    const MAX_QUANTITY = 100000;

    let previousFocus = null;
    let previousBodyOverflow = "";

    /*
    |--------------------------------------------------------------------------
    | QUANTITY HELPERS
    |--------------------------------------------------------------------------
    */

    function normalizeQuantity(value) {
        const parsed = Number(value);

        if (!Number.isFinite(parsed)) {
            return 1;
        }

        return Math.max(
            1,
            Math.min(MAX_QUANTITY, Math.trunc(parsed))
        );
    }

    function getQuantity() {
        if (!quantityInput) {
            return 1;
        }

        return normalizeQuantity(quantityInput.value);
    }

    function updateQuantity(value) {
        if (!quantityInput) {
            return;
        }

        quantityInput.value = normalizeQuantity(value);
    }

    decreaseButton?.addEventListener("click", function () {
        updateQuantity(getQuantity() - 1);
    });

    increaseButton?.addEventListener("click", function () {
        updateQuantity(getQuantity() + 1);
    });

    quantityInput?.addEventListener("change", function () {
        updateQuantity(getQuantity());
    });

    quantityInput?.addEventListener("blur", function () {
        updateQuantity(getQuantity());
    });

    /*
    |--------------------------------------------------------------------------
    | FEEDBACK
    |--------------------------------------------------------------------------
    */

    function showFeedback(message, success = true) {
        if (!feedback) {
            return;
        }

        feedback.textContent = message;
        feedback.style.color = success ? "#047857" : "#b42318";
        feedback.setAttribute("role", "status");
        feedback.setAttribute("aria-live", "polite");
    }

    /*
    |--------------------------------------------------------------------------
    | ADD TO ENQUIRY
    |--------------------------------------------------------------------------
    */

    function saveEnquiry() {
        if (!addButton) {
            return false;
        }

        const product = {
            id: addButton.dataset.productId,
            name: addButton.dataset.productName,
            slug: addButton.dataset.productSlug,
            quantity: getQuantity()
        };

        if (!product.id || !product.name || !product.slug) {
            showFeedback(
                "Product information is missing.",
                false
            );

            return false;
        }

        try {
            let enquiry = [];

            const storedValue = localStorage.getItem(STORAGE_KEY);

            if (storedValue) {
                const parsed = JSON.parse(storedValue);

                if (Array.isArray(parsed)) {
                    enquiry = parsed;
                }
            }

            const existing = enquiry.find(function (item) {
                return (
                    item &&
                    String(item.id) === String(product.id)
                );
            });

            if (existing) {
                const oldQuantity = normalizeQuantity(
                    existing.quantity
                );

                existing.quantity = Math.min(
                    MAX_QUANTITY,
                    oldQuantity + product.quantity
                );

                existing.name = product.name;
                existing.slug = product.slug;
            } else {
                enquiry.push(product);
            }

            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(enquiry)
            );

            showFeedback(
                "Product added to your enquiry list successfully."
            );

            return true;

        } catch (error) {
            console.error("Enquiry storage error:", error);

            showFeedback(
                "Unable to save enquiry. Please try again.",
                false
            );

            return false;
        }
    }

    addButton?.addEventListener("click", saveEnquiry);

    /*
    |--------------------------------------------------------------------------
    | REQUEST QUOTE
    |--------------------------------------------------------------------------
    */

    if (quoteNow) {
        const originalQuoteUrl = quoteNow.getAttribute("href");

        quoteNow.addEventListener("click", function (event) {
            try {
                if (!originalQuoteUrl) {
                    throw new Error("Quote URL is missing.");
                }

                const url = new URL(
                    originalQuoteUrl,
                    window.location.href
                );

                url.searchParams.set(
                    "quantity",
                    String(getQuantity())
                );

                quoteNow.href = url.toString();

            } catch (error) {
                console.error("Quote URL error:", error);

                event.preventDefault();

                showFeedback(
                    "Unable to open the quote page.",
                    false
                );
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT GALLERY
    |--------------------------------------------------------------------------
    */

    thumbnails.forEach(function (thumbnail) {
        thumbnail.addEventListener("click", function () {
            const image = thumbnail.dataset.image;

            if (!image || !mainImage) {
                return;
            }

            mainImage.src = image;

            const thumbnailImage = thumbnail.querySelector("img");

            if (thumbnailImage?.alt) {
                mainImage.alt = thumbnailImage.alt;
            }

            thumbnails.forEach(function (item) {
                item.classList.remove("active");
                item.setAttribute("aria-pressed", "false");
            });

            thumbnail.classList.add("active");
            thumbnail.setAttribute("aria-pressed", "true");
        });
    });

    /*
    |--------------------------------------------------------------------------
    | LIGHTBOX HELPERS
    |--------------------------------------------------------------------------
    */

    function openPreview() {
        if (
            !lightbox ||
            !lightboxImage ||
            !mainImage ||
            !closeLightbox
        ) {
            return;
        }

        if (!lightbox.hidden) {
            return;
        }

        previousFocus = document.activeElement;
        previousBodyOverflow = document.body.style.overflow;

        lightboxImage.src = mainImage.src;
        lightboxImage.alt = mainImage.alt;

        lightbox.hidden = false;
        lightbox.setAttribute("aria-hidden", "false");

        document.body.style.overflow = "hidden";

        closeLightbox.focus();
    }

    function closePreview() {
        if (!lightbox || lightbox.hidden) {
            return;
        }

        lightbox.hidden = true;
        lightbox.setAttribute("aria-hidden", "true");

        document.body.style.overflow = previousBodyOverflow;

        if (
            previousFocus &&
            previousFocus.isConnected &&
            typeof previousFocus.focus === "function"
        ) {
            previousFocus.focus();
        } else {
            zoomButton?.focus();
        }

        previousFocus = null;
    }

    /*
    |--------------------------------------------------------------------------
    | LIGHTBOX EVENTS
    |--------------------------------------------------------------------------
    */

    zoomButton?.addEventListener("click", openPreview);

    closeLightbox?.addEventListener("click", closePreview);

    lightbox?.addEventListener("click", function (event) {
        if (event.target === lightbox) {
            closePreview();
        }
    });

    lightbox?.addEventListener("keydown", function (event) {
        if (event.key !== "Tab" || !closeLightbox) {
            return;
        }

        event.preventDefault();
        closeLightbox.focus();
    });

    document.addEventListener("keydown", function (event) {
        if (!lightbox || lightbox.hidden) {
            return;
        }

        if (event.key === "Escape") {
            event.preventDefault();
            closePreview();
        }

        if (event.key === "Tab" && closeLightbox) {
            event.preventDefault();
            closeLightbox.focus();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | REVIEW FORM
    |--------------------------------------------------------------------------
    |
    | Laravel handles review submission, CSRF and validation.
    | No additional JavaScript is required.
    |
    |--------------------------------------------------------------------------
    */
});
