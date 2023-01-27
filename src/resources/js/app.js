import './bootstrap';

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

import vueStore from './store';
import vueRouter from './router';
import vueComponents from './components';

if (document.querySelector('#app')) {
    Vue.createApp({
        components: vueComponents,
        data() {
            return {
                players: {},
                currentPlayer: '',
                currentPlayerInfo: {},
                playerInfoDefaultValue: {
                    _id: '',
                    empty: false,
                    color: 'black',
                    dead: false,
                    nickname: '',
                    avatar: '',
                    character: '',
                    title: '',
                    actionCount: '', // Integer
                    challengeCount: '', // Integer
                    floor: '', // Integer
                    lv: '', // Integer
                    exp: '', // Integer
                    hp: '', // Integer
                    atk: '', // Integer
                    agi: '', // Integer
                    stm: '', // Integer
                    def: '', // Integer
                    spd: '', // Integer
                    tec: '', // Integer
                    int: '', // Integer
                    lck: '', // Integer
                    rattrs: {
                        hp: '', // Integer
                        atk: '', // Integer
                        def: '', // Integer
                        stm: '', // Integer
                        agi: '', // Integer
                        spd: '', // Integer
                        tec: '', // Integer
                        int: '', // Integer
                        lck: '', // Integer
                    },
                    murder: '', // Integer
                    reincarnation: '', // Integer
                    reset: '', // Integer
                    resurrect: '', // Integer
                    kill: '', // Integer
                    totalKill: '', // Integer
                    defKill: '', // Integer
                    totalDefKill: '', // Integer
                    defDeath: '', // Integer
                    totalDeath: '', // Integer
                    win: '', // Integer
                    lose: '', // Integer
                    totalWin: '', // Integer
                    totalLose: '', // Integer
                    achievementPoints: '', // Integer
                    lastAction: null,
                    lastChallenge: null,
                    lastFloorBonus: null,
                    lastBossChallenge: null,
                    lastStatus: null,
                    cleared: null,
                    fragment: null, // String
                    status: '',
                    teammate: '',
                    teammateUID: false,
                },
                threshold: [
                    0, 0, 30, 60, 100, 150, 200, 250, 300, 370, 450, 500, 650, 800, 950, 1200, 1450, 1700, 1950, 2200,
                    2500, 2800, 3100, 3400, 3700, 4000, 4400, 4800, 5200, 5600, 6000, 6500, 7000, 7500, 8000, 8500,
                    9100, 9700, 10300, 11000, 11800, 12600, 13500, 14400, 15300, 16200, 17100, 18000, 19000, 20000,
                    21000, 23000, 25000, 27000, 29000, 31000, 33000, 35000, 37000, 39000, 41000, 44000, 47000, 50000,
                    53000, 56000, 59000, 62000, 65000, 68000, 71000,
                ],
                fragment: {
                    xiaoChief: '麻痺吹箭',
                    theChaosDrake: '飛上天盤旋',
                    illfang3: '浮舟',
                    godOfChain: '鎖鏈之神',
                    duet: '老人追加攻擊',
                    gorillaKing: '猩爆鐵拳',
                    legend: '傳奇:戲法空間',
                    finaleDrummer: '雷鼓',
                    animals: '雞啼',
                    terroristBob: '鮑勃地雷',
                    austonAndAlice: '以愛麗絲為盾',
                    frenzyBoar: '	豬叫',
                },
            };
        },
        methods: {
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
                    method: 'get',
                    url: 'https://mykirito.com/api/my-kirito',
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
                this.currentPlayerInfo = JSON.parse(JSON.stringify(this.playerInfoDefaultValue));
            },
            setPlayerInfo(data) {
                for (let p in this.playerInfoDefaultValue) {
                    if (data[p] !== undefined && data[p] !== null) {
                        this.currentPlayerInfo[p] = data[p];
                    } else {
                        this.currentPlayerInfo[p] = this.playerInfoDefaultValue[p];
                    }
                }
            },
        },
        watch: {
            currentPlayer(n, o) {
                if (n !== o) {
                    this.getPlayerInfo();
                    localStorage.setItem('CurrentPlayer', n);
                }
            },
        },
        created() {
            this.initCurrentPlayer();
        },
        mounted() {
            this.parsePlayers();
            this.setCurrentPlayer();
        },
    })
        .use(vueStore)
        .use(vueRouter)
        .mount('#app');
}
