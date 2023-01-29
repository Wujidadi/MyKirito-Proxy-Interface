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
                api: apiList,
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
                teammateHtml: '',
                achivements: [],
                coolDown: {
                    floorBonus: 14400000, // 4 hours
                    action: 66000, // 66 seconds
                },
                timeRemain: {
                    floorBonus: 0,
                    action: 0,
                },
                interval: {
                    floorBonus: 0,
                    action: 1,
                },
                refreshInterval: 1000,
                isSwitchingPlayer: false,
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
            tooltip() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new Bootstrap.Tooltip(tooltipTriggerEl);
                });
            },
            getAvatarUrl(avatar) {
                return `/images/avatars/${avatar}.webp`;
            },
            getAvatarAlt(character, title) {
                return `${character}（${title}）`;
            },
            buildTeammateHtml() {
                const baseUrl = MyDefs.myKiritoUrl.base;
                const uid = this.currentPlayerInfo.teammateUID;
                const teammate = this.currentPlayerInfo.teammate;
                if (uid) {
                    this.teammateHtml = `隊伍狀態：<a class="teammate" target="_blank" href="${baseUrl}/profile/${uid}">${teammate}</a>`;
                    return;
                }
                this.teammateHtml = '隊伍狀態：無';
            },
            checkApiResponseData(response) {
                return response.data.data && response.data.data[0];
            },
            checkApiResponseError(response) {
                return response.data.error && response.data.error.code && response.data.error.code === '0.0';
            },
            getErrorMessage(response) {
                console.warn(response);
                if (response.data.data[0].error) {
                    return response.data.data[0].error;
                } else if (response.data.error) {
                    if (response.data.error.message) {
                        if (response.data.error.message === 'Proxy API OK') {
                            if (Math.floor(response.data.status / 100) === 5) {
                                return '我桐官方伺服器或網路錯誤';
                            }
                        }
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
                this.isSwitchingPlayer = true;
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
                    })
                    .finally(() => {
                        setTimeout(() => {
                            this.isSwitchingPlayer = false;
                        }, this.refreshInterval);
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
                this.buildTeammateHtml();
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
            countActionCoolDown() {
                this.interval.action = setInterval(() => {
                    const now = new Date();
                    this.timeRemain.action = this.currentPlayerInfo.lastAction + this.coolDown.action - now.getTime();
                    // console.log(this.timeRemain.action);
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
            this.countActionCoolDown();
        },
    })
        .use(vueStore)
        .use(vueRouter)
        .mount('#app');
}
