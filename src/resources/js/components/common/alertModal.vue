<template>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center border-0">
                    <h1 class="modal-title" id="exampleModalLabel">{{ title }}</h1>
                </div>
                <div class="modal-body text-center border-0 mb-3">
                    {{ content }}
                </div>
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
    props: {
        title: {
            type: String,
            default: '出事了',
        },
        content: {
            type: String,
            default: '出事了阿伯',
        },
    },
};
</script>

<style scoped lang="scss">
.modal-title {
    font-size: 1.1rem !important;
}
</style>
