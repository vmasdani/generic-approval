<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { ctx } from "./main";
import { Ref, ref } from "vue";

const route = useRoute();
const router = useRouter();
const user = ref({}) as Ref<any>;

const handleSave = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_BASE_URL}/api/users`, {
      method: "post",
      headers: {
        authorization: ctx.value.apiKey ?? "",
        "content-type": "application/json",
      },
      body: JSON.stringify(user.value),
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    router.push("/user");
  } catch (e) {
    console.error(e);
  }
};
</script>

<template>
  <div>
    <div class="d-flex">
      <h4>User detail: {{ route?.params?.id }}</h4>
      <div>
        <button class="btn btn-sm btn-primary" @click="handleSave()">
          Save
        </button>
      </div>
    </div>
    <div><hr class="border border-dark" /></div>
    <div class="d-flex flex-wrap">
      <div class="flex-grow-1 mx-1">
        <div>
          <small><strong>Username</strong></small>
        </div>
        <input
          class="form-control form-control-sm"
          placeholder="Username..."
          @blur="(e)=>{
            user.username = (e.target as HTMLInputElement).value
          }"
        />
      </div>
      <div class="flex-grow-1 mx-1">
        <div>
          <small><strong>Name </strong></small>
        </div>
        <input
          class="form-control form-control-sm"
          placeholder="Name..."
          @blur="(e)=>{
            user.name = (e.target as HTMLInputElement).value
          }"
        />
      </div>
      <div class="flex-grow-1 mx-1">
        <div>
          <small><strong>Email</strong></small>
        </div>
        <input
          class="form-control form-control-sm"
          placeholder="Email..."
          @blur="(e)=>{
            user.email = (e.target as HTMLInputElement).value
          }"
        />
      </div>
    </div>
  </div>
</template>
