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
            checkApiResponseData(response) {
                return response.data.data && response.data.data[0];
            },
            checkApiResponseError(response) {
                return response.data.error && response.data.error.code && response.data.error.code === '0.0';
            },
            getErrorMessage(response) {
                if (response.data.data[0].error) {
                    return response.data.data[0].error;
                } else if (response.data.error) {
                    if (response.data.error.message) {
                        return response.data.error.message;
                    }
                    return response.data.error;
                }
                return '未知錯誤';
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
                    url: `${this.api.myKiritoApi.personalInfo.url}?player=${this.currentPlayer}`,
                    headers: {
                        authorization: `Bearer ${localStorage.getItem('Token')}`,
                    },
                })
                    .then(response => {
                        if (response.data && this.checkApiResponseData(response) && this.checkApiResponseError(response)) {
                            this.setPlayerInfo(response.data.data[0]);
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
