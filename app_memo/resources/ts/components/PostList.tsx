import React from 'react';
import PostItem from './PostItem';

type PostItemListProps = {
  items: Array<PostItem>
}

const PostList: React.FC<PostItemListProps> = (props) => {
  if (props.items.length > 0) {
    return (
      <ul className="postList">
        {props.items.map((v) => 
          <PostItem item={v} key={v.id} />
        )}
      </ul>
    )
  } else {
    return <p>No Item...</p>
  }
};
export default PostList;