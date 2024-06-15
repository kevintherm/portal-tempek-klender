import axios from 'axios';
import collapse from '@alpinejs/collapse'
import 'suneditor/dist/css/suneditor.min.css'
import suneditor from 'suneditor'
import plugins from 'suneditor/src/plugins'

window.suneditor = suneditor;
window.plugins = plugins;

window.axios = axios;
Alpine.plugin(collapse)
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
