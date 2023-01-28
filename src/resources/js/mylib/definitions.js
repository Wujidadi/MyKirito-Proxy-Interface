const defaultPageTitle = '我的桐人 多帳戶代理介面';

const myKiritoBaseUrl = 'https://mykirito.com';
const myKiritoApiBaseUrl = myKiritoBaseUrl + '/api';
const myKiritoUrl = {
    base: myKiritoBaseUrl,
    api: myKiritoApiBaseUrl,
};

const commonJsonContentType = 'application/json; charset=UTF-8';

export default {
    defaultPageTitle,
    myKiritoUrl,
    commonJsonContentType,
};
