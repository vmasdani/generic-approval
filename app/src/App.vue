<script setup lang="ts">
import { RouterView, useRoute } from "vue-router";
import { ctx } from "./main";
import Login from "./Login.vue";
import Nav from "./Nav.vue";

const route = useRoute();
</script>

<template>
  <!-- {{ ctx.apiKey }} -->
  <div v-if="ctx.apiKey">
    <Nav />

    <div class="m-3">
      <!-- {{ route.path }} -->
      <RouterView />
    </div>
  </div>
  <div v-else><Login /></div>
</template>
