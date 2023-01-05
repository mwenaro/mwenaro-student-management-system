import { Link } from 'react-router-dom';

// import PropTypes from 'prop-types';
const links = [
  { path: '/', label: 'Home' },
  { path: '/student', label: 'Students' },
  { path: '/teacher', label: 'Teacher' },
  { path: '/admin', label: 'Admin' }
];

const SidebarNav = () => {
  return (
    <ul className="flex flex-col gap-1 w-full">
      {links.map(({ path, label }, index) => (
        <li key={index} className="w-full">
          <Link to={path} className="hover:bg-gray-200 w-full px-5 py-3">
            {label}
          </Link>
        </li>
      ))}
    </ul>
  );
};

export default SidebarNav;
