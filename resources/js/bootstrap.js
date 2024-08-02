import Alpine from "alpinejs";
import axios from "axios";
import "bootstrap-icons/font/bootstrap-icons.min.css";
import Turbolinks from "turbolinks";

window.Alpine = Alpine;

Alpine.start();

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

Turbolinks.start();
