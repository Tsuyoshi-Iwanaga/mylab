import React from 'react';
import PostList from './PostList';

type PostItem = {
  author_id?: string,
  status?: string,
  deadline?: string,
  planed_time?: string,
  actual_time?: string,
  body?: string,
  updated_at?: string,
  created_at?: string,
}

type PostItemProps = {
  item: PostItem
}

const Main:React.FC = () => {
  const info: PostItemProps[] = [
    {
      item: {
        author_id: "001",
        status: "001",
        deadline: "001",
        planed_time: "001",
        actual_time: "001",
        body: "001",
        updated_at: "001",
        created_at: "001",
      }
    },
    {
      item: {
        author_id: "001",
        status: "001",
        deadline: "001",
        planed_time: "001",
        actual_time: "001",
        body: "001",
        updated_at: "001",
        created_at: "001",
      }
    }
  ];

  return (
    <div className="col-md-9">
      <div className="card">
        <div className="card-header">メイン</div>
        <div className="card-body">
          <PostList items={info} />
        </div>
      </div>
    </div>
  );
}
export default Main;