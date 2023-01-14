import myDefs from './definitions';

const changeTitle = (vueTo) => {
    const defaultPageTitle = myDefs.defaultPageTitle;
    document.title = vueTo.name === 'PlayerInfo' ? defaultPageTitle : `${vueTo.meta.title || ''} - ${defaultPageTitle}`;
};

export default {
    changeTitle,
};
