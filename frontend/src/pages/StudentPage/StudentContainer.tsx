import { Dashboard } from "components";
import HomeView from "./SudentView";

export const StudentContainer = () => {
  return (
    <Dashboard>
      <div className="bg-white">
        <HomeView />
      </div>
    </Dashboard>
  );
};
