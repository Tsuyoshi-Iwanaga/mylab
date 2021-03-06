import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { AppDispatch } from '../store/';
import { update } from '../store/todoSlice';
import { updateTodo } from '../functions/client';
import styled from 'styled-components';

type TodoItemProps = {
  item: TodoItem
}

const Item = styled.li`
margin-bottom: 5px;
`;
const ItemBody = styled.div`
padding-bottom: 5px;
padding-top: 5px;
`;
interface statusProps {
  status: number
}
const Status = styled.span<statusProps>`
display: inline-block;
line-height: 1;
border-radius: 3px;
font-size: 12px;
margin-right: 5px;
padding: 3px;
color: #fff;
text-align: center;
${props =>props.status === 1 ? 'background: #6cbde6;': undefined}
${props =>props.status === 2 ? 'background: #ebc0af': undefined}
${props =>props.status === 3 ? 'background: #8fbc8f': undefined}
${props =>props.status === 4 ? 'background: #bfadeb': undefined}
${props =>props.status === 5 ? 'background: #ccc': undefined}
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
const Update = styled.span`
display: inline-block;
margin-left: 10px;
color: #3490dc;
cursor: pointer;
text-decoration: underline;
font-size: 12px;
`;

const TodoItem: React.FC<TodoItemProps> = (props) => {
  const [status, setStatus] = useState(Number(props.item.status));
  const [deadLine, setDeadLine] = useState(props.item.deadline);
  const [planedTime, setPlanedTime] = useState(props.item.planed_time);
  const [actualTime, setActualTime] = useState(props.item.actual_time);
  const [body, setBody] = useState(props.item.body);
  const [editDeadLine, setEditDeadLine] = useState(false);
  const [editPlanedTime, setEditPlanedTime] = useState(false);
  const [editActualTime, setEditActualTime] = useState(false);
  const [editBody, setEditBody] = useState(false);

  const dispatch: AppDispatch = useDispatch()

  const changeStatus = () => {
    if(status > 0 && status < 5) {
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
        return '対応中';
      case 3:
        return '確認中';
      case 4:
        return '保留';
      case 5:
        return '完了';
      default:
        return '-';
    }
  };

  const trimDeadLine = (deadLine: string|undefined): string => {
    if(!deadLine) return '';
    return deadLine.replace(/^(\d{4}-\d{1,2}-\d{1,2}).+$/, "$1" );
  }

  const updateItem = (data: TodoItem):void => {
    updateTodo(data)
    .then((res) => {
      console.log(res.data);
      dispatch(update(res.data));
    });
  }

  return (<Item className="card">
    <ItemBody className="card-body pt-1 pb-1">

      <Status onClick={changeStatus} status={status}>{statusText(status)}</Status>
      
      {!editDeadLine && <DeadLine onClick={() => setEditDeadLine(true)}>{trimDeadLine(deadLine)}</DeadLine>}
      {editDeadLine && <Input
        type="text"
        value={deadLine}
        onBlur={() => { setEditDeadLine(false)}}
        onChange={event => { setDeadLine(event.target.value) }}
        autoFocus
      />}
      
      {!editPlanedTime && <Time onClick={() => setEditPlanedTime(true)}>予定{planedTime}h/</Time>}
      {editPlanedTime && <Input
        type="number"
        value={Number(planedTime)}
        onBlur={() => { setEditPlanedTime(false)}}
        onChange={event => { setPlanedTime(event.target.value) }}
        step="0.25"
        autoFocus
      />}
      
      {!editActualTime && <Time onClick={() => setEditActualTime(true)}>実績{actualTime}h</Time>}
      {editActualTime && <Input
        type="number"
        value={Number(actualTime)}
        onBlur={() => { setEditActualTime(false)}}
        onChange={event => { setActualTime(event.target.value) }}
        step="0.25"
        autoFocus
      />}
      
      {!editBody && <Body onClick={() => setEditBody(true)}>{body}</Body>}
      {editBody && <Input
        type="text"
        value={body}
        onBlur={() => { setEditBody(false)}}
        onChange={event => { setBody(event.target.value) }}
        autoFocus
      />}

      <Update onClick={() => { updateItem(
        {
          id: props.item.id,
          author_id: props.item.author_id,
          status: String(status),
          deadline: deadLine,
          planed_time: planedTime,
          actual_time: actualTime,
          body: body,
        }
      )}}>更新</Update>

    </ItemBody>
  </Item>)
};
export default TodoItem;