/* eslint-disable @typescript-eslint/strict-boolean-expressions */
import { useAppSelector } from "hooks";
import { LOGIN } from "routes/CONSTANTS";
import { Navigate, Outlet } from "react-router-dom";

const ProtectedRoute = () => {
  const { isLoggedIn } = useAppSelector((state) => state.auth);

  return isLoggedIn ? <Outlet /> : <Navigate to={LOGIN} replace />;
};

export default ProtectedRoute;
