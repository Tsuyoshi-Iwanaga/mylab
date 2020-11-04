import React from 'react';

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

type PostItemProps = {
  item: PostItem
}

const PostItem: React.FC<PostItemProps> = (props) => (
  <li>
    <span>{props.item.author_id}</span>
    <span>{props.item.status}</span>
    <span>{props.item.deadline}</span>
    <span>{props.item.planed_time}</span>
    <span>{props.item.actual_time}</span>
    <span>{props.item.body}</span>
    <span>{props.item.updated_at}</span>
    <span>{props.item.created_at}</span>
  </li>
);
export default PostItem;