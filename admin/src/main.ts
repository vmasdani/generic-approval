import { createApp, reactive, ref } from "vue";
// import './style.css'
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import App from "./App.vue";
import { createRouter, createWebHashHistory } from "vue-router";
import HomeVue from "./Home.vue";
import UserVue from "./User.vue";
import ConfigVue from "./Config.vue";
import UserDetailVue from "./UserDetail.vue";
import DocumentVue from "./Document.vue";
import DocumentDetailVue from "./DocumentDetail.vue";
import "vue-select/dist/vue-select.css";

export const ctx = ref({
  apiKey: localStorage.getItem("apiKey") as null | string,
});

const routes = [
  { path: "/", component: HomeVue },
  { path: "/user", component: UserVue },
  { path: "/user/:id", component: UserDetailVue },
  { path: "/config", component: ConfigVue },
  { path: "/document", component: DocumentVue },
  { path: "/document/:id", component: DocumentDetailVue },

  // { path: '/about', component: About },
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHashHistory(),
  routes, // short for `routes: routes`
});

createApp(App).use(router).mount("#app");
