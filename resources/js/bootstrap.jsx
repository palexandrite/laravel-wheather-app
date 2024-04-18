import { createRoot } from "react-dom/client";
import axios from 'axios';

import Root from "./Root";

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const root = createRoot(document.getElementById("app"));
root.render(<Root />);
