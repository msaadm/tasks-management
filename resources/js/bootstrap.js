import axios from 'axios';
import jQuery from 'jquery';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.jQuery = window.$ = jQuery;
