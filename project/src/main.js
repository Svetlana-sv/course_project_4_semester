import { createApp } from 'vue'
import App from './App'
import router from './router'
import store from './store'
import axios from 'axios'
import Vue from 'vue'




// // Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
// import { BootstrapVue } from 'bootstrap-vue'
// // Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue)

createApp(App).use(store).use(router).mount('#app')

router.onError((error) => {
    const pattern = /Loading chunk (\d)+ failed/g;
    const isChunkLoadFailed = error.message.match(pattern);
    const targetPath = router.history.pending.fullPath;
    if (isChunkLoadFailed) {
    router.replace(targetPath);
    }
});