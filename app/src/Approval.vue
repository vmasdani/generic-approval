<script setup lang="ts">
import { Ref, ref } from "vue";
import { fetchDocuments, fetchUsers } from "./fetchers";
import { ctx } from "./main";

const documents = ref([]) as Ref<any[]>;
const users = ref([]) as Ref<any[]>;

const fetchDocumentsData = async () => {
  const d = await fetchDocuments({
    userId: ctx.value.user?.id,
    approved: false,
  });

  if (d) {
    documents.value = d;
  }
};

const fetchUsersData = async () => {
  const d = await fetchUsers();

  if (d) {
    users.value = d;
  }
};

const init = async () => {
  fetchDocumentsData();
  fetchUsersData();
};

init();
</script>

<template>
  <div><h4>Outstanding Approvals</h4></div>
  <div><hr class="border border-dark" /></div>
  <div
    class="border border-dark rounded rounded-md bg-light my-2 p-2"
    v-for="(d, i) in documents"
  >
    <div class="d-flex justify-content-between">
      <div>({{ i + 1 }}) Requested by: {{ d?.document_creator_id }}</div>

      <div>
        <a :href="`#/approvals/${d?.id}`"
          ><button class="btn btn-sm btn-primary">Details</button></a
        >
      </div>
    </div>

    <div>
      <strong>PICs ({{ d?.document_approvals?.length ?? 0 }})</strong>
    </div>
    <div v-for="(a, _) in d?.document_approvals ?? []">
      <div
        :class="`d-flex ${
          a?.approval_timestamp ? `text-success` : `text-danger`
        }`"
      >
        <!-- {{ `${a?.approval_needed_user_id}` }} -->
        {{
          users?.find((u) => `${u?.id}` === `${a?.approval_needed_user_id}`)
            ?.name
        }}
      </div>
    </div>
  </div>
  <!-- <div class="border border-dark" style="height: 75vh">
    <table class="table table-sm" style="border-collapse: separate">
      <tr>
        <th
          v-for="h in ['#', 'Name', 'Username', 'Change Password']"
          class="bg-dark text-light"
        >
          {{ h }}
        </th>
      </tr>
    </table>
  </div> -->
</template>
