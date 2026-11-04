
/* =====================================================
   SOFT ALLURE DÉCOR
   ENQUIRY SYSTEM
===================================================== */

document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const KEY = "softAllureEnquiry";
    const MAX_ITEMS = 30;
    const MAX_QTY = 100000;

    const itemsBox = document.getElementById("saEnquiryItems");
    const emptyBox = document.getElementById("saEnquiryEmpty");
    const summary = document.getElementById("saEnquirySummary");
    const summaryCount = document.getElementById("saEnquirySummaryCount");
    const countLabel = document.getElementById("saEnquiryCount");
    const hiddenInput = document.getElementById("saSelectedProductsJson");
    const quoteForm = document.getElementById("sa-quote-form");
    const successMessage = document.getElementById("saQuoteSuccess");

    const quoteSucceeded = Boolean(successMessage);

    function normalize(items) {
        if (!Array.isArray(items)) return [];

        const result = [];
        const seen = new Set();

        for (const item of items) {
            if (!item || typeof item !== "object") continue;

            const id = Number(item.id);
            const quantity = Number(item.quantity);

            if (
                !Number.isSafeInteger(id) ||
                id < 1 ||
                !Number.isSafeInteger(quantity) ||
                quantity < 1 ||
                seen.has(id)
            ) {
                continue;
            }

            seen.add(id);

            result.push({
                id,
                name: String(item.name || `Product #${id}`),
                slug: String(item.slug || ""),
                quantity: Math.min(MAX_QTY, quantity)
            });

            if (result.length >= MAX_ITEMS) break;
        }

        return result;
    }

    function readItems() {
        try {
            return normalize(
                JSON.parse(localStorage.getItem(KEY) || "[]")
            );
        } catch {
            return [];
        }
    }

    function writeItems(items) {
        try {
            localStorage.setItem(
                KEY,
                JSON.stringify(normalize(items))
            );
        } catch {
            // Browser storage may be unavailable.
        }
    }

    function updateNavbar() {
        const count = readItems().length;

        document.querySelectorAll("[data-enquiry-count]")
            .forEach(element => {
                element.textContent = String(count);
                element.hidden = count === 0;
            });
    }

    function makeButton(text, action, id, label) {
        const button = document.createElement("button");

        button.type = "button";
        button.textContent = text;
        button.dataset.action = action;
        button.dataset.id = String(id);
        button.setAttribute("aria-label", label);

        return button;
    }

    function render() {
        updateNavbar();

        if (!itemsBox) return;

        const items = readItems();

        itemsBox.replaceChildren();

        if (countLabel) {
            countLabel.textContent = String(items.length);
        }

        if (summaryCount) {
            summaryCount.textContent = String(items.length);
        }

        if (emptyBox) {
            emptyBox.hidden = items.length > 0;
        }

        if (summary) {
            summary.hidden = items.length === 0;
        }

        if (hiddenInput) {
            hiddenInput.value = JSON.stringify(
                items.map(item => ({
                    id: item.id,
                    quantity: item.quantity
                }))
            );
        }

        items.forEach(item => {
            const row = document.createElement("div");
            row.className = "sa-enquiry-item";

            const info = document.createElement("div");
            info.className = "sa-enquiry-item-info";

            const name = document.createElement("strong");
            name.textContent = item.name;

            const code = document.createElement("span");
            code.textContent = `Product ID: ${item.id}`;

            info.append(name, code);

            const actions = document.createElement("div");
            actions.className = "sa-enquiry-item-actions";

            const quantityBox = document.createElement("div");
            quantityBox.className = "sa-enquiry-qty";

            const minus = makeButton(
                "−",
                "decrease",
                item.id,
                `Decrease ${item.name} quantity`
            );

            const value = document.createElement("input");
            value.type = "number";
            value.min = "1";
            value.max = String(MAX_QTY);
            value.step = "1";
            value.value = String(item.quantity);
            value.dataset.quantityId = String(item.id);
            value.setAttribute(
                "aria-label",
                `${item.name} quantity`
            );

            const plus = makeButton(
                "+",
                "increase",
                item.id,
                `Increase ${item.name} quantity`
            );

            quantityBox.append(minus, value, plus);

            const remove = makeButton(
                "Remove",
                "remove",
                item.id,
                `Remove ${item.name}`
            );

            remove.className = "sa-enquiry-remove";

            actions.append(quantityBox, remove);
            row.append(info, actions);

            itemsBox.append(row);
        });
    }

    function saveItems(items) {
        writeItems(items);
        render();

        window.dispatchEvent(
            new Event("sa:enquiry-updated")
        );
    }

    function changeQuantity(id, nextQuantity) {
        const items = readItems();
        const item = items.find(product => product.id === id);

        if (!item) return;

        const quantity = Number(nextQuantity);

        if (!Number.isSafeInteger(quantity)) {
            render();
            return;
        }

        item.quantity = Math.max(
            1,
            Math.min(MAX_QTY, quantity)
        );

        saveItems(items);
    }

    /* ==========================================
       QUANTITY AND REMOVE BUTTONS
    ========================================== */

    itemsBox?.addEventListener("click", event => {
        const button = event.target.closest(
            "button[data-action]"
        );

        if (!button || !itemsBox.contains(button)) return;

        const id = Number(button.dataset.id);
        const action = button.dataset.action;

        const items = readItems();
        const item = items.find(product => product.id === id);

        if (!item) return;

        if (action === "remove") {
            saveItems(
                items.filter(product => product.id !== id)
            );
        } else if (action === "increase") {
            changeQuantity(id, item.quantity + 1);
        } else if (action === "decrease") {
            changeQuantity(id, item.quantity - 1);
        }
    });

    itemsBox?.addEventListener("change", event => {
        const input = event.target.closest(
            "input[data-quantity-id]"
        );

        if (!input || !itemsBox.contains(input)) return;

        changeQuantity(
            Number(input.dataset.quantityId),
            input.value
        );
    });

    /* ==========================================
       SUCCESSFUL SUBMISSION
    ========================================== */

    if (quoteSucceeded) {
        try {
            localStorage.removeItem(KEY);
        } catch {
            // Ignore storage errors.
        }

        if (hiddenInput) {
            hiddenInput.value = "[]";
        }
    }

    /* ==========================================
       RESTORE AFTER VALIDATION ERRORS
    ========================================== */

    const hasOldInput = Boolean(
        !quoteSucceeded &&
        hiddenInput &&
        hiddenInput.value.trim()
    );

    if (hasOldInput) {
        try {
            const oldItems = JSON.parse(hiddenInput.value);
            const current = readItems();

            if (Array.isArray(oldItems)) {
                const restored = normalize(oldItems).map(item => {
                    const match = current.find(
                        product => product.id === item.id
                    );

                    return {
                        ...item,
                        name: match?.name || item.name,
                        slug: match?.slug || item.slug
                    };
                });

                saveItems(restored);
            }
        } catch {
            // Keep existing enquiry if old input is invalid.
        }
    }

    /* ==========================================
       DIRECT QUOTE FROM PRODUCT DETAILS
    ========================================== */

    if (!quoteSucceeded && !hasOldInput && itemsBox) {
        const params = new URLSearchParams(
            window.location.search
        );

        const idParam = params.get("product_id");
        const nameParam = params.get("product");
        const quantityParam = params.get("quantity");

        const directId = idParam === null
            ? NaN
            : Number(idParam);

        const directName = nameParam?.trim();

        const directQty = quantityParam === null
            ? 1
            : Number(quantityParam);

        if (
            Number.isSafeInteger(directId) &&
            directId > 0 &&
            directName
        ) {
            const items = readItems();

            const quantity = Number.isSafeInteger(directQty)
                ? Math.max(1, Math.min(MAX_QTY, directQty))
                : 1;

            const existing = items.find(
                item => item.id === directId
            );

            if (existing) {
                existing.quantity = quantity;
                existing.name = directName;

                saveItems(items);
            } else if (items.length < MAX_ITEMS) {
                items.push({
                    id: directId,
                    name: directName,
                    slug: "",
                    quantity
                });

                saveItems(items);
            }

            // Prevent stale URL parameters from being
            // imported again after refresh.
            params.delete("product_id");
            params.delete("product");
            params.delete("quantity");

            const query = params.toString();

            const cleanUrl =
                window.location.pathname +
                (query ? `?${query}` : "") +
                window.location.hash;

            window.history.replaceState(
                window.history.state,
                "",
                cleanUrl
            );
        }
    }

    /* ==========================================
       FORM SUBMISSION
    ========================================== */

    quoteForm?.addEventListener("submit", () => {
        if (hiddenInput) {
            hiddenInput.value = JSON.stringify(
                readItems().map(item => ({
                    id: item.id,
                    quantity: item.quantity
                }))
            );
        }
    });

    /* ==========================================
       CROSS-TAB UPDATES
    ========================================== */

    window.addEventListener("storage", render);

    window.addEventListener(
        "sa:enquiry-updated",
        updateNavbar
    );

    render();
});
