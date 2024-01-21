<script setup lang="ts">
import { ctx } from "./main";

const login = async () => {
  ctx.value.apiKey = "abc";
  localStorage.setItem("apiKey", "abc");
};
</script>
<template>
  <div>
    <div>
      <input class="form-control form-control-sm" placeholder="Admin key..." />
    </div>
    <div>
      <button class="btn btn-sm btn-primary" @click="login()">Login</button>
    </div>
  </div>
</template>
