
/* =====================================================
   SOFT ALLURE DECOR
   CONTACT US PAGE JAVASCRIPT
===================================================== */

document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const form = document.getElementById("sa-contact-form");
    const submitButton = document.getElementById(
        "sa-contact-submit"
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

        const text = submitButton.querySelector(
            ".sa-contact-submit-text"
        );

        if (text) {
            text.textContent = "Sending...";
        }

        // Normal Laravel POST submission continues.
        // Server validation and mail sending happen in PHP.
    });
});
