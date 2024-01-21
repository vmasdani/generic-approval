<script setup lang="ts"></script>

<template>
  <div><h4>User</h4></div>
  <div><hr class="border border-dark" /></div>
  <div class="border border-dark" style="height: 75vh">
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
  </div>
</template>
