import SidebarNav from './SidebarNav';

function Sidebar() {
  return (
    <aside className="flex flex-col space-between min-h-full items-center  text-sweetgray w- bg-purple rounded-tl-2xl w-full ">
      <div>Header</div>
      <SidebarNav />
    </aside>
  );
}

export default Sidebar;
