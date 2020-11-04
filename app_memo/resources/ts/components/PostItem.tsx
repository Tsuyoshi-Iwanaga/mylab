import React, { useState } from 'react';
import styled from 'styled-components';

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

const PostItem: React.FC<PostItemProps> = (props) => {
  const [status, setStatus] = useState(Number(props.item.status));
  const [deadLine, setDeadLine] = useState(props.item.deadline);
  const [planedTime, setPlanedTime] = useState(props.item.planed_time);
  const [actualTime, setActualTime] = useState(props.item.actual_time);
  const [body, setBody] = useState(props.item.body);

  const [editDeadLine, setEditDeadLine] = useState(false);
  const [editPlanedTime, setEditPlanedTime] = useState(false);
  const [editActualTime, setEditActualTime] = useState(false);
  const [editBody, setEditBody] = useState(false);
  
  const Item = styled.li`
    margin-bottom: 5px;
  `;
  const ItemBody = styled.div`
    padding-bottom: 5px;
    padding-top: 5px;
  `;
  const Status = styled.span`
    display: inline-block;
    line-height: 1;
    border-radius: 3px;
    font-size: 12px;
    margin-right: 5px;
    padding: 3px;
    color: #fff;
    text-align: center;
    ${status === 1 ? 'background: #6cbde6;': undefined}
    ${status === 2 ? 'background: #8fbc8f': undefined}
    ${status === 3 ? 'background: #ccc': undefined}
  `;
  const DeadLine = styled.span`
    display: inline-block;
    font-size: 12px;
    margin-right: 5px;
  `;
  const Time = styled.span`
    font-size: 12px;
  `;
  const Body = styled.span`
    display: inline-block;
    margin-left: 10px;
  `;
  const Input = styled.input`
    line-height: 1;
    font-size: 12px;
  `;

  const changeStatus = () => {
    if(status > 0 && status < 3) {
      setStatus(status + 1);
    } else {
      setStatus(1);
    }
  };

  const statusText = (statusNum: number): string => {
    switch(statusNum) {
      case 1:
        return '未着手';
      case 2:
        return '確認中';
      case 3:
        return '完了';
      default:
        return '-';
    }
  };

  const trimDeadLine = (deadLine: string|undefined): string => {
    if(!deadLine) return '';
    return deadLine.replace(/^(\d{4}-\d{1,2}-\d{1,2}).+$/, "$1" );
  }

  return (<Item className="card">
    <ItemBody className="card-body">
      {/* <span>{props.item.author_id}</span> */}
      <Status onClick={changeStatus}>{statusText(status)}</Status>
      
      {!editDeadLine && <DeadLine onClick={() => setEditDeadLine(true)}>{trimDeadLine(deadLine)}</DeadLine>}
      {editDeadLine && <Input type="text" value={deadLine} onBlur={() => setEditDeadLine(false)} autoFocus />}
      
      {!editPlanedTime && <Time onClick={() => setEditPlanedTime(true)}>予定{planedTime}h/</Time>}
      {editPlanedTime && <Input type="number" value={Number(planedTime)} onBlur={() => setEditPlanedTime(false)} autoFocus />}
      
      {!editActualTime && <Time onClick={() => setEditActualTime(true)}>実績{actualTime}h</Time>}
      {editActualTime && <Input type="number" value={Number(actualTime)} onBlur={() => setEditActualTime(false)} autoFocus />}
      
      {!editBody && <Body onClick={() => setEditBody(true)}>{body}</Body>}
      {editBody && <Input type="text" value={body} onBlur={() => setEditBody(false)} autoFocus />}
      
      {/* <span>{props.item.updated_at}</span> */}
      {/* <span>{props.item.created_at}</span> */}
    </ItemBody>
  </Item>)
};
export default PostItem;