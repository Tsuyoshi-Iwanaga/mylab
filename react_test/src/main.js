import React from "react";
import ReactDOM from "react-dom";

import { Sub01 } from "./sub01";

class App extends React.Component {
  render() {
    return (
      <div>
        <h1>Hello React!</h1>
        <Sub01 />
      </div>
    );
  }
}
ReactDOM.render(<App />, document.querySelector("#app"));
