import * as React from 'react';
import * as ReactDOM from 'react-dom';

//props state
interface AppProps {
}

interface AppState {
  counters: Counter[];
  total: number;
}

interface CounterProps {
  counter: Counter;
  key: string;
  countUp: (key:string) => void;
}

interface CounterListProps {
  counters: Counter[];
  countUp: (key:string) => void;
}

interface Counter {
  id: string;
  count: number;
  color: string;
}

//カウンター
const Counter = (props: CounterProps) => {
  return(
    <li style={{backgroundColor: props.counter.color}} onClick={() => {props.countUp(props.counter.id)}}>
      {props.counter.id}-{props.counter.count}
    </li>
  );
}

//カウンターリスト
const CounterList = (props: CounterListProps) => {
  const counters = props.counters.map((counter: Counter) => {
    return (
      <Counter counter={counter} key={counter.id} countUp={props.countUp} />
    );
  });

  return(
    <ul>{counters}</ul>
  );
}

//本体
class App extends React.Component<AppProps, AppState> {
  constructor(props: AppProps) {
    super(props);
    this.state = {
      counters: [
        {id: 'A', count: 0, color: 'tomato'},
        {id: 'B', count: 0, color: 'skyblue'},
        {id: 'C', count: 0, color: 'limegreen'},
        {id: 'D', count: 0, color: 'gray'},
        {id: 'E', count: 0, color: 'pink'}
      ],
      total: 0
    };
    this.countUp = this.countUp.bind(this);
  }

  private countUp(key:string) {
    this.setState((prevState: AppState):AppState => {
      const afterState = Object.assign({}, prevState, {total: ++prevState.total});
      afterState.counters.map((hoge: Counter) => {
        if(hoge.id === key) {
          hoge.count++;
        }
      });
      return afterState;
    });
  }

  public render() {
    return (
      <div className="container">
        <CounterList counters={this.state.counters} countUp={this.countUp}/>
        <div>Total Inventory: {this.state.total}</div>
      </div>
    );
  }
}

ReactDOM.render(
  <App />,
  document.getElementById('root')
);
