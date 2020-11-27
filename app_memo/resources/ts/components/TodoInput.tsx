import React, { useState } from 'react'
import styled from 'styled-components'
import { addTodo } from '../functions/client'
import { useDispatch } from 'react-redux'
import { AppDispatch } from '../store'
import { add } from '../store/todoSlice'

const BodyInput = styled.input`
`;
const PlanedTimeInput = styled.input`
`;
const Button = styled.button`
`;

const TodoInput: React.FC = () => {
  const [body, setBody] = useState("")
  const [planedTime, setplanedTime] = useState(0.5)
  const dispatch:AppDispatch = useDispatch()

  const postTodo = (body: string, planedTime:number) => {
    addTodo(body, planedTime)
    .then((res) => {
      dispatch(add(res.data))
    })
  }

  return (
    <div className="form-group row">
      <div className="col-md-8 text-md-left">
        <BodyInput
          type="input"
          className="form-control"
          value={body}
          onChange={event => setBody(event.target.value)}
          name="body"
          autoFocus
        />
      </div>
      <div className="col-md-2 text-md-left">
        <PlanedTimeInput
          type="number"
          className="form-control"
          name="planed_time"
          value={planedTime}
          onChange={event => setplanedTime(Number(event.target.value))}
          autoFocus
          step="0.25"
          placeholder="1h"
        />
      </div>
      <div className="col-md-2 text-md-left">
        <Button onClick={() => postTodo(body, planedTime)} className="btn btn-primary">追加</Button>
      </div>
    </div>
  )
}
export default TodoInput;