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
        <select class="nav-link ms-2 ps-2" v-model="$parent.currentPlayer">
            <option v-for="(playerName, playerIndex) in Object.keys($parent.players)" :value="playerName" :key="playerIndex">
                {{ playerName }}
            </option>
        </select>
        <a class="nav-link final" @click="toggleTheme">
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
    methods: {
        toggleTheme() {
            let theme = document.querySelector('body').className;
            if (theme === 'dark') {
                document.querySelector('html').dataset.bsTheme = 'light';
                document.querySelector('body').className = 'light';
            } else {
                document.querySelector('html').dataset.bsTheme = 'dark';
                document.querySelector('body').className = 'dark';
            }
        },
    },
    watch: {
        player(n, o) {
            this.$parent.currentPlayer = n;
            this.$parent.getPlayerInfo();
        },
    },
};
</script>

<style scoped lang="scss">
@import '@/sass/_variables.scss';

nav.navbar {
    position: fixed;
    top: 0;
    z-index: 999;
    width: 100%;
    padding: 0 5%;
    background-color: var(--primary-bg-color);
    -webkit-box-align: center;
    align-items: center;
    box: {
        sizing: border-box;
        shadow: rgb(0 0 0 / 30%) 0 2px 4px;
    }

    a.nav-link {
        color: var(--primary-fg-color);
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
                background-color: rgba(var(--primary-fg-color-r), var(--primary-fg-color-g), var(--primary-fg-color-b), 0.2);
            }
        }

        &.router-link-active {
            background-color: var(--primary-fg-color);
            color: var(--primary-bg-color);
        }
    }

    select.nav-link {
        color: var(--primary-bg-color);
    }
}
</style>
