<template>
    <nav class="nav navbar">
        <router-link class="nav-link" to="/">我的桐人</router-link>
        <router-link class="nav-link" to="/user-list">玩家列表</router-link>
        <router-link class="nav-link" to="/boss">BOSS</router-link>
        <router-link class="nav-link" to="/achievements">成就</router-link>
        <router-link class="nav-link" to="/achievement-ranking">成就榜</router-link>
        <router-link class="nav-link" to="/hall-of-fame">名人堂</router-link>
        <router-link class="nav-link" to="/reincarnation">轉生</router-link>
        <router-link class="nav-link" to="/reports">戰報</router-link>
        <a class="nav-link final">
            <theme-switcher style="width: 28px" />
        </a>
    </nav>
</template>

<script>
import ThemeSwitcher from '@/assets/icons/theme-switcher.svg';

export default {
    name: 'Navbar',
    components: {
        ThemeSwitcher,
    },
};
</script>

<style scoped lang="scss">
@import '@/sass/_variables.scss';

nav.navbar {
    top: 0;
    z-index: 999;
    width: 100%;
    padding: 0 5%;
    background-color: $primary-bg-color;
    -webkit-box-align: center;
    align-items: center;
    box: {
        sizing: border-box;
        shadow: rgb(0 0 0 / 30%) 0 2px 4px;
    }

    a.nav-link {
        // background-color: $primary-bg-color;
        color: $primary-fg-color;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        height: $navbar-height;
        padding: 0 8px;
        transition: all 0.16s ease 0s;

        &.final {
            margin-left: auto;
            cursor: pointer;
        }

        &:hover {
            text-decoration: none;
        }

        &:not(.router-link-active) {
            &:hover {
                background-color: transparentize($primary-fg-color, 0.8);
            }
        }

        &.router-link-active {
            background-color: $primary-fg-color;
            color: $primary-bg-color;
        }
    }
}
</style>
