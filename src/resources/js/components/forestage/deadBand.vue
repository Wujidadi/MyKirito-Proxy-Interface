<template>
    <div class="dead-band text-center" :class="shallShow">你的角色死亡了，請進行轉生</div>
</template>

<script>
export default {
    name: 'DeadBand',
    computed: {
        shallShow() {
            return this.$parent.currentPlayerInfo.dead ? '' : 'hidden';
        },
    },
};
</script>

<style scoped lang="scss">
@import '@/sass/_variables.scss';

.dead-band {
    position: absolute;
    height: 40px;
    width: $max-content-width;
    top: 60px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    background-color: red;
    align-items: center;
    justify-content: center;

    &:not(.hidden) {
        display: flex;
    }
}
</style>
