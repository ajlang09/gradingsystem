window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


// try {
window.$ = window.jQuery = require('jquery');
window.Moment   = window.moment = require('moment');
window.swal     = window.Swal = require('sweetalert2')
// window.Vue      = require('vue');
window.alertify = require('alertifyjs');
// require('daterangepicker');
// require('magnific-popup')
// window.Popper = require('popper.js').default;

require('bootstrap');

// } catch (e) {
//     console.log(e)
// }

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.csrfToken = document.querySelector('meta[name="csrf_token"]').content
window.apiUrl    = document.querySelector('meta[name="url"]').content



/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

