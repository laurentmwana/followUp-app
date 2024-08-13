import Alpine from "alpinejs";
import ApexCharts from "apexcharts";
import axios from "axios";
import "bootstrap-icons/font/bootstrap-icons.min.css";
import Turbolinks from "turbolinks";
import { ago } from "./lib/datet-time";

window.Alpine = Alpine;

Alpine.start();

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

Turbolinks.start();

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

const onPieChart = () => {
    const delibe = document.querySelector("#piechart");
    if (delibe) {
        /*** @type {{okStudent: number, failStudent: number}} */
        const data = JSON.parse(delibe.dataset.piechart);

        new ApexCharts(delibe, {
            series: [data.okStudent, data.failStudent],
            chart: { type: "pie" },
            labels: ["Étudiants Réussis", "Étudiants Échoués"],
        }).render();
    }
};

const init = () => {
    onActiveResponsiveTable();
    onNowDate();
    onRemoveFlashMessage();
    onPieChart();
};

document.addEventListener("DOMContentLoaded", init);

// window.addEventListener("resize", init);
