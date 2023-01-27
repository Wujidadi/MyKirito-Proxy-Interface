import './bootstrap';

import PlayerInfoPage from '@/js/components/forestage/playerInfoPage.vue';
import UserListPage from '@/js/components/forestage/userListPage.vue';
import BossPage from '@/js/components/forestage/bossPage.vue';
import AchievementsPage from '@/js/components/forestage/achievementsPage.vue';
import AchievementRankingPage from '@/js/components/forestage/achievementRankingPage.vue';
import HallOfFamePage from '@/js/components/forestage/hallOfFamePage.vue';
import ReincarnationPage from '@/js/components/forestage/reincarnationPage.vue';
import ReportsPage from '@/js/components/forestage/reportsPage.vue';
import LoginPage from '@/js/components/forestage/loginPage.vue';
import RegisterPage from '@/js/components/forestage/registerPage.vue';

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'PlayerInfo',
            component: PlayerInfoPage,
            meta: {
                requiresAuth: true,
                title: '',
            },
        },
        {
            path: '/user-list',
            name: 'UserList',
            component: UserListPage,
            meta: {
                requiresAuth: true,
                title: '玩家列表',
            },
        },
        {
            path: '/boss',
            name: 'Boss',
            component: BossPage,
            meta: {
                requiresAuth: true,
                title: 'BOSS',
            },
        },
        {
            path: '/achievements',
            name: 'Achievements',
            component: AchievementsPage,
            meta: {
                requiresAuth: true,
                title: '成就',
            },
        },
        {
            path: '/achievement-ranking',
            name: 'AchievementRanking',
            component: AchievementRankingPage,
            meta: {
                requiresAuth: true,
                title: '成就榜',
            },
        },
        {
            path: '/hall-of-fame',
            name: 'HallOfFame',
            component: HallOfFamePage,
            meta: {
                requiresAuth: true,
                title: '名人堂',
            },
        },
        {
            path: '/reincarnation',
            name: 'Reincarnation',
            component: ReincarnationPage,
            meta: {
                requiresAuth: true,
                title: '轉生',
            },
        },
        {
            path: '/reports',
            name: 'Reports',
            component: ReportsPage,
            meta: {
                requiresAuth: true,
                title: '戰報',
            },
        },
        {
            path: '/login',
            name: 'Login',
            component: LoginPage,
            meta: {
                requiresAuth: false,
                title: '登入',
            },
        },
        {
            path: '/register',
            name: 'Register',
            component: RegisterPage,
            meta: {
                requiresAuth: false,
                title: '使用者註冊',
            },
        },
    ],
});

router.beforeEach(async (to, from) => {
    rememberFrom(from, to);
    let isAuthenticated = await MyFuncs.auth();
    if (to.meta.requiresAuth && !isAuthenticated && to.name !== 'Login') {
        return {
            name: 'Login',
        };
    }
    MyFuncs.changeTitle(to);
});

const rememberFrom = function (from, to) {
    if (typeof from.name !== 'undefined' && from.name !== 'Login' && from.name !== to.name) {
        localStorage.setItem('From', from.path);
    }
};

export default router;
