import { Routes, Route } from "react-router-dom";

import {
  FORGOT_PASSWORD,
  HOME,
  LOGIN,
  LOGIN_CONFIRM,
  RESET_PASSWORD,
  SIGNUP,
  SIGNUPFORM,
} from "./CONSTANTS";

import type { FC } from "react";
import { ProtectedRoute, PublicRoute } from "components";
import {
  Home,
  Login,
  ResetPassword,
  Signup,
  ForgotPassword,
  ErrorPage,
} from "pages";

const RouterConfig: FC = () => {
  return (
    <div>
      <Routes>
        {/* Public routes should be placed in here */}
        <Route path={HOME} element={<Home />} />
        {/* <Route path={CONTACT} element={<Contact />} /> */}
        <Route path="/" element={<PublicRoute />}>
          {/* Auth pages */}
          <Route path={LOGIN} element={<Login />} />
          <Route path={LOGIN_CONFIRM} element={<Login />} />
          <Route path={SIGNUP} element={<Signup />} />
          <Route path={SIGNUPFORM} element={<Signup />} />
          <Route path={RESET_PASSWORD} element={<ResetPassword />} />
          <Route path={FORGOT_PASSWORD} element={<ForgotPassword />} />
        </Route>
        {/* dashboard routes should be placed in here */}
        {/* <Route>
          <Route path={DASHBOARD} element={<DashboardHome />}></Route>
          <Route path={BROADCASTCHANNEL} element={<BroadcastChannel />} />
          <Route path={CALENDER} element={<Calender />} />
          <Route path={REFER_A_FRIEND} element={<ReferAFriend />} />
          <Route path={SETTINGS} element={<Settings />} />
        </Route> */}

        <Route path="/" element={<ProtectedRoute />}>
          {/* Protected routes should be placed in here */}
        </Route>

        {/* 404 page */}
        <Route path="*" element={<ErrorPage />} />
      </Routes>
    </div>
  );
};

export default RouterConfig;
