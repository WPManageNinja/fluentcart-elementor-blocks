<template>
    <div class="fl_app">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'DashboardApplication',
        mounted() {
            jQuery('.notice-warning, .notice-error').remove();
        }
    };
</script>
