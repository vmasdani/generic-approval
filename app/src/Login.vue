<script setup lang="ts">
import { ref } from "vue";
import { ctx } from "./main";
import { postLogin } from "./fetchers";

const username = ref("");
const password = ref("");

const login = async () => {
  // ctx.value.apiKey = "abc";

  const user = await postLogin({
    username: username.value,
    password: password.value,
  });

  console.log("user", user);

  if (!user) {
    return;
  }

  ctx.value.apiKey = "abc";
  ctx.value.user = user;

  localStorage.setItem("user", JSON.stringify(user));
  localStorage.setItem("apiKey", "abc");
};
</script>
<template>
  <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="bg-light border border-dark shadow shadow-md">
      <div class="my-1">
        <input
          class="form-control form-control-sm"
          placeholder="Username..."
          @blur="e=>{
            username=(e.target as HTMLInputElement).value
          }"
        />
      </div>

      <div class="my-1">
        <input
          class="form-control form-control-sm"
          placeholder="Password..."
          @blur="e=>{
            password=(e.target as HTMLInputElement).value
          }"
        />
      </div>

      <div>
        <button class="btn btn-sm btn-primary" @click="login()">Login</button>
      </div>
    </div>
  </div>
</template>
