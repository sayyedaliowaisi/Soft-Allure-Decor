
/* =====================================================
   SOFT ALLURE DECOR
   TESTIMONIAL REVIEW FORM
===================================================== */

document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const form = document.getElementById("sa-review-form");
    const submitButton = document.getElementById("sa-review-submit");
    const submitLabel = document.getElementById(
        "sa-review-submit-label"
    );

    if (!form || !submitButton) {
        return;
    }

    let isSubmitting = false;

    form.addEventListener("submit", (event) => {
        if (isSubmitting) {
            event.preventDefault();
            return;
        }

        if (!form.checkValidity()) {
            return;
        }

        isSubmitting = true;

        submitButton.disabled = true;
        submitButton.setAttribute("aria-busy", "true");

        if (submitLabel) {
            submitLabel.textContent = "Submitting...";
        }

        // Normal Laravel POST submission continues.
    });
});
