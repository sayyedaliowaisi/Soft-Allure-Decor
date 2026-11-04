
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const STORAGE_KEY = "softAllureEnquiry";
    const MAX_ITEMS = 30;
    const MAX_QUANTITY = 100000;

    // ==========================================
    // PRODUCT SORTING
    // ==========================================

    const sortSelect = document.getElementById("saProductSort");

    if (sortSelect) {
        sortSelect.addEventListener("change", function () {
            const form = sortSelect.closest("form");

            if (form) {
                form.submit();
            }
        });
    }

    // ==========================================
    // IMAGE FALLBACK
    // ==========================================

    const productImages = document.querySelectorAll(
        ".sa-products-page .sa-product-image img, " +
        ".sa-products-page .sa-category-card img"
    );

    productImages.forEach(function (image) {
        image.addEventListener("error", function () {
            if (image.dataset.fallbackApplied === "true") {
                return;
            }

            image.dataset.fallbackApplied = "true";
            image.src = "/images/product-placeholder.jpg";
        });
    });

    // ==========================================
    // ENQUIRY STORAGE
    // ==========================================

    function getEnquiryItems() {
        try {
            const items = JSON.parse(
                localStorage.getItem(STORAGE_KEY) || "[]"
            );

            return Array.isArray(items) ? items : [];
        } catch (error) {
            return [];
        }
    }

    function saveEnquiryItems(items) {
        try {
            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(items)
            );

            window.dispatchEvent(
                new Event("sa:enquiry-updated")
            );

            return true;
        } catch (error) {
            return false;
        }
    }

    // ==========================================
    // ADD TO ENQUIRY
    // ==========================================

    document.addEventListener("click", function (event) {
        const button = event.target.closest(
            ".sa-add-enquiry"
        );

        if (!button) return;

        // This handler only manages products listing buttons.
        if (!button.closest(".sa-products-page")) {
            return;
        }

        event.preventDefault();

        const productId = Number(button.dataset.productId);
        const productName = button.dataset.productName;
        const productSlug = button.dataset.productSlug || "";

        if (
            !Number.isSafeInteger(productId) ||
            productId < 1 ||
            !productName
        ) {
            return;
        }

        const items = getEnquiryItems();

        const existing = items.find(function (item) {
            return Number(item.id) === productId;
        });

        if (existing) {
            existing.quantity = Math.min(
                MAX_QUANTITY,
                Math.max(1, Number(existing.quantity) || 1) + 1
            );
        } else {
            if (items.length >= MAX_ITEMS) {
                showFeedback(
                    button,
                    "Enquiry list is full"
                );
                return;
            }

            items.push({
                id: productId,
                name: productName,
                slug: productSlug,
                quantity: 1
            });
        }

        const saved = saveEnquiryItems(items);

        showFeedback(
            button,
            saved ? "Added to Enquiry ✓" : "Unable to save"
        );
    });

    // ==========================================
    // BUTTON FEEDBACK
    // ==========================================

    function showFeedback(button, message) {
    if (!button.dataset.originalHtml) {
        button.dataset.originalHtml = button.innerHTML;
    }

    button.textContent = message;

    clearTimeout(button._enquiryTimeout);

    button._enquiryTimeout = setTimeout(function () {
        button.innerHTML = button.dataset.originalHtml;
    }, 1800);
}
});
