<script setup lang="ts">
import { Ref, ref } from "vue";
import { fetchUsers } from "./fetchers";

const users = ref([]) as Ref<any[]>;

const fetchUsersData = async () => {
  const d = await fetchUsers();

  if (d) {
    users.value = d;
  }
};

fetchUsersData();
</script>

<template>
  <div><h4>User</h4></div>
  <div><hr class="border border-dark" /></div>
  <div>
    <a href="#/user/add"><button class="btn btn-sm btn-primary">Add</button></a>
  </div>
  <div class="border border-dark" style="height: 75vh">
    <table class="table table-sm" style="border-collapse: separate">
      <tr>
        <th
          v-for="h in ['#', 'ID', 'Name', 'Username', 'Email', 'Edit']"
          class="bg-dark text-light"
        >
          {{ h }}
        </th>
      </tr>
      <tr v-for="(u, i) in users">
        <td class="border border-dark">{{ i + 1 }}</td>
        <td class="border border-dark">{{ u?.id }}</td>
        <td class="border border-dark">{{ u?.name }}</td>
        <td class="border border-dark">{{ u?.username }}</td>
        <td class="border border-dark">{{ u?.email }}</td>
        <td class="border border-dark">
          <a :href="`/user/${u?.id}`"
            ><button class="btn btn-sm btn-primary">Edit</button></a
          >
        </td>
      </tr>
    </table>
  </div>
</template>
