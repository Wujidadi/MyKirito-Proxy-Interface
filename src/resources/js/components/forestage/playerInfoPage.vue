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
                        <td class="content-1">TSK</td>
                        <td class="avatar text-center" colspan="2" rowspan="3">
                            <img class="personal-info-avatar" src="/images/avatars/godRecon.webp" alt="God Recon">
                        </td>
                    </tr>
                    <tr class="beside-avatar">
                        <th class="head-1" scope="col">角色</th>
                        <td class="content-1">神</td>
                    </tr>
                    <tr class="beside-avatar">
                        <th class="head-1" scope="col">稱號</th>
                        <td class="content-1">神</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">等級</th>
                        <td class="content-1">67</td>
                        <th class="head-2" scope="col">經驗值</th>
                        <td class="content-2">62350</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">HP</th>
                        <td class="content-1">2450</td>
                        <th class="head-2" scope="col">主動擊殺</th>
                        <td class="content-2">0</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">攻擊</th>
                        <td class="content-1">181</td>
                        <th class="head-2" scope="col">防衛擊殺</th>
                        <td class="content-2">0</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">防禦</th>
                        <td class="content-1">284</td>
                        <th class="head-2" scope="col">總主動擊殺</th>
                        <td class="content-2">0</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">體力</th>
                        <td class="content-1">251</td>
                        <th class="head-2" scope="col">總防衛擊殺</th>
                        <td class="content-2">67</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">敏捷</th>
                        <td class="content-1">172</td>
                        <th class="head-2" scope="col">遭襲死亡</th>
                        <td class="content-2">25</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">反應速度</th>
                        <td class="content-1">186</td>
                        <th class="head-2" scope="col">遭反殺死亡</th>
                        <td class="content-2">31</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">技巧</th>
                        <td class="content-1">273</td>
                        <th class="head-2" scope="col">勝場</th>
                        <td class="content-2">347</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">智力</th>
                        <td class="content-1">1395 <span class="rattr">(+984)</span></td>
                        <th class="head-2" scope="col">敗場</th>
                        <td class="content-2">115</td>
                    </tr>
                    <tr>
                        <th class="head-1 ability" scope="col">幸運</th>
                        <td class="content-1">9999</td>
                        <th class="head-2" scope="col">總勝場</th>
                        <td class="content-2">72773</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">轉生次數</th>
                        <td class="content-1">349</td>
                        <th class="head-2" scope="col">總敗場</th>
                        <td class="content-2">34330</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">玻璃值</th>
                        <td class="content-1 murder">4</td>
                        <th class="head-2" scope="col">機器人等級</th>
                        <td class="content-2 bot-lv">0</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">保護狀態</th>
                        <td class="content-1 protection">0</td>
                        <th class="head-2" scope="col">距離升級</th>
                        <td class="content-2 to-next-level">30</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">上次爬塔</th>
                        <td class="content-1 last-time">2023-01-03 10:42:30</td>
                        <th class="head-2" scope="col">上次領樓層</th>
                        <td class="content-2 last-time">2023-01-11 23:23:28</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">上次行動</th>
                        <td class="content-1 last-time">2023-01-11 23:23:27</td>
                        <th class="head-2" scope="col">上次挑戰</th>
                        <td class="content-2 last-time">2023-01-11 23:32:13</td>
                    </tr>
                    <tr>
                        <th class="head-1" scope="col">上次改狀態</th>
                        <td class="content-1 last-time" colspan="3">2022-02-20 22:37:53</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PlayerInfoPage"
};
</script>

<style scoped lang="scss">
@use 'sass:math';

@import '@/sass/_variables.scss';

$th-width: 14.28%;

th {
    &.head-1, &.head-2 {
        background-color: $th-bg-color;
        width: $th-width;
    }

    &.ability {
        background-color: $th-abil-bg-color;
    }
}

td {
    &.content-1, &.content-2 {
        width: 50% - $th-width;
    }

    &.murder {
        color: lightblue;
    }

    &.bot-lv {
        color: aquamarine;
    }

    &.protection {
        color: lightsalmon;
    }

    &.to-next-level {
        color: yellow;
    }

    &.last-time {
        color: thistle;
    }
}

img.personal-info-avatar {
    height: $personal-info-avatar-size;
    width: $personal-info-avatar-size;
}

tr.beside-avatar {
    $avatar-rowspan: 3;
    $row-margin: 9.5;

    th, td {
        height: math.div($personal-info-avatar-size + $row-margin, $avatar-rowspan);
    }
}
</style>
