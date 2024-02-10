import { ctx } from "./main";

export const fetchDocuments = async (params: {
  userId?: any;
  approved?: any;
}) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_BASE_URL}/api/documents?user_id=${
        params.userId ?? ""
      }&approved=${params.approved ?? ""}`,
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

export const fetchDocument = async (params: { id?: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_BASE_URL}/api/documents/${params.id ?? ""}`,
      {
        headers: { authorization: ctx.value.apiKey ?? "" },
      }
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return await resp.json();
  } catch (e) {
    return null;
  }
};

export const postLogin = async (params: { username?: any; password?: any }) => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_BASE_URL}/api/login`, {
      method: "post",
      headers: {
        authorization: ctx.value.apiKey ?? "",
        "content-type": "application/json",
      },
      body: JSON.stringify({
        username: params.username,
        password: params.password,
      }),
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return await resp.json();
  } catch (e) {
    alert(e);
    return null;
  }
};

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
