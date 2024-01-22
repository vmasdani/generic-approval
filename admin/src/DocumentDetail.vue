<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { ctx } from "./main";
import { Ref, computed, ref } from "vue";
import { fetchApprovalConfigs, fetchUsers } from "./fetchers";
import VueSelect from "vue-select";
import { intlFormat } from "./helpers";

const route = useRoute();
const router = useRouter();
const document = ref({}) as Ref<any>;
const users = ref([]) as Ref<any[]>;
const configs = ref([]) as Ref<any[]>;

const sortedConfigs = computed(() => {
  const cs = [...configs.value];

  cs.sort((a, b) => (a?.ordering ?? 0) - (b?.ordering ?? 0));

  return cs;
});

const fetchConfigsData = async () => {
  const d = await fetchApprovalConfigs();

  if (d) {
    configs.value = d;
  }
};

fetchConfigsData();

const handleSave = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_BASE_URL}/api/documents`, {
      method: "post",
      headers: {
        authorization: ctx.value.apiKey ?? "",
        "content-type": "application/json",
      },
      body: JSON.stringify(document.value),
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    router.push("/document");
  } catch (e) {
    console.error(e);
  }
};

const fetchUsersData = async () => {
  const d = await fetchUsers();

  if (d) {
    users.value = d;
  }
};

fetchUsersData();
</script>

<template>
  <div>
    <div class="d-flex">
      <h4>Document detail: {{ route?.params?.id }}</h4>
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
          <small><strong>Document Name</strong></small>
        </div>
        <input
          class="form-control form-control-sm"
          placeholder="DocName..."
          @blur="(e)=>{
            document.name = (e.target as HTMLInputElement).value
          }"
        />
      </div>

      <div class="flex-grow-1 mx-1">
        <div>
          <small><strong>Document Creator</strong></small>
        </div>
        <VueSelect
          :options="users"
          :getOptionLabel="(u:any) => `${u?.name}`"
          :modelValue="
            users.find((u) => u?.id === document?.document_creator_id)
          "
          @update:modelValue="
              (u:any) => {
                document.document_creator_id = u?.id;
              }
            "
        />
      </div>
    </div>

    <div><hr class="border border-dark" /></div>

    <div>
      <table class="table table-sm" style="border-collapse: separate">
        <tr>
          <th
            class="bg-dark text-light"
            v-for="h in [
              '#',
              'Step',
              'Included',
              'PIC',
              'Actual PIC',
              'Timestamp',
            ]"
          >
            {{ h }}
          </th>
        </tr>
        <tr v-for="(c, i) in sortedConfigs">
          <td class="border border-dark">{{ i + 1 }}</td>
          <td class="border border-dark">{{ c?.position }}</td>
          <td class="border border-dark">
            <input type="checkbox" :checked="true" />
          </td>
          <td class="border border-dark">
            <VueSelect
              :options="users"
              :getOptionLabel="(u:any) => `${u?.name}`"
            />
          </td>
          <td class="border border-dark">
            <VueSelect
              :options="users"
              :getOptionLabel="(u:any) => `${u?.name}`"
            />
          </td>
          <td class="border border-dark">
            {{
              intlFormat({
                date: new Date(),
                dateStyle: "medium",
                timeStyle: "short",
              })
            }}
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>
