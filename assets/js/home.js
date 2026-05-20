const navButtons = document.querySelectorAll(".nav-item[data-target]");
const panels = document.querySelectorAll(".home-panel");
const logoutButton = document.getElementById("logoutButton");

function activatePanel(targetName) {
    navButtons.forEach((button) => {
        const isCurrent = button.dataset.target === targetName;
        button.classList.toggle("is-active", isCurrent);
    });

    panels.forEach((panel) => {
        const isCurrent = panel.dataset.panel === targetName;
        panel.classList.toggle("is-active", isCurrent);
    });
}

navButtons.forEach((button) => {
    button.addEventListener("click", () => {
        activatePanel(button.dataset.target);
    });
});

function normalizeText(value) {
    return value
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
}

function configureTableSearch({ inputId, tableSelector, emptySelector }) {
    const input = document.getElementById(inputId);
    const table = document.querySelector(tableSelector);
    const emptyState = document.querySelector(emptySelector);

    if (!input || !table) {
        return;
    }

    const rows = Array.from(table.querySelectorAll("tbody tr"));

    function applyFilter() {
        const searchValue = normalizeText(input.value.trim());
        let visibleRows = 0;

        rows.forEach((row) => {
            const rowText = normalizeText(row.textContent || "");
            const showRow = rowText.includes(searchValue);

            row.hidden = !showRow;

            if (showRow) {
                visibleRows += 1;
            }
        });

        if (emptyState) {
            emptyState.hidden = visibleRows !== 0;
        }
    }

    input.addEventListener("input", applyFilter);
    applyFilter();
}

configureTableSearch({
    inputId: "homeSearchInput",
    tableSelector: '[data-search-table="home"]',
    emptySelector: '[data-search-empty="home"]',
});

configureTableSearch({
    inputId: "listaSearchInput",
    tableSelector: '[data-search-table="lista"]',
    emptySelector: '[data-search-empty="lista"]',
});

if (logoutButton) {
    logoutButton.addEventListener("click", () => {
        const canExit = window.confirm("Deseja realmente sair do sistema?");
        if (canExit) {
            window.location.href = "about:blank";
        }
    });
}
