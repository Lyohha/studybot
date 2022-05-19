<template>
    <div class="overflow">
        <table class="table table-hover overflow">
            <tbody>
                <tr v-for="(item, index) in items" :key="index">
                    <td>{{ item }}</td>
                    <td class="text-right">
                        <div class="btn-group">
                            <button v-if="modelValue.indexOf(index) == -1" class="btn-primary btn btn-xs" @click.prevent="onActiveClick(index)">Select</button>
                            <button v-else class="btn-success btn btn-xs" @click.prevent="onDeactivateClick(index)">Selected</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    methods: {
        onActiveClick(value) {
            this.modelValue.push(value);
            this.$emit('update:modelValue', this.modelValue);
        },
        onDeactivateClick(value) {
            this.modelValue.splice(this.modelValue.indexOf(value), 1);
            this.$emit('update:modelValue', this.modelValue);
        },
    },
    props: ['items', 'modelValue'],
    emites: ['update:modelValue'],
}
</script>

<style>
    .overflow {
        overflow-y:auto;
        max-height: 200px;
    }
</style>
