<script setup lang="ts">
import { Ref, computed, ref } from "vue";
import { fetchApprovalConfigs } from "./fetchers";
import { ctx } from "./main";
import { fetchUsers } from "./fetchers";
import VueSelect from "vue-select";

const configs = ref([]) as Ref<any[]>;
const users = ref([]) as Ref<any[]>;

const handleSave = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_BASE_URL}/api/approvalconfigs-save-bulk`,
      {
        method: "post",
        headers: {
          authorization: ctx.value.apiKey ?? "",
          "content-type": "application/json",
        },
        body: JSON.stringify(configs.value),
      }
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    alert("Save successful");
    window.location.reload();
  } catch (e) {
    console.error(e);
  }
};

const handleAdd = async () => {
  const cs = [...configs.value];
  cs.sort((a, b) => (b?.ordering ?? 0) - (a?.ordering ?? 0));

  const maxOrderingAdded = (cs?.[0]?.ordering ?? 0) + 1;

  configs.value.push({
    ordering: maxOrderingAdded,
  });
};

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

const move = (type: any, ordering: any) => {
  let a = null;
  let b = null;

  console.log(sortedConfigs.value);

  const index = sortedConfigs?.value?.findIndex(
    (c) => c?.ordering === ordering
  );

  if (type === "up") {
    a = sortedConfigs.value?.[index];
    b = sortedConfigs.value?.[index - 1];
  }

  if (type === "down") {
    a = sortedConfigs.value?.[index];
    b = sortedConfigs.value?.[index + 1];
  }

  if (!a || !b) {
    return;
  }

  const aOrdering = a?.ordering;
  const bOrdering = b?.ordering;

  a.ordering = bOrdering;
  b.ordering = aOrdering;

  configs.value = sortedConfigs.value;
};

const fetchUsersData = async () => {
  const d = await fetchUsers();

  if (d) {
    users.value = d;
  }
};

fetchUsersData();
fetchConfigsData();
</script>

<template>
  <div class="d-flex">
    <h4>Config</h4>

    <div>
      <button class="btn btn-sm btn-primary" @click="handleSave()">Save</button>
    </div>
  </div>
  <div><hr class="border border-dark" /></div>
  <div>
    <button class="btn btn-sm btn-primary px-1 py-0" @click="handleAdd()">
      Add
    </button>
  </div>
  <div class="border border-dark" style="height: 75vh">
    <table class="table table-sm" style="border-collapse: separate">
      <tr>
        <th
          v-for="h in [
            '#',
            'Position',
            'Ordering',
            'Move Up',
            'Move Down',
            'PIC',
          ]"
          class="bg-dark text-light"
        >
          {{ h }}
        </th>
      </tr>
      <tr v-for="(c, i) in sortedConfigs">
        <td class="border border-dark">{{ i + 1 }}</td>
        <td class="border border-dark">
          <input
            placeholder="Position..."
            class="form-control form-control-sm"
            :value="c?.position ?? ''"
            @blur="e=>{
              c.position = (e.target as HTMLInputElement).value
            }"
          />
        </td>
        <td class="border border-dark">
          <button
            class="btn btn-sm btn-primary"
            @click="move('up', c?.ordering ?? 0)"
          >
            Up
          </button>
        </td>
        <td class="border border-dark">
          <button
            class="btn btn-sm btn-primary"
            @click="move('down', c?.ordering ?? 0)"
          >
            Down
          </button>
        </td>

        <td class="border border-dark">{{ c?.ordering }}</td>
        <td class="border border-dark">
          <VueSelect
            :options="users"
            :getOptionLabel="(u:any) => `${u?.name}`"
            :modelValue="users.find((u) => u?.id === c?.user_id)"
            @update:modelValue="
              (u:any) => {
                c.user_id = u?.id;
              }
            "
          />
        </td>
      </tr>
    </table>
  </div>
</template>
