
/* =====================================================
   SOFT ALLURE DÉCOR
   GET A QUOTE FORM
   File Validation + Submission Protection
===================================================== */

document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const form = document.getElementById("sa-quote-form");

    const submitButton = document.getElementById(
        "sa-quote-submit"
    );

    const submitLabel = document.getElementById(
        "sa-quote-submit-label"
    );

    const fileInput = document.getElementById(
        "quote_attachment"
    );

    const fileName = document.getElementById(
        "sa-quote-file-name"
    );

    if (!form || !submitButton) {
        return;
    }

    const MAX_FILE_SIZE = 5 * 1024 * 1024;

    const ALLOWED_EXTENSIONS = new Set([
        "jpg",
        "jpeg",
        "png",
        "webp",
        "pdf"
    ]);

    let isSubmitting = false;

    /* ==========================================
       RESET SUBMISSION STATE
    ========================================== */

    function resetSubmissionState() {
        isSubmitting = false;

        submitButton.disabled = false;
        submitButton.removeAttribute("aria-busy");

        if (submitLabel) {
            submitLabel.textContent =
                "Submit Quote Request";
        }
    }

    /* ==========================================
       FILE VALIDATION
    ========================================== */

    function validateAttachment() {
        if (!fileInput) {
            return true;
        }

        const file = fileInput.files?.[0];

        fileInput.setCustomValidity("");

        if (fileName) {
            fileName.textContent = "";
        }

        if (!file) {
            return true;
        }

        const extension = file.name
            .split(".")
            .pop()
            ?.toLowerCase() || "";

        if (!ALLOWED_EXTENSIONS.has(extension)) {
            fileInput.value = "";

            if (fileName) {
                fileName.textContent =
                    "Invalid file type. Please select JPG, PNG, WEBP or PDF.";
            }

            return false;
        }

        if (file.size > MAX_FILE_SIZE) {
            fileInput.value = "";

            if (fileName) {
                fileName.textContent =
                    "File is too large. Maximum allowed size is 5 MB.";
            }

            return false;
        }

        if (fileName) {
            fileName.textContent =
                `Selected: ${file.name}`;
        }

        return true;
    }

    if (fileInput) {
        fileInput.addEventListener(
            "change",
            validateAttachment
        );
    }

    /* ==========================================
       PREVENT DUPLICATE SUBMISSION
    ========================================== */

    form.addEventListener("submit", (event) => {

        if (isSubmitting) {
            event.preventDefault();
            return;
        }

        if (!validateAttachment()) {
            event.preventDefault();
            return;
        }

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        isSubmitting = true;

        submitButton.disabled = true;
        submitButton.setAttribute(
            "aria-busy",
            "true"
        );

        if (submitLabel) {
            submitLabel.textContent =
                "Submitting...";
        }

        // Allow normal Laravel POST submission.
    });

    /* ==========================================
       BROWSER BACK/FORWARD CACHE
    ========================================== */

    window.addEventListener("pageshow", () => {
        resetSubmissionState();
    });

});
