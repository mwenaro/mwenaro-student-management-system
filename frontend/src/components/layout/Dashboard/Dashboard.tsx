import { Footer, Sidebar } from "components/modules";
import { ReactNode } from "react";

export interface Prop {
  children: ReactNode;
}

const Dashboard = ({ children }: Prop) => {
  return (
    <div className="bg-sweetgray   flex items-center justify-center p-5 sm:p-11">
      <div className="grid grid-cols-10 w-full ">
        <nav className="hidden sm:flex min-h-fit h-screen  col-span-2 relative">
          <Sidebar />
        </nav>
        <div className="col-span-10 sm:col-span-8 border-2 border-[red]  min-h-fit h-screen bg-gray-100 ">
          <>{children}</>
          <>
            <Footer />
          </>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
