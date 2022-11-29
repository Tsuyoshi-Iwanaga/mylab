import React from 'react';

export default function TodoApp({ task, tasks, inputTask, addTask, data }) {
  return (
    <div>
      <input type="text" onChange={(e)=>inputTask(e.target.value)} />
      <input type="button" value="add" onClick={()=>addTask(task)} />
      <ul>
        {
          tasks.map(function(item, i) {
            return (
              <li key={i}>{item}</li>
            );
          })
        }
      </ul>
      <table border="1">
        <tbody>
          {
            data.map(function(item, i) {
              return (
                <tr key={i}>
                  <th>{item["xxx"]}</th>
                  <th>{item["yyy"]}</th>
                </tr>
              );
            })
          }
        </tbody>
      </table>
    </div>
  );
}
