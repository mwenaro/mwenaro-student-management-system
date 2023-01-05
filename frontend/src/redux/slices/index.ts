import { combineReducers } from "@reduxjs/toolkit";
import { studentApi } from "services";

import auth from "./auth.slice";
import counter from "./counter.slice";
import message from "./message.slice";

const rootReducer = combineReducers({
  auth,
  counter,
  message,
  [studentApi.reducerPath]: studentApi.reducer,
});

export default rootReducer;
