import { ctx } from "./main";

export const fetchUsers = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_BASE_URL}/api/users`, {
      headers: { authorization: ctx.value.apiKey ?? "" },
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return await resp.json();
  } catch (e) {
    return [];
  }
};

export const fetchDocuments = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_BASE_URL}/api/documents`, {
      headers: { authorization: ctx.value.apiKey ?? "" },
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return await resp.json();
  } catch (e) {
    return [];
  }
};

export const fetchApprovalConfigs = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_BASE_URL}/api/approvalconfigs`,
      {
        headers: { authorization: ctx.value.apiKey ?? "" },
      }
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return await resp.json();
  } catch (e) {
    return [];
  }
};
