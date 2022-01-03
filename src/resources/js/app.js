import './bootstrap';

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

import vueStore from './store';
import vueRouter from './router';
import vueComponents from './components';

if (document.querySelector('#app')) {
    Vue.createApp({
        components: vueComponents,
    })
    .use(vueStore)
    .use(vueRouter)
    .mount('#app');
}
