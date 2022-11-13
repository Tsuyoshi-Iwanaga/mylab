import React from "react"

type ContainerProps = {
  title: string,
  children: React.ReactNode
}

const Children = (props: ContainerProps): JSX.Element => {
  const { title, children } = props

  return (
    <div style={{ background: 'pink'}}>
      <span>{title}</span>
      {/* propsのchildrenを埋め込むと、このコンポーネントの開始タグと閉じタグで囲んだ要素を表示 */}
      <div>{children}</div>
    </div>
  )
}

const Parent = (): JSX.Element => {
  return (
    <Children title="Hello">
      <p>ここの部分が背景色で囲まれる</p>
    </Children>
  )
}

export default Parent