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
      <table>
        <tbody>
          {
            data.map(function(item, i) {
              return (
                <tr key={i}>
                  <th>{item.asin}</th>
                  <td>{item.title}</td>
                  <td>{item.price}</td>
                  <td>{item.stock}</td>
                </tr>
              );
            })
          }
        </tbody>
      </table>
    </div>
  );
}
