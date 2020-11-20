import React, { useState } from 'react'

function Example() {
    const [count, setCount] = useState(0)

    rerurn (
        <div>
            <p>Clicked: {count}</p>
            <button onClick={() => setCount(count + 1)}>
                Click
            </button>
        </div>
    )
}