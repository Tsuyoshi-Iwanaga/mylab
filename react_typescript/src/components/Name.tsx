import React from 'react'

const Name = () => {
  const onChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    console.log(e.target.value)
  }

  return (
    //styleオブジェクトのキーはキャメルケースになります
    <div style={{padding: '16px', backgroundColor: 'gray'}}>
      {/* forの代わりにhtmlFor */}
      <label htmlFor="name">名前</label>
      {/* classやonchangeの代わりにclassName,onChangeを使います */}
      <input id="name" className="input-name" type="text" onChange={onChange} />
    </div>
  )
}

export default Name