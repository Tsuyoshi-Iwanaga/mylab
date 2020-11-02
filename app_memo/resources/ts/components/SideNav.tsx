import React from 'react';
import { Link } from 'react-router-dom';

function SideNav() {
  return (
    <div className="col-md-3">
      <div className="card">
        <div className="card-header">サイドバー</div>
          <div className="card-body">
            <p><Link to="/memo">メモ</Link></p>
            <p><Link to="/todo">Todo</Link></p>
          </div>
      </div>
    </div>
  );
}
export default SideNav;