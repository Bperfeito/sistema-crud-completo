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

if (logoutButton) {
    logoutButton.addEventListener("click", () => {
        const canExit = window.confirm("Deseja realmente sair do sistema?");
        if (canExit) {
            window.location.href = "about:blank";
        }
    });
}
