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
        <a class="nav-link final"><theme-switcher style="width: 28px;" /></a>
    </nav>
</template>

<script>
    import ThemeSwitcher from '@/assets/icons/theme-switcher.svg';
    export default {
        name: "Navbar",
        components: {
            ThemeSwitcher,
        },
    };
</script>

<style scoped>

</style>
