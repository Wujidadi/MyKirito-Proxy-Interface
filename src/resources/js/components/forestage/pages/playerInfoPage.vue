<template>
    <div class="page">
        <div class="content">
            <div class="field" id="playerInfo">
                <h3 class="title">我的桐人</h3>
                <table class="info-table">
                    <caption>我的桐人玩家個人基本資料</caption>
                    <tbody>
                        <tr class="beside-avatar">
                            <th class="head-1" scope="col">暱稱</th>
                            <td class="content-1" :class="colorName">{{ $root.currentPlayerInfo.nickname }}</td>
                            <td class="avatar text-center" colspan="2" rowspan="4">
                                <img class="personal-info-avatar" src="/images/avatars/godRecon.webp" alt="God Recon" />
                            </td>
                        </tr>
                        <tr class="beside-avatar">
                            <th class="head-1" scope="col">角色</th>
                            <td class="content-1">{{ $root.currentPlayerInfo.character }}</td>
                        </tr>
                        <tr class="beside-avatar">
                            <th class="head-1" scope="col">稱號</th>
                            <td class="content-1">{{ $root.currentPlayerInfo.title }}</td>
                        </tr>
                        <tr class="beside-avatar">
                            <th class="head-1" scope="col">樓層</th>
                            <td class="content-1 floor">{{ $root.currentPlayerInfo.floor }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">等級</th>
                            <td class="content-1">{{ $root.currentPlayerInfo.lv }}</td>
                            <th class="head-2" scope="col">經驗值</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.exp }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">HP</th>
                            <td class="content-1" v-html="buildAttrHtml('hp')"></td>
                            <th class="head-2" scope="col">主動擊殺</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.kill }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">攻擊</th>
                            <td class="content-1" v-html="buildAttrHtml('atk')"></td>
                            <th class="head-2" scope="col">防衛擊殺</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.defKill }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">防禦</th>
                            <td class="content-1" v-html="buildAttrHtml('def')"></td>
                            <th class="head-2" scope="col">總主動擊殺</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.totalKill }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">體力</th>
                            <td class="content-1" v-html="buildAttrHtml('stm')"></td>
                            <th class="head-2" scope="col">總防衛擊殺</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.totalDefKill }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">敏捷</th>
                            <td class="content-1" v-html="buildAttrHtml('agi')"></td>
                            <th class="head-2" scope="col">遭襲死亡</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.defDeath }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">反應速度</th>
                            <td class="content-1" v-html="buildAttrHtml('spd')"></td>
                            <th class="head-2" scope="col">遭反殺死亡</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.totalDeath }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">技巧</th>
                            <td class="content-1" v-html="buildAttrHtml('tec')"></td>
                            <th class="head-2" scope="col">勝場</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.win }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">智力</th>
                            <td class="content-1" v-html="buildAttrHtml('int')"></td>
                            <th class="head-2" scope="col">敗場</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.lose }}</td>
                        </tr>
                        <tr>
                            <th class="head-1 ability" scope="col">幸運</th>
                            <td class="content-1" v-html="buildAttrHtml('lck')"></td>
                            <th class="head-2" scope="col">總勝場</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.totalWin }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">行動總次數</th>
                            <td class="content-1">{{ $root.currentPlayerInfo.actionCount }}</td>
                            <th class="head-2" scope="col">總敗場</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.totalLose }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">轉生次數</th>
                            <td class="content-1">{{ $root.currentPlayerInfo.reincarnation }}</td>
                            <th class="head-2" scope="col">挑戰總次數</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.challengeCount }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">玻璃值</th>
                            <td class="content-1 murder">{{ $root.currentPlayerInfo.murder }}</td>
                            <th class="head-2" scope="col">洗白點數</th>
                            <td class="content-2 reset">{{ $root.currentPlayerInfo.reset }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">保護狀態</th>
                            <td class="content-1 protection">{{ protection }}</td>
                            <th class="head-2" scope="col">距離升級</th>
                            <td class="content-2 to-next-level">{{ toNextLevel }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">成就點數</th>
                            <td class="content-1 achievement">{{ $root.currentPlayerInfo.achievementPoints }}</td>
                            <th class="head-2" scope="col">記憶碎片</th>
                            <td class="content-2 fragment">
                                {{ $root.fragment[this.$root.currentPlayerInfo.fragment] }}
                            </td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">上次行動</th>
                            <td class="content-1 last-time">{{ parseTime('lastAction') }}</td>
                            <th class="head-2" scope="col">上次挑戰</th>
                            <td class="content-2 last-time">{{ parseTime('lastChallenge') }}</td>
                        </tr>
                        <tr>
                            <th class="head-2" scope="col">上次領樓層</th>
                            <td class="content-2 last-time">{{ parseTime('lastFloorBonus') }}</td>
                            <th class="head-1" scope="col">上次爬塔</th>
                            <td class="content-1 last-time">{{ parseTime('lastBossChallenge') }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">上次改狀態</th>
                            <td class="content-1 last-time">{{ parseTime('lastStatus') }}</td>
                            <th class="head-2" scope="col">通過100層</th>
                            <td class="content-2 last-time">{{ parseTime('cleared') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="field" id="settings">
                <h3 class="title">設定</h3>
                <table class="table table-borderless mb-0">
                    <caption>玩家狀態及隊友設定</caption>
                    <tbody>
                        <tr>
                            <td class="form-label align-middle">個人狀態</td>
                            <td class="form-body align-middle">
                                <input class="form-control" type="text" v-model="$root.currentPlayerInfo.status" />
                            </td>
                            <td class="form-button align-middle text-end">
                                <button type="button" class="btn btn-negative w-100" @click="updateStatus">更新</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label align-middle">隊友暱稱</td>
                            <td class="form-body align-middle">
                                <input class="form-control" type="text" v-model="$root.currentPlayerInfo.teammateNickname" />
                            </td>
                            <td class="form-button align-middle text-end">
                                <button type="button" class="btn btn-negative w-100" @click="setTeammate">設定</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" v-html="teammateHtml"></td>
                        </tr>
                        <tr>
                            <td colspan="3">對方也必須輸入你的暱稱，並且與你在相同的樓層。當雙方互相設定且同層數時隊伍將自動成立。隊伍僅於挑戰Boss時作用，只要有任一人挑戰Boss就會自動一起上陣</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="field" id="floorBonus">
                <h3 class="title">樓層獎勵</h3>
                <table class="table table-borderless mb-0">
                    <caption>領取樓層獎勵</caption>
                    <tbody>
                        <tr>
                            <td v-html="floorBonusHintHtml"></td>
                        </tr>
                        <tr>
                            <button type="button" class="btn btn-negative action mt-2 px-3" :disabled="isDisabled('floorBonus')" @click="getFloorBonus">領取獎勵</button>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="field" id="actions">
                <h3 class="title">行動</h3>
                <table class="table table-borderless mb-0">
                    <caption>行動（練功）</caption>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-negative action mt-2 me-2 px-3" @click="huntRabbit">狩獵兔肉</button>
                                <button type="button" class="btn btn-negative action mt-2 me-2 px-3" @click="selfTraining">自主訓練</button>
                                <button type="button" class="btn btn-negative action mt-2 me-2 px-3" @click="goPicnic">外出野餐</button>
                                <button type="button" class="btn btn-negative action mt-2 me-2 px-3" @click="chaseGirl">汁妹</button>
                                <button type="button" class="btn btn-negative action mt-2 me-2 px-3" @click="doGood">做善事</button>
                                <button type="button" class="btn btn-negative action mt-2 me-2 px-3" @click="sitRest">坐下休息</button>
                                <button type="button" class="btn btn-negative action mt-2 px-3" @click="goFishing">釣魚</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="pt-3">修行高CD但可一次獲得較多經驗（與一般行動共用CD），請注意死亡或轉生後CD仍會持續，主要提供給沒時間一直玩的人使用。不定期抓腳本、自動點擊及按鍵精靈，抓到將受永久性懲罰或直接封鎖帳號。</td>
                        </tr>
                        <tr>
                            <td class="pt-3">目前修行功能需攻略第一層Boss、或是等級大於25、或累積一定遊玩量後才能使用。</td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-positive action mt-2 me-2 px-3" @click="practice(1)">修行1小時</button>
                                <button type="button" class="btn btn-positive action mt-2 me-2 px-3" @click="practice(2)">修行2小時</button>
                                <button type="button" class="btn btn-positive action mt-2 me-2 px-3" @click="practice(4)">修行4小時</button>
                                <button type="button" class="btn btn-positive action mt-2 px-3" @click="practice(8)">修行8小時</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="field" id="actions">
                <h3 class="title">行動紀錄</h3>
                <table class="table table-borderless mb-0">
                    <caption>行動及領取樓層獎勵紀錄</caption>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import myDefs from '@/js/mylib/definitions';

export default {
    name: 'PlayerInfoPage',
    data() {
        return {};
    },
    methods: {
        buildAttrHtml(attr) {
            let value = this.$root.currentPlayerInfo[attr];
            let html = value.toString();
            if (this.$root.currentPlayerInfo.rattrs[attr] > 0) {
                value += this.$root.currentPlayerInfo.rattrs[attr];
                html = `${value.toString()} <span class="rattr">(+${this.$root.currentPlayerInfo.rattrs[attr]})</span>`;
            }
            return html;
        },
        parseTime(type) {
            const timestamp = this.$root.currentPlayerInfo[type];
            if (timestamp !== undefined && timestamp !== null) {
                return moment(timestamp).format('YYYY-MM-DD HH:mm:ss.SSS');
            }
            return null;
        },
        updateStatus() {
            axios({
                method: this.$root.api.myKiritoApi.updateStatus.method,
                url: `${this.$root.api.myKiritoApi.updateStatus.url}?player=${this.$root.currentPlayer}`,
                headers: {
                    'content-type': myDefs.commonJsonContentType,
                    authorization: `Bearer ${localStorage.getItem('Token')}`,
                },
                data: {
                    status: this.$root.currentPlayerInfo.status,
                },
            })
                .then(response => {
                    if (response.data && this.$root.checkApiResponseData(response) && this.$root.checkApiResponseError(response)) {
                        this.$root.alert('更新玩家狀態', '更新成功');
                    } else {
                        console.warn(response);
                    }
                })
                .catch(error => {
                    this.$root.alert('更新玩家狀態', this.$root.getErrorMessage(error.response));
                });
        },
        setTeammate() {
            axios({
                method: this.$root.api.myKiritoApi.setTeammate.method,
                url: `${this.$root.api.myKiritoApi.setTeammate.url}?player=${this.$root.currentPlayer}`,
                headers: {
                    'content-type': myDefs.commonJsonContentType,
                    authorization: `Bearer ${localStorage.getItem('Token')}`,
                },
                data: {
                    teammate: this.$root.currentPlayerInfo.teammateNickname,
                },
            })
                .then(response => {
                    if (response.data && this.$root.checkApiResponseData(response) && this.$root.checkApiResponseError(response)) {
                        if (response.data.data[0].teammateUID) {
                            this.$root.alert('設定隊友', '設定成功');
                            this.$root.currentPlayerInfo.teammate = this.$root.currentPlayerInfo.teammateNickname;
                            this.$root.currentPlayerInfo.teammateUID = response.data.teammateUID;
                        } else {
                            if (this.$root.currentPlayerInfo.teammateUID) {
                                this.$root.alert('設定隊友', '隊伍已解除');
                                this.$root.currentPlayerInfo.teammate = '';
                                this.$root.currentPlayerInfo.teammateUID = false;
                            } else {
                                console.log('隊友未變更');
                            }
                        }
                    } else {
                        console.warn(response);
                    }
                })
                .catch(error => {
                    this.$root.alert('設定隊友', this.$root.getErrorMessage(error.response));
                });
        },
        getFloorBonus() {
            axios({
                method: this.$root.api.myKiritoApi.doAction.method,
                url: `${this.$root.api.myKiritoApi.doAction.url}?player=${this.$root.currentPlayer}`,
                headers: {
                    'content-type': myDefs.commonJsonContentType,
                    authorization: `Bearer ${localStorage.getItem('Token')}`,
                },
                data: {
                    action: 'floorBonus',
                },
            })
                .then(response => {
                    if (response.data && this.$root.checkApiResponseData(response) && this.$root.checkApiResponseError(response)) {
                        if (response.data.data[0].message === '領取成功！' && response.data.data[0].myKirito) {
                            const result = response.data.data[0].myKirito;
                            this.$root.currentPlayerInfo.exp = result.exp;
                            this.$root.currentPlayerInfo.lv = result.lv;
                            this.$root.currentPlayerInfo.lastAction = result.lastAction;
                            this.$root.currentPlayerInfo.lastFloorBonus = result.lastFloorBonus;
                            this.$root.currentPlayerInfo.actionCount = result.actionCount;
                        } else {
                            console.warn('領取樓層獎勵特別狀況：', response);
                        }
                    } else {
                        console.warn(response);
                    }
                })
                .catch(error => {
                    this.$root.alert('設定隊友', this.$root.getErrorMessage(error.response));
                });
        },
        huntRabbit() {
            //
        },
        selfTraining() {
            //
        },
        goPicnic() {
            //
        },
        chaseGirl() {
            //
        },
        doGood() {
            //
        },
        sitRest() {
            //
        },
        goFishing() {
            //
        },
        practice(hour) {
            //
        },
        isDisabled(action) {
            switch (action) {
                case 'floorBonus':
                    if (this.$root.timeRemain.floorBonus > 0 || this.$root.currentPlayerInfo.floor < 1) {
                        return true;
                    }
                    break;
            }
            return false;
        },
    },
    computed: {
        colorName() {
            switch (this.$root.currentPlayerInfo.color) {
                case 'red':
                    return 'nickname-red';
                case 'orange':
                    return 'nickname-orange';
                case 'black':
                default:
                    return 'nickname-black';
            }
        },
        toNextLevel() {
            const level = this.$root.currentPlayerInfo.lv;
            if (level !== null && level !== '') {
                if (level < 70) {
                    const exp = this.$root.currentPlayerInfo.exp;
                    const nextLevelExp = this.$root.threshold[level + 1];
                    return nextLevelExp - exp;
                }
                return '滿級';
            }
            return null;
        },
        protection() {
            const murder = this.$root.currentPlayerInfo.murder;
            const defDeath = this.$root.currentPlayerInfo.defDeath;
            if (murder !== null && murder !== '' && defDeath !== null && defDeath !== '') {
                return murder * 5 + 1 - defDeath;
            }
            return null;
        },
        teammateHtml() {
            const baseUrl = myDefs.myKiritoUrl.base;
            const uid = this.$root.currentPlayerInfo.teammateUID;
            const teammate = this.$root.currentPlayerInfo.teammate;
            if (uid) {
                return `隊伍狀態：<a class="teammate" target="_blank" href="${baseUrl}/profile/${uid}">${teammate}</a>`;
            }
            return '隊伍狀態：無';
        },
        floorBonusHintHtml() {
            if (this.$root.timeRemain.floorBonus < 0) {
                return `每 4 小時可以依目前樓層數領取獎勵經驗值 (×100)。目前樓層 ${this.$root.currentPlayerInfo.floor}`;
            } else {
                const timeRemain = Math.ceil(this.$root.timeRemain.floorBonus / 1000);
                return `冷卻倒數：${timeRemain} 秒`;
            }
        },
    },
    mounted() {},
};
</script>

<style scoped lang="scss">
@use 'sass:math';

@import '@/sass/_variables.scss';
@import '@/sass/_dark.scss';
@import '@/sass/_light.scss';

$th-width: 14.28%;

th {
    &.head-1,
    &.head-2 {
        background-color: var(--th-bg-color);
        width: $th-width;
    }

    &.ability {
        background-color: var(--th-abil-bg-color);
    }
}

td {
    &.content-1,
    &.content-2 {
        width: 50% - $th-width;
    }

    &.nickname {
        &-orange {
            color: var(--nickname-orange-color);
        }
        &-red {
            color: var(--nickname-red-color);
        }
    }

    &.floor {
        color: var(--pink-info-color);
    }

    &.murder {
        color: var(--cyan-info-color);
    }

    &.reset {
        color: var(--blue-info-color);
    }

    &.protection {
        color: var(--orange-info-color);
    }

    &.to-next-level {
        color: var(--gold-info-color);
    }

    &.last-time {
        color: var(--purple-info-color);
    }

    &.achievement {
        color: var(--yellow-info-color);
    }

    &.fragment {
        color: var(--green-info-color);
    }
}

img.personal-info-avatar {
    height: $personal-info-avatar-size;
    width: $personal-info-avatar-size;
}

tr.beside-avatar {
    $avatar-rowspan: 4;
    $row-margin: 9.5;

    th,
    td {
        height: math.div($personal-info-avatar-size + $row-margin, $avatar-rowspan);
    }
}

#settings {
    .form-label {
        width: 5em;
    }
    .form-body {
        .form-control {
            border-radius: 4px;
        }
    }
    .form-button {
        width: 4.8em;
    }
}
</style>
