import React, { useState, useMemo } from 'react'

export const UseMemoSample = () => {
  const [text, setText] = useState('')
  const [items, setItems] = useState<string[]>([])

  const onChangeInput = (e: React.ChangeEvent<HTMLInputElement>) => {
    setText(e.target.value)
  }

  const onClickButton = () => {
    setItems((prevItems) => {
      return [...prevItems, text]
    })
    setText('')
  }

  const numberOfCharacters1 = items.reduce((sub, item) => sub + item.length, 0)

  //useMemoを使ってitemsが更新されるタイミングでitems.reduceを実行する
  const numberOfCharacters2 = useMemo(() => {
    return items.reduce((sub, item) => sub + item.length, 0)
  },[items])

  return (
    <div>
      <div>
        <input type="text" value={text} onChange={onChangeInput} />
        <button onClick={onClickButton}>Add</button>
      </div>
      <div>
        {items.map((item, index) => (<p key={index}>{item}</p>))}
      </div>
      <p>Total Number of Charcters1: {numberOfCharacters1}</p>
      <p>Total Number of Charcters2: {numberOfCharacters2}</p>
    </div>
  )
}