window._ = require('lodash');

try {
    window.bootstrap = require('bootstrap');

    // require('datatables')
    window.simpleDatatables = require('simple-datatables')
    // chart.js ver 2.8.0
    require('chart.js/dist/Chart')
    // chart.js ver 3.5
    // require('chart.js')
    // require('startbootstrap-sb-admin-2/js/sb-admin-2')
    require('startbootstrap-sb-admin/src/js/scripts')

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
/*window.onload = function () {
    const userTable = document.getElementById('userTable');
    if (userTable) {
        new DataTable("#userTable", {
            searchable: true,
            fixedHeight: true,
        });
    }
}*/

window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const userTable = document.getElementById('userTable');
    if (userTable) {
        let userDataTable = new simpleDatatables.DataTable(userTable);
        userDataTable.on('datatable.perpage', function(perpage) {
            console.log('per page')
        });
        userDataTable.on('datatable.search', function(query, matched) {
            console.log('search')
        });
    }

    let detailModalEl = document.getElementById('detailModalId')

    let detailButtonCtlList = document.getElementsByClassName('detail-ctl')
    let detailButtonCtl = detailButtonCtlList.length > 0 ? detailButtonCtlList[0] : null;
    if (detailButtonCtl) {
        detailButtonCtl.addEventListener('click', function () {
            if (detailModalEl) {
                let detailModal = new bootstrap.Modal(detailModalEl)
                detailModal.show()
            }
            console.log(this.dataset)
            document.getElementById("log_id").value = this.dataset.logId
            let propertiesObjStr = this.dataset.logProperties
            let propertiesObj = JSON.parse(propertiesObjStr)
            console.log(propertiesObj)
            console.log(this.dataset.logId)
            if ('attributes' in propertiesObj) {
                document.getElementById("log_properties_attr").value = JSON.stringify(propertiesObj.attributes)
            } else {
                document.getElementById("log_properties_attr").value = ''
            }

            if ('old' in propertiesObj) {
                document.getElementById("log_properties_old").value = JSON.stringify(propertiesObj.old)
            } else {
                document.getElementById("log_properties_old").value = ''
            }
            document.getElementById("log_description").value = this.dataset.logDescription
            document.getElementById("log_created_at").value = this.dataset.logCreatedAt
            document.getElementById("log_updated_at").value = this.dataset.logUpdatedAt
        })
    }


});
