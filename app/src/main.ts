import { createApp, ref } from "vue";
// import './style.css'
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import App from "./App.vue";
import { createRouter, createWebHashHistory } from "vue-router";
// import HomeVue from "./Home.vue";
// import UserVue from "./User.vue";
// import ConfigVue from "./Config.vue";
import ApprovalVue from "./Approval.vue";
import ApprovalDetailVue from "./ApprovalDetail.vue";

export const ctx = ref({
  user: JSON.parse(localStorage.getItem("user") ?? "{}") as any | null,
  apiKey: localStorage.getItem("apiKey") as null | string,
});

const routes = [
  { path: "/", component: ApprovalVue },
  { path: "/approvals/:id", component: ApprovalDetailVue },
  // { path: "/config", component: ConfigVue },

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
