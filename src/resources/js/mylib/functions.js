import myDefs from './definitions';

const auth = async function () {
    let isPass = false;
    if (localStorage.getItem('Token')) {
        const jwt = localStorage.getItem('Token');
        await axios({
            method: 'post',
            url: '/api/token/verify',
            headers: {
                authorization: `Bearer ${jwt}`,
            },
        })
            .then(response => {
                if (response.data && response.data.id && response.data.name) {
                    isPass = true;
                } else {
                    isPass = false;
                }
            })
            .catch(error => {
                isPass = false;
            });
    }
    if (!isPass) {
        localStorage.removeItem('Token');
    }
    return isPass;
};

const changeTitle = (vueTo) => {
    const defaultPageTitle = myDefs.defaultPageTitle;
    document.title = vueTo.name === 'PlayerInfo' ? defaultPageTitle : `${vueTo.meta.title || ''} - ${defaultPageTitle}`;
};

export default {
    auth,
    changeTitle,
};
