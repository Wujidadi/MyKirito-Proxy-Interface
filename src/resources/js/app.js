import './bootstrap';

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

import vueStore from './store';
import vueRouter from './router';
import vueComponents from './components';

import defaultPlayerInfo from './data/defaultPlayerInfo';
import levelThresholds from './data/levelThresholds';
import fragments from './data/fragments';
import apiList from './data/apiList';

if (document.querySelector('#app')) {
    Vue.createApp({
        components: vueComponents,
        data() {
            return {
                players: {},
                currentPlayer: '',
                currentPlayerInfo: {},
                appendCurrentPlayerInfo: {
                    teammateNickname: '',
                },
                alertModal: null,
                alertMessage: {
                    title: '警告',
                    content: ['錯誤'],
                },
                threshold: levelThresholds,
                fragment: fragments,
                api: apiList,
                coolDown: {
                    floorBonus: 14400000, // 4 hours
                },
                timeRemain: {
                    floorBonus: 0,
                },
                interval: {
                    floorBonus: 0,
                },
                refreshInterval: 1000,
            };
        },
        methods: {
            alert(title = '警告', content = ['錯誤']) {
                if (typeof content === 'string') {
                    content = [content];
                }
                this.alertMessage.title = title;
                this.alertMessage.content = content;
                this.alertModal.show();
            },
            parsePlayers() {
                const playerTokens = JSON.parse(localStorage.getItem('PlayerTokens'));
                if (playerTokens && playerTokens instanceof Object) {
                    this.players = playerTokens;
                }
            },
            setCurrentPlayer() {
                this.currentPlayer = localStorage.getItem('CurrentPlayer') || '';
            },
            getPlayerInfo() {
                axios({
                    method: this.api.myKiritoApi.personalInfo.method,
                    url: this.api.myKiritoApi.personalInfo.url,
                    headers: {
                        token: this.players[this.currentPlayer].token,
                    },
                })
                    .then(response => {
                        if (response.data) {
                            this.setPlayerInfo(response.data);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            initCurrentPlayer() {
                this.currentPlayerInfo = JSON.parse(JSON.stringify(defaultPlayerInfo));
                this.appendPlayerInfo({
                    teammateNickname: this.currentPlayerInfo.teammate,
                });
            },
            setPlayerInfo(data) {
                for (let p in defaultPlayerInfo) {
                    if (data[p] !== undefined && data[p] !== null) {
                        this.currentPlayerInfo[p] = data[p];
                    } else {
                        this.currentPlayerInfo[p] = defaultPlayerInfo[p];
                    }
                }
                this.appendPlayerInfo({
                    teammateNickname: data.teammate,
                });
            },
            appendPlayerInfo(data) {
                for (let p in this.appendCurrentPlayerInfo) {
                    if (data[p] !== undefined && data[p] !== null) {
                        this.currentPlayerInfo[p] = data[p];
                    } else {
                        this.currentPlayerInfo[p] = this.appendCurrentPlayerInfo[p];
                    }
                }
            },
            initAlertModal() {
                this.alertModal = new Bootstrap.Modal(document.querySelector('#alertModal'), {
                    backdrop: 'static',
                    keyboard: false,
                });
            },
            countFloorBonusCoolDown() {
                this.interval.floorBonus = setInterval(() => {
                    const now = new Date();
                    this.timeRemain.floorBonus = this.currentPlayerInfo.lastFloorBonus + this.coolDown.floorBonus - now.getTime();
                    // console.log(this.timeRemain.floorBonus);
                }, this.refreshInterval);
            },
        },
        watch: {
            async currentPlayer(n, o) {
                if (n !== o) {
                    if (!(await MyFuncs.auth())) {
                        return;
                    }
                    this.getPlayerInfo();
                    localStorage.setItem('CurrentPlayer', n);
                }
            },
        },
        created() {
            this.initCurrentPlayer();
        },
        mounted() {
            this.initAlertModal();
            this.parsePlayers();
            this.setCurrentPlayer();
            this.countFloorBonusCoolDown();
        },
    })
        .use(vueStore)
        .use(vueRouter)
        .mount('#app');
}
