import myDefs from '@/js/mylib/definitions';

const myKiritoApi = {
    personalInfo: { method: 'GET', url: myDefs.myKiritoUrl.api + '/my-kirito' },
    updateStatus: { method: 'POST', url: myDefs.myKiritoUrl.api + '/my-kirito/status' },
    setTeammate: { method: 'POST', url: myDefs.myKiritoUrl.api + '/my-kirito/teammate' },
};

export default {
    myKiritoApi,
};
