import { FORGOT_PASSWORD, GET_USER, RESET_PASSWORD } from "./CONSTANTS";
import fetch from "./utils/FetchInterceptor";

export const forgotPassword = async ({ email }: { email: string }) => {
  try {
    const data = await fetch({
      url: FORGOT_PASSWORD,
      method: "post",
      headers: {
        "Content-Type": "application/json",
        "public-request": true
      },
      data: { email }
    });
    return data;
  } catch (err) {
    return err;
  }
};

export const resetPassword = async ({ token, password }: { token?: string; password: string }) => {
  try {
    const data = await fetch({
      url: RESET_PASSWORD,
      method: "patch",
      headers: {
        "public-request": true
      },
      data: { password, token }
    });
    return data;
  } catch (err) {
    return err;
  }
};

export const getUserById = async (id: string) => {
  try {
    const data = await fetch({
      url: `${GET_USER}/${id}`,
      method: "get"
    });
    return data;
  } catch (err) {
    return err;
  }
};
