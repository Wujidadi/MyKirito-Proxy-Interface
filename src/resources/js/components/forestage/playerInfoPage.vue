<template>
    <div class="page">
        <div class="content" id="playerInfoAndActions">
            <div class="field" id="personalInfoField">
                <h3 class="title">我的桐人</h3>
                <table class="info-table" id="personalInfo">
                    <caption>我的桐人玩家個人基本資料</caption>
                    <tbody>
                        <tr class="beside-avatar">
                            <th class="head-1" scope="col">暱稱</th>
                            <td class="content-1" :class="colorName">{{ $root.currentPlayerInfo.nickname }}</td>
                            <td class="avatar text-center" colspan="2" rowspan="3">
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
                            <th class="head-1" scope="col">轉生次數</th>
                            <td class="content-1">{{ $root.currentPlayerInfo.reincarnation }}</td>
                            <th class="head-2" scope="col">總敗場</th>
                            <td class="content-2">{{ $root.currentPlayerInfo.totalLose }}</td>
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
                            <th class="head-1" scope="col">上次爬塔</th>
                            <td class="content-1 last-time">{{ parseTime('lastBossChallenge') }}</td>
                            <th class="head-2" scope="col">上次領樓層</th>
                            <td class="content-2 last-time">{{ parseTime('lastFloorBonus') }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">上次行動</th>
                            <td class="content-1 last-time">{{ parseTime('lastAction') }}</td>
                            <th class="head-2" scope="col">上次挑戰</th>
                            <td class="content-2 last-time">{{ parseTime('lastChallenge') }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">上次改狀態</th>
                            <td class="content-1 last-time">{{ parseTime('lastStatus') }}</td>
                            <th class="head-2" scope="col">通過100層</th>
                            <td class="content-2 last-time">{{ parseTime('cleared') }}</td>
                        </tr>
                        <tr>
                            <th class="head-1" scope="col">目前層數</th>
                            <td class="content-1 floor">{{ $root.currentPlayerInfo.floor }}</td>
                            <th class="head-2" scope="col">記憶碎片</th>
                            <td class="content-2 fragment">{{ $root.fragment[this.$root.currentPlayerInfo.fragment] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PlayerInfoPage',
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
            if (level !== null) {
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
            if (murder !== null && defDeath !== null) {
                return murder * 5 + 1 - defDeath;
            }
            return null;
        },
    },
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

    &.floor {
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
    $avatar-rowspan: 3;
    $row-margin: 9.5;

    th,
    td {
        height: math.div($personal-info-avatar-size + $row-margin, $avatar-rowspan);
    }
}
</style>
