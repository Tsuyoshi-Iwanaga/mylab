import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import Name from './components/Name';
import Hello from './components/Hello';
import Message from './components/Message';
import ChildrenSample from './components/ChildrenSample';
import ContextSample from './components/ContextSample';
import Counter from './components/HookSample001';
import Counter2 from './components/HookSample002';
import { Counter3 } from './components/HookSample003';
import { UseMemoSample } from './components/HookSample004';
import { Clock } from './components/HookSample005';
import UserDisplay from './components/HookSample006';
import ImageUploader from './components/HookSample007';
import ShowDateTime from './components/HookSample008';
import { InputBlock } from './components/HookSample009';
import reportWebVitals from './reportWebVitals';

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
  <React.StrictMode>
    <h1>Learning React</h1>
    <h2>Basic</h2>
    <Hello content="Hi" />
    <Name />
    <Message />
    <ChildrenSample />
    <ContextSample />
    <h2>Hooks</h2>
    <Counter initialValue={0}/>
    <Counter2 initialValue={0}/>
    <Counter3 />
    <UseMemoSample />
    <Clock />
    <UserDisplay />
    <ImageUploader />
    <ShowDateTime />
    <InputBlock />
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
