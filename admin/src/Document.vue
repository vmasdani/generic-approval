<script setup lang="ts">
import { Ref, ref } from "vue";
import { fetchDocuments, fetchUsers } from "./fetchers";
// import { fetchUsers } from "./fetchers";

const documents = ref([]) as Ref<any[]>;
  const users = ref([]) as Ref<any[]>;

const fetchDocumentsData = async () => {
  const d = await fetchDocuments();

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

fetchUsersData();

fetchDocumentsData();
</script>

<template>
  <div><h4>Document</h4></div>
  <div><hr class="border border-dark" /></div>
  <div>
    <a href="#/document/add"><button class="btn btn-sm btn-primary">Add</button></a>
  </div>
  <div class="border border-dark" style="height: 75vh">
    <table class="table table-sm" style="border-collapse: separate">
      <tr>
        <th
          v-for="h in ['#', 'ID', 'Name', 'Creator', 'PICs', 'Edit']"
          class="bg-dark text-light"
        >
          {{ h }}
        </th>
      </tr>
      <tr v-for="(d, i) in documents">
        <td class="border border-dark">{{ i + 1 }}</td>
        <td class="border border-dark">{{ d?.id }}</td>
        <td class="border border-dark">{{ d?.name }}</td>
        <td class="border border-dark">{{ users?.find(u=> u?.id === d?.document_creator_id)?.name }}</td>
        <td class="border border-dark">{{ '' }}</td>
        <td class="border border-dark">
          <a :href="`#/document/${d?.id}`"
            ><button class="btn btn-sm btn-primary">Edit</button></a
          >
        </td>
      </tr>
    </table>
  </div>
</template>
