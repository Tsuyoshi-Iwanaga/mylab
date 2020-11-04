import React, {useState, useEffect} from 'react';
import PostList from './PostList';
import { fetchPosts } from '../functions/client';

type PostItem = {
  id: number,
  author_id?: string,
  status?: string,
  deadline?: string,
  planed_time?: string,
  actual_time?: string,
  body?: string,
  updated_at?: string,
  created_at?: string,
}

const Main:React.FC = () => {

  const iniPostItems: Array<PostItem>|null = [];
  const [items, setItems] = useState(iniPostItems);

  useEffect(() => {
    fetchPosts()
      .then((res) => {
        console.log(res.data);
        setItems(res.data);
      });
  }, []);

  return (
    <div className="col-md-9">
      <div className="card">
        <div className="card-header">メイン</div>
        <div className="card-body">
          <PostList items={items} />
        </div>
      </div>
    </div>
  );
}
export default Main;