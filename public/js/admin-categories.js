
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /*
    |--------------------------------------------------------------------------
    | CATEGORY SEARCH - CURRENT PAGE
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById("acCategorySearch");

    const categoryRows = document.querySelectorAll(".ac-category-row");

    if (searchInput && categoryRows.length > 0) {
        searchInput.addEventListener("input", function () {
            const query = searchInput.value.trim().toLowerCase();

            categoryRows.forEach(function (row) {
                const content = row.textContent.toLowerCase();

                row.hidden = !content.includes(query);
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY DELETE CONFIRMATION
    |--------------------------------------------------------------------------
    */

    const deleteForms = document.querySelectorAll(".ac-delete-form");

    deleteForms.forEach(function (form) {
        let submitting = false;

        form.addEventListener("submit", function (event) {
            if (submitting) {
                event.preventDefault();
                return;
            }

            const categoryName =
                form.dataset.categoryName || "this category";

            const confirmed = window.confirm(
                'Are you sure you want to delete "' +
                categoryName +
                '"?\n\nThis action cannot be undone.'
            );

            if (!confirmed) {
                event.preventDefault();
                return;
            }

            submitting = true;

            const deleteButton = form.querySelector(
                'button[type="submit"]'
            );

            if (deleteButton) {
                deleteButton.disabled = true;
                deleteButton.textContent = "Deleting...";
            }
        });
    });

    /*
    |--------------------------------------------------------------------------
    | CATEGORY IMAGE PREVIEW
    |--------------------------------------------------------------------------
    */

    const imageInput = document.getElementById("acImage");

    const imagePreview = document.getElementById("acImagePreview");

    if (imageInput && imagePreview) {
        const originalImage = imagePreview.src;

        let previewUrl = null;

        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];

        const maxFileSize = 4 * 1024 * 1024;

        function resetPreview() {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            imagePreview.src = originalImage;
        }

        imageInput.addEventListener("change", function () {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            const file = imageInput.files[0];

            if (!file) {
                resetPreview();
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                alert(
                    "Invalid image format.\n\n" +
                    "Please select a JPG, PNG or WebP image."
                );

                imageInput.value = "";
                resetPreview();
                return;
            }

            if (file.size > maxFileSize) {
                alert(
                    "Image is too large.\n\n" +
                    "Maximum allowed image size is 4 MB."
                );

                imageInput.value = "";
                resetPreview();
                return;
            }

            previewUrl = URL.createObjectURL(file);

            imagePreview.src = previewUrl;
        });

        window.addEventListener("pagehide", function () {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }
        });
    }
});
