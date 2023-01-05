import { configureStore } from "@reduxjs/toolkit";
import reducer from "redux/slices";
import { studentApi } from "services";

const store = configureStore({
  reducer,
  middleware: (getDefaultMiddleware) =>
    getDefaultMiddleware().concat(studentApi.middleware),
  devTools: process.env.NODE_ENV !== "production",
});
export default store;
