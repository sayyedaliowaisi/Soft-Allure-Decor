
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /* ========================================
       PRODUCT IMAGE PREVIEW
    ======================================== */

    const imageInput = document.getElementById("apImage");
    const imagePreview = document.getElementById("apImagePreview");

    if (imageInput && imagePreview) {
        const originalImage = imagePreview.src;
        let previewUrl = null;

        imageInput.addEventListener("change", function () {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            const file = imageInput.files[0];

            if (!file) {
                imagePreview.src = originalImage;
                return;
            }

            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/webp"
            ];

            if (!allowedTypes.includes(file.type)) {
                alert("Please select a JPG, PNG or WebP image.");
                imageInput.value = "";
                imagePreview.src = originalImage;
                return;
            }

            if (file.size > 4 * 1024 * 1024) {
                alert("Image size must be 4 MB or less.");
                imageInput.value = "";
                imagePreview.src = originalImage;
                return;
            }

            previewUrl = URL.createObjectURL(file);
            imagePreview.src = previewUrl;
        });

        window.addEventListener("pagehide", function () {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
            }
        });
    }

    /* ========================================
       DELETE CONFIRMATION
    ======================================== */

    document.querySelectorAll(".ap-delete-form").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const productName = form.dataset.productName || "this product";

            const confirmed = window.confirm(
                'Are you sure you want to delete "' + productName + '"?\n\n' +
                "This action cannot be undone."
            );

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });

    /* ========================================
       PREVENT DOUBLE FORM SUBMISSION
    ======================================== */

    const productForm = document.querySelector(".ap-product-form");
    const submitButton = document.getElementById("apSubmitButton");

    if (productForm && submitButton) {
        productForm.addEventListener("submit", function () {
            if (!productForm.checkValidity()) {
                return;
            }

            submitButton.disabled = true;
            submitButton.textContent = "Saving...";
        });
    }
});
