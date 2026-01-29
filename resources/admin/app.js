import {createApp} from 'vue'
import {createRouter, createWebHashHistory} from 'vue-router';
import { routes } from './routes';
import DashboardApplication from "./Application.vue";
import Rest from './Bits/Rest.js';
import {ElNotification, ElLoading, ElMessageBox} from 'element-plus'
import Storage from '@/Bits/Storage';

function convertToText(obj) {
    const string = [];
    if (typeof (obj) === 'object' && (obj.join === undefined)) {
        for (const prop in obj) {
            string.push(convertToText(obj[prop]));
        }
    } else if (typeof (obj) === 'object' && !(obj.join === undefined)) {
        for (const prop in obj) {
            string.push(convertToText(obj[prop]));
        }
    } else if (typeof (obj) === 'function') {

    } else if (typeof (obj) === 'string') {
        string.push(obj)
    }

    return string.join('<br />')
}

const app = createApp(DashboardApplication);

app.config.globalProperties.appVars = window.fluentFrameworkAdmin;

app.mixin({
    data() {
        return {
            Storage
        }
    },
    methods: {
        $get: Rest.get,
        $post: Rest.post,
        $put: Rest.put,
        $del: Rest.delete,
        formatNumber(amount, hideEmpty = false) {
            if (!amount && hideEmpty) {
                return '';
            }

            if (!amount) {
                amount = '0';
            }

            return new Intl.NumberFormat('en-US').format(amount)
        },
        $changeTitle(title) {
            jQuery('head title').text(title + ' - FluentCart');
        },
        $handleError(response) {
            let errorMessage = '';
            if (typeof response === 'string') {
                errorMessage = response;
            } else if (response && response.message) {
                errorMessage = response.message;
            } else {
                errorMessage = convertToText(response);
            }
            if (!errorMessage) {
                errorMessage = 'Something is wrong!';
            }
            this.$notify({
                type: 'error',
                title: 'Error',
                message: errorMessage,
                dangerouslyUseHTMLString: true
            });
        }
    }
});

app.config.globalProperties.$notify = ElNotification;
app.config.globalProperties.$confirm = ElMessageBox.confirm;

const router = createRouter({
    routes,
    history: createWebHashHistory()
});

app.use(router);
app.use(ElLoading);

app.mount('#fluent-framework-app');

router.afterEach((to, from) => {
    const activeMenu = to.meta.active_menu;
    jQuery('.fframe_menu li').removeClass('active_item');
    jQuery('.fframe_menu li.fframe_item_' + activeMenu).addClass('active_item');

    jQuery('.toplevel_page_fluent_frame li').removeClass('current'); // change fluent_frame with your plugin slug
    jQuery('.toplevel_page_fluent_frame li.fluent_frame_' + activeMenu).addClass('current'); // change fluent_frame with your plugin slug

    if(to.meta.title) {
        jQuery('head title').text(to.meta.title + ' - Fluent Framework'); // Change it with your app name
    }

});
