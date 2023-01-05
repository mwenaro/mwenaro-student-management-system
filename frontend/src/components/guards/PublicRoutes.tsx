/* eslint-disable @typescript-eslint/strict-boolean-expressions */
import { useAppSelector } from "hooks";
import { HOME } from "routes/CONSTANTS";
import { Navigate, Outlet } from "react-router-dom";

const PublicRoutes = () => {
  const { isLoggedIn } = useAppSelector((state) => state.auth);
  return isLoggedIn ? <Navigate to={HOME} replace /> : <Outlet />;
};

export default PublicRoutes;
