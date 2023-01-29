<template>
    <div class="page">
        <div class="content">
            <div class="field" id="achievement">
                <h3 class="title">已取得成就</h3>
                <div v-if="$root.achivements.length > 0">目前總點數：{{ $root.currentPlayerInfo.achivements }} 點</div>
                <table class="info-table mt-3">
                    <caption>玩家個人成就列表</caption>
                    <tbody>
                        <tr>
                            <th class="text-center" style="width: 50px">#</th>
                            <th class="text-center">名稱</th>
                            <th class="text-center" style="width: 72px">點數</th>
                        </tr>
                        <tr v-for="(achivement, index) in $root.achivements" :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td>{{ achivement.name }}</td>
                            <td class="text-center">{{ achivement.point }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AchievementsPage',
    props: {
        player: String,
        playerInfo: Object,
    },
    methods: {
        getAchievements() {
            axios({
                method: this.$root.api.myKiritoApi.getAchievements.method,
                url: `${this.$root.api.myKiritoApi.getAchievements.url}?player=${this.$root.currentPlayer}`,
                headers: {
                    authorization: `Bearer ${localStorage.getItem('Token')}`,
                },
            })
                .then(response => {
                    if (response.data && this.$root.checkApiResponseData(response) && this.$root.checkApiResponseError(response)) {
                        const rawData = response.data.data[0];
                        this.$root.currentPlayerInfo.achivements = rawData.sum;
                        this.$root.achivements = rawData.list;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    watch: {
        player(n, o) {
            if (n !== o) {
                this.getAchievements();
            }
        },
    },
    mounted() {
        this.getAchievements();
    },
};
</script>

<style scoped lang="scss">
@import '@/sass/_variables.scss';
@import '@/sass/_dark.scss';
@import '@/sass/_light.scss';

th {
    background-color: var(--th-bg-color);
}
</style>
