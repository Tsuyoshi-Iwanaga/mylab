import React from 'react';

const Header: React.FC = () => (
  <nav className="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div className="container">
      <a className="navbar-brand" href="{{ url('/') }}">Memoma</a>
    </div>
  </nav>
);
export default Header;