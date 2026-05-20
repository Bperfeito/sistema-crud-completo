const searchInput = document.getElementById("clientesSearchInput");
const table = document.querySelector('[data-search-table="clientes"]');
const emptyState = document.getElementById("clientesSearchEmpty");

function normalizeText(value) {
    return value
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
}

if (searchInput && table) {
    const rows = Array.from(table.querySelectorAll("tbody tr"));

    function applyFilter() {
        const searchValue = normalizeText(searchInput.value.trim());
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

    searchInput.addEventListener("input", applyFilter);
    applyFilter();
}
