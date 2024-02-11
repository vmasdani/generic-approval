<script setup lang="ts">
import { useRoute } from "vue-router";
import { fetchDocument, fetchUsers } from "./fetchers";
import { Ref, ref } from "vue";
import { ctx } from "./main";
import { makeDatetimeString,  } from "./helpers";

// const router = useRouter()
const route = useRoute();
const users = ref([]) as Ref<any[]>;

const document = ref(null as any | null);
const fetchDocumentData = async () => {
  const d = await fetchDocument({
    id: route?.params?.id,
  });

  if (d) {
    document.value = d;
  }
};

const fetchUsersData = async () => {
  const d = await fetchUsers();

  if (d) {
    users.value = d;
  }
};

const init = async () => {
  fetchDocumentData();
  fetchUsersData();
};

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

    // window.location.reload();
  } catch (e) {
    console.error(e);
  }
};

init();
</script>

<template>
  <div>
    <div><h4>Approval Detail</h4></div>
  </div>
  <div><hr class="border border-dark" /></div>
  <div>
    <div v-for="(a, _) in document?.document_approvals ?? []">
      <div class="d-flex justify-content-between">
        <div>
          {{
            users.find((u) => `${u?.id}` === `${a?.approval_needed_user_id}`)
              ?.name
          }}
        </div>
        <template v-if="`${a?.approval_needed_user_id}` === `${ctx.user?.id}`">
          <button
            v-if="a?.approval_timestamp"
            class="btn btn-sm btn-secondary"
            @click="
              () => {
                a.approval_timestamp = null;
                handleSave();
              }
            "
          >
            Undo
          </button>
          <button
            v-else
            class="btn btn-sm btn-primary"
            @click="
              () => {
                a.approval_timestamp = makeDatetimeString(new Date());
                handleSave();
              }
            "
          >
            Approve
          </button>
        </template>
      </div>
      <div><hr class="border border-dark" /></div>
    </div>
  </div>
</template>
