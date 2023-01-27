import * as Bootstrap from 'bootstrap';
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

/**
 * 傳入 Vue 組件及警告標題和內容文字，呼叫 Bootstrap Modal 顯示警告訊息  
 * 內容文字預設為陣列（傳入單一字串則轉為陣列），由 alertModel 的 buildContentHtml 方法進一步組裝為 HTML
 */
const alert = (vueComponent, title = '預設標題', message = ['預設訊息內容']) => {
    if (typeof message === 'string') {
        message = [message];
    }
    vueComponent.alert = {
        title: title,
        content: message,
    };
    const alertModal = new Bootstrap.Modal(document.querySelector('#alertModal'), myDefs.defaultModalConfigs);
    alertModal.show();
};

export default {
    auth,
    changeTitle,
    alert,
};
