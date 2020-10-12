import React from 'react'
import ReactDOM from 'react-dom'

interface MyComponentProps {
  defaultName?: string;
}

interface MyComponentState {
  name?: string;
}

class MyComponent extends React.Component<MyComponentProps, MyComponentState> {

  constructor(props: MyComponentProps) {
    super(props);
    this.state = {
      name: props.defaultName
    };
    this.handleInputChange = this.handleInputChange.bind(this);
  }

  private handleInputChange(event: React.FormEvent<HTMLInputElement>) {
    event.preventDefault();
    this.setState({name: event.currentTarget.value});
  }

  public componentDidMount() {
    console.log('Mounted!');
  }

  public render() {
    return (
      <form>
        <input type="text" value={this.state.name} onChange={this.handleInputChange} />
        <Preview name={this.state.name} />
      </form>
    );
  }
}

const Preview = ({name}: MyComponentState) => {
  return <p>{ "Hello" + name }</p>
}

ReactDOM.render(
  <MyComponent defaultName="Mike" />,
  document.getElementById('app')
)