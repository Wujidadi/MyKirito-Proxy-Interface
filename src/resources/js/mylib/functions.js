import myDefs from './definitions';

const changeTitle = (vueTo) => {
    const defaultPageTitle = myDefs.defaultPageTitle;
    document.title = vueTo.name === 'PlayerInfo' ? defaultPageTitle : `${vueTo.meta.title || ''} - ${defaultPageTitle}`;
};

/**
 * 傳入 Vue 組件及警告標題和內容文字，呼叫 Bootstrap Modal 顯示警告訊息
 *
 * @param {object} vueComponent
 * @param {string} title
 * @param {string[]} message
 * @returns {void}
 */
const alert = (vueComponent, title = '預設標題', message = ['預設訊息內容']) => {
    vueComponent.alert = {
        title: title,
        content: message,
    };
    const alertModal = new Bootstrap.Modal(document.querySelector('#alertModal'), MyDefs.defaultModalConfigs);
    alertModal.show();
};

export default {
    changeTitle,
    alert,
};
