import ApexCharts from "apexcharts";
import "./bootstrap";

import { ago, countdown } from "./lib/datet-time";

const onActiveResponsiveTable = () => {
    document.querySelectorAll(".responsive-table").forEach((table) => {
        const labels = Array.from(table.querySelectorAll("th")).map(
            (th) => th.innerText
        );
        table.querySelectorAll("td").forEach((td, index) => {
            td.setAttribute("data-label", labels[index % labels.length]);
        });
    });
};

const onNowDate = () => {
    document.querySelectorAll("div#date-ago").forEach((d) => {
        const now = d.hasAttribute("now") ? d.getAttribute("now") : new Date();
        d.innerHTML = ago(now);
    });
};

const onRemoveFlashMessage = () => {
    const flash = document.querySelector("#flash-message");
    if (flash) {
        window.setTimeout(() => flash.remove(), 4000);
    }
};

document.addEventListener("DOMContentLoaded", () => {
    onActiveResponsiveTable();
    onNowDate();
    onRemoveFlashMessage();
});

window.addEventListener("resize", () => {
    onActiveResponsiveTable();
    onNowDate();
    onRemoveFlashMessage();
});

/**
 * @param {Element} c
 */
const onReloadCountdown = (c) => {
    const diff = countdown(c.getAttribute("iso"));

    c.querySelector("#day").innerHTML = diff.days;
    c.querySelector("#hour").innerHTML = diff.hours;
    c.querySelector("#minute").innerHTML = diff.minutes;
    c.querySelector("#second").innerHTML = diff.seconds;
};

document.querySelectorAll("#countdown").forEach((c) => {
    window.setTimeout(() => onReloadCountdown(c), 1000);
});

const delibe = document.querySelector("#delibe");
if (delibe) {
    /*** @type {{okStudent: number, failStudent: number}} */
    const data = JSON.parse(delibe.dataset.delibe);

    new ApexCharts(delibe, {
        series: [data.okStudent, data.failStudent],
        chart: { type: "pie" },
        labels: ["Étudiants Réussis", "Étudiants Échoués"],
    }).render();
}
