import { createApp } from 'vue';

import {
    ElMenu,
    ElMenuItem,
    ElMain,
    ElRow,
    ElCol,
    ElTable,
    ElTableColumn,
    ElPagination,
    ElButtonGroup,
    ElButton,
    ElIcon,
    ElBreadcrumb,
    ElBreadcrumbItem,
    ElForm,
    ElFormItem,
    ElColorPicker,
    ElInput,
    ElInputNumber,
    ElOption,
    ElOptionGroup,
    ElRadio,
    ElRadioButton,
    ElRadioGroup,
    ElRate,
    ElSelect,
    ElSelectV2,
    ElCheckbox,
    ElCheckboxGroup,

    ElSlider,
    ElSwitch,
    ElTimePicker,
    ElDatePicker,
    ElTimeSelect,
    ElDialog,
    ElSkeleton,
    ElUpload,
    ElTooltip,

    ElTabs,
    ElTabPane,

    ElPopover,
    ElPopconfirm,
    ElDropdown,
    ElDropdownMenu,
    ElDropdownItem,

    ElTag,

    ElLoading,
    ElMessage,
    ElMessageBox,
    ElNotification
} from 'element-plus';

const app = createApp({});

const components = [
    // ElMenu,
    // ElMenuItem,
    // ElMain,
    // ElRow,
    // ElCol,
    // ElTable,
    // ElTableColumn,
    // ElPagination,
    // ElButtonGroup,
    // ElButton,
    // ElIcon,
    // ElBreadcrumb,
    // ElBreadcrumbItem,
    // ElForm,
    // ElFormItem,
    // ElColorPicker,
    // ElInput,
    // ElInputNumber,
    // ElOption,
    // ElOptionGroup,
    // ElRadio,
    // ElRadioButton,
    // ElRadioGroup,
    // ElRate,
    // ElSelect,
    // ElSlider,
    // ElSwitch,
    // ElTimePicker,
    // ElUpload,
    // ElTimeSelect,
    // ElDialog,
    // ElPopover,
    // ElSkeleton,
    // ElTabs,
    // ElTabPane,
    // ElTooltip,
    // ElCheckbox,
    // ElCheckboxGroup,
    // ElPopconfirm,
    // ElDropdown,
    // ElDropdownMenu,
    // ElDropdownItem,
    // ElDatePicker,
    // ElTag,
    // ElSelectV2
];

components.forEach(component => {
    app.component(component.name, component)
})

const plugins = [
    // ElLoading,
    // ElMessage,
    // ElMessageBox,
    // ElNotification
];

plugins.forEach(plugin => {
    app.use(plugin)
});

export default app;
