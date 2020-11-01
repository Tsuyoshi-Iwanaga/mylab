import React from 'react';

function SideNav() {
  return (
    <div className="col-md-3">
      <div className="card">
        <div className="card-header">サイドバー</div>
        <div className="card-body"><a href="{{ route('memo') }}">メモ</a></div>
        <div className="card-body"><a href="{{ route('todo') }}">ToDo</a></div>
      </div>
    </div>
  );
}
export default SideNav;