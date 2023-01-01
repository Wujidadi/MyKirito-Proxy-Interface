<?php

namespace App\Constants\MyKirito;

class ApiList
{
    const GET_PERSONAL_INFO          = 'getPersonalInfo';
    const GET_UNLOCKED_CHARACTERS    = 'getUnlockedCharacters';
    const UPDATE_PERSONAL_STATUS     = 'updatePersonalStatus';
    const SET_TEAMMATE               = 'setTeammate';
    const DO_ACTION                  = 'doAction';
    const REINCARNATION              = 'reincarnation';
    const UNLOCK_CHARACTER_BY_SECRET = 'unlockCharacterBySecret';
    const GET_USER_LIST              = 'getUserList';
    const SEARCH_PLAYER_BY_NICKNAME  = 'searchPlayerByNickname';
    const GET_PLAYER_PROFILE         = 'getPlayerById';
    const CHALLENGE                  = 'challenge';
    const GET_BOSS_INFO              = 'getBossInfo';
    const CHALLENGE_BOSS             = 'challengeBoss';
    const GET_ACHIEVEMENTS           = 'getAchievements';
    const GET_ACHIEVEMENT_RANK       = 'getAchievementRank';
    const GET_HALL_OF_FAME           = 'getHallOfFame';
    const GET_DEFENSE_REPORTS        = 'getDefenseReports';
    const GET_ATTACK_REPORTS         = 'getAttackReports';
    const GET_BOSS_REPORTS           = 'getBossReports';
    const GET_DETAIL_REPORT          = 'getDetailReport';

    const LIST = [
        self::GET_PERSONAL_INFO          => ['GET',  '/my-kirito'],
        self::GET_UNLOCKED_CHARACTERS    => ['GET',  '/my-kirito/unlocked-characters'],
        self::UPDATE_PERSONAL_STATUS     => ['POST', '/my-kirito/status'],
        self::SET_TEAMMATE               => ['POST', '/my-kirito/teammate'],
        self::DO_ACTION                  => ['POST', '/my-kirito/doaction?u=%s'],
        self::REINCARNATION              => ['POST', '/my-kirito/reincarnation'],
        self::UNLOCK_CHARACTER_BY_SECRET => ['POST', '/my-kirito/unlock'],
        self::GET_USER_LIST              => ['GET',  '/user-list?lv=%s&page=%s'],
        self::SEARCH_PLAYER_BY_NICKNAME  => ['GET',  '/search?nickname=%s'],
        self::GET_PLAYER_PROFILE         => ['GET',  '/profile/%s'],
        self::CHALLENGE                  => ['POST', '/challenge'],
        self::GET_BOSS_INFO              => ['GET' , '/boss'],
        self::CHALLENGE_BOSS             => ['POST', '/boss/challenge'],
        self::GET_ACHIEVEMENTS           => ['GET',  '/achievements'],
        self::GET_ACHIEVEMENT_RANK       => ['GET',  '/achievement-ranking'],
        self::GET_HALL_OF_FAME           => ['GET',  '/hall-of-fame'],
        self::GET_DEFENSE_REPORTS        => ['GET',  '/reports?filter=def'],
        self::GET_ATTACK_REPORTS         => ['GET',  '/reports?filter=atk'],
        self::GET_BOSS_REPORTS           => ['GET',  '/reports?filter=boss'],
        self::GET_DETAIL_REPORT          => ['GET',  'https://mykirito-storage.b-cdn.net/reports/%s.json'],
    ];
}
