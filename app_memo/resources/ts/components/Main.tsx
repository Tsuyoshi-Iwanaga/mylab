import React from 'react';

const Main:React.FC = (props) => {
  return (
    <div className="col-md-9">
      <div className="card">
        <div className="card-header">メイン</div>
        <div className="card-body">
          {props.children}
        </div>
      </div>
    </div>
  );
}
export default Main;