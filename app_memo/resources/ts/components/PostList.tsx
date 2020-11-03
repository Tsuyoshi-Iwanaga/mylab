import React from 'react';
import PostItem from './PostItem';

type PostItemProps = {
  item: PostItem
}

type PostItemListProps = {
  items: Array<PostItemProps>
}

const PostList: React.FC<PostItemListProps> = (props) => (
  <ul className="postList">
    {props.items.map((v) => 
      <PostItem item={v.item} />
    )}
  </ul>
);
export default PostList;