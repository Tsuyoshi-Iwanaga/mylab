import React, { useState, useEffect } from "react";

export const Sub01 = () => {
  const [count, setCount] = useState(0)

  useEffect(() => {
    document.title = `You Clicked ${count} times`
  })

  return (
    <div>
      <p>You Clicked {count} times</p>
      <button onClick={() => setCount(count + 1)}>
        Click
      </button>
    </div>
  );
}

function useFriendStatus(friendID) {
  const [isOnline, setIsOnline] = useState(null)

  function handleStatusChange(status) {
    setIsOnline(status.isOnline)
  }

  useEffect(() => {
    
  })
  return isOnline
}

function FriendStatus(props) {
  const isOnline = useFriendStatus(props.friend.id)

  if(isOnline === null) {
    return 'Loading'
  }
  return isOnline ? 'Online' : 'Offline';
}
