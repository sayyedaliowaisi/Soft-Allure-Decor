
document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    /* ==========================================
       DESKTOP PRODUCTS DROPDOWN
    ========================================== */

    const productsMenu = document.querySelector(
        "[data-products-menu]"
    );

    const productsToggle = document.querySelector(
        "[data-products-toggle]"
    );

    if (productsMenu && productsToggle) {
        const setDropdownOpen = (open) => {
            productsMenu.classList.toggle("is-open", open);

            productsToggle.setAttribute(
                "aria-expanded",
                String(open)
            );
        };

        productsToggle.addEventListener("click", (event) => {
            event.stopPropagation();

            const isOpen = productsMenu.classList.contains(
                "is-open"
            );

            setDropdownOpen(!isOpen);
        });

        document.addEventListener("click", (event) => {
            if (!productsMenu.contains(event.target)) {
                setDropdownOpen(false);
            }
        });

        productsMenu.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                setDropdownOpen(false);
                productsToggle.focus();
            }
        });

        productsMenu.addEventListener("focusout", (event) => {
            if (
                !event.relatedTarget ||
                !productsMenu.contains(event.relatedTarget)
            ) {
                setDropdownOpen(false);
            }
        });

        // No mouseleave handler.
        // CSS hover keeps dropdown visible while cursor moves.
    }

    /* ==========================================
       MOBILE PRODUCTS ACCORDION
    ========================================== */

    const mobileProductsToggle = document.getElementById(
        "saMobileProductsToggle"
    );

    const mobileProductsCategories = document.getElementById(
        "saMobileProductsCategories"
    );

    if (mobileProductsToggle && mobileProductsCategories) {
        const setMobileProductsOpen = (open) => {
            mobileProductsToggle.setAttribute(
                "aria-expanded",
                String(open)
            );

            mobileProductsCategories.hidden = !open;
        };

        mobileProductsToggle.addEventListener("click", () => {
            const isOpen =
                mobileProductsToggle.getAttribute(
                    "aria-expanded"
                ) === "true";

            setMobileProductsOpen(!isOpen);
        });

        if (
            window.location.pathname.startsWith(
                "/products/category/"
            )
        ) {
            setMobileProductsOpen(true);
        }
    }

    /* ==========================================
       SEARCH PANEL
    ========================================== */

    const searchPanel = document.getElementById(
        "saSearchPanel"
    );

    const searchInput = document.getElementById(
        "saSearchInput"
    );

    const searchClose = document.getElementById(
        "saSearchClose"
    );

    const searchToggles = [
        document.getElementById("saSearchToggle"),
        document.getElementById("saMobileSearchToggle")
    ].filter(Boolean);

    let lastSearchTrigger = null;

    const setSearchOpen = (open, restoreFocus = false) => {
        if (!searchPanel) return;

        searchPanel.hidden = !open;

        searchToggles.forEach((toggle) => {
            toggle.setAttribute(
                "aria-expanded",
                String(open)
            );
        });

        if (open) {
            searchInput?.focus();
        } else if (restoreFocus) {
            lastSearchTrigger?.focus();
        }
    };

    searchToggles.forEach((toggle) => {
        toggle.addEventListener("click", () => {
            if (!searchPanel) return;

            const shouldOpen = searchPanel.hidden;

            if (shouldOpen) {
                lastSearchTrigger = toggle;
            }

            setSearchOpen(shouldOpen, !shouldOpen);
        });
    });

    searchClose?.addEventListener("click", () => {
        setSearchOpen(false, true);
    });

    document.addEventListener("click", (event) => {
        if (!searchPanel || searchPanel.hidden) return;

        const clickedToggle = searchToggles.some((toggle) =>
            toggle.contains(event.target)
        );

        if (
            !searchPanel.contains(event.target) &&
            !clickedToggle
        ) {
            setSearchOpen(false);
        }
    });

    document.addEventListener("keydown", (event) => {
        if (
            event.key === "Escape" &&
            searchPanel &&
            !searchPanel.hidden
        ) {
            setSearchOpen(false, true);
        }
    });
});
