<template>
    <div class="dashboard box_wrapper">
        <div class="box dashboard_box box_narrow">
            <div class="box_header" style="padding: 35px;font-size: 16px;background: white;max-width: 600px;margin: 0 auto;">
                Hello {{ me.full_name }}!
                <p>You can replace this module from <code>/resources/admin/Components/Dashboard.vue</code></p>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        name: 'Dashboard',
        data() {
            return {
                me: this.appVars.me,
            }
        },
        methods: {
            get() {
                this.$get('demo-users').then(r => console.log(r));
            }
        },
        mounted() {
            this.get();
        }
    };
</script>
