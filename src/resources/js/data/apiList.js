import myDefs from '@/js/mylib/definitions';

const myKiritoApi = {
    personalInfo: { method: 'GET', url: '/api/my-kirito/player-info' },
    updateStatus: { method: 'POST', url: '/api/my-kirito/player-status' },
    setTeammate: { method: 'POST', url: '/api/my-kirito/teammate' },
    doAction: { method: 'POST', url: '/api/my-kirito/do-action' },
    getAchievements: { method: 'GET', url: '/api/my-kirito/achievements' },
};

export default {
    myKiritoApi,
};
