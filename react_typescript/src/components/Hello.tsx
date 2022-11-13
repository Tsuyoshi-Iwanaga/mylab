const Hello = (props: {content: string}) => {
  const onClick = () => {
    alert('Hello')
  }
  const text = props.content

  return (
    <div onClick={onClick}>{text}</div>

  )
}

export default Hello