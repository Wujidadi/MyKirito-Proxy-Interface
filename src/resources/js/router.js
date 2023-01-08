import './bootstrap';

import PlayerInfoPage from '@/js/components/forestage/playerInfoPage.vue';
import UserListPage from "./components/forestage/userListPage.vue";
import BossPage from '@/js/components/forestage/bossPage.vue';
import AchievementsPage from '@/js/components/forestage/achievementsPage.vue';
import AchievementRankingPage from '@/js/components/forestage/achievementRankingPage.vue';
import HallOfFamePage from '@/js/components/forestage/hallOfFamePage.vue';
import ReincarnationPage from '@/js/components/forestage/reincarnationPage.vue';
import ReportsPage from '@/js/components/forestage/reportsPage.vue';

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        {
            path: '/',
            component: PlayerInfoPage,
        },
        {
            path: '/user-list',
            component: UserListPage,
        },
        {
            path: '/boss',
            component: BossPage,
        },
        {
            path: '/achievements',
            component: AchievementsPage,
        },
        {
            path: '/achievement-ranking',
            component: AchievementRankingPage,
        },
        {
            path: '/hall-of-fame',
            component: HallOfFamePage,
        },
        {
            path: '/reincarnation',
            component: ReincarnationPage,
        },
        {
            path: '/reports',
            component: ReportsPage,
        },
    ],
});

export default router;
