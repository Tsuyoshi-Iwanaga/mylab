import { useState } from 'react'

type CounterProps = {
  initialValue: number
}

const Counter = (props: CounterProps): JSX.Element => {
  const { initialValue } = props
  // 引数には初期値、countが現在値、setCountが状態を変更する関数
  const [count, setCount] = useState(initialValue)

  return (
    <div>
      <p>Count: {count}
      <button onClick={() => setCount((prevCount) => prevCount - 1)}>-</button>
      <button onClick={() => setCount(count + 1)}>+</button>
      </p>
    </div>
  )
}

export default Counter