import { SiteGradient } from "components";
import { Link } from "react-router-dom";
import { SIGNUP, FORGOT_PASSWORD } from "../../routes/CONSTANTS";

function HomeView() {
  return (
    <SiteGradient>
      <div className="card flex-shrink-0 w-full max-w-sm shadow-2xl  bg-white ">
        <div className="flex flex-col items-center justify-center m-4">
          <h2 className="text-neutral font-extrabold text-2xl sm:text-2xl">
            <span className="hidden sm:inline ">Welcome to </span>mdsReportgen
          </h2>
        </div>
        <div className="card-body">
          <div className="form-control">
            <label className="label text-myprimary">
              <span className="label-text text-myprimary">Username</span>
            </label>
            <input
              type="text"
              placeholder="username@schoolcode"
              className="input input-bordered"
            />
          </div>
          <div className="form-control">
            <label className="label text-myprimary">
              <span className="label-text text-myprimary">Password</span>
            </label>
            <input
              type="text"
              placeholder="password"
              className="input input-bordered"
            />
            <label className="label">
              <Link className="px-1 text-myprimary" to={FORGOT_PASSWORD}>
                Forgot password?
              </Link>
            </label>
          </div>
          <div className="form-control mt-6">
            <button className="bg-myprimary text-mysecondary hover:bg-myprimary p-3 rounded-2xl">
              Login
            </button>
          </div>
          <div className="px-3 py-5 ">
            <h3 className="text-neutral text-lg font-bold sm:text-xl">
              Don't have an account?{" "}
              <Link className="px-1 text-myprimary" to={SIGNUP}>
                Register
              </Link>
            </h3>
          </div>
        </div>
      </div>
    </SiteGradient>
  );
}

export default HomeView;
