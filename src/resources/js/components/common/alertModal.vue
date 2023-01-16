<template>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center border-0">
                    <h1 class="modal-title" id="exampleModalLabel">{{ title }}</h1>
                </div>
                <div class="modal-body text-center border-0 p-0 mb-1" v-html="contentHtml"></div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-positive w-100" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AlertModal',
    data() {
        return {
            contentHtml: '',
        };
    },
    props: {
        title: {
            type: String,
            default: '出事了',
        },
        content: {
            type: Array,
            default: ['出事了阿伯'],
        },
    },
    watch: {
        content(n, o) {
            this.buildContentHtml();
        },
    },
    methods: {
        buildContentHtml() {
            let html = '';
            for (let i = 0; i < this.content.length; i++) {
                html += `<div class="my-3">${this.content[i]}</div>`;
            }
            this.contentHtml = html;
        },
    },
};
</script>

<style scoped lang="scss">
.modal-title {
    font-size: 1.1rem !important;
}
</style>
