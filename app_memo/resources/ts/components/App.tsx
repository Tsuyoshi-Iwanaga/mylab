import React from 'react';
import ReactDOM from 'react-dom';
import Header from './Header';
import Footer from './Footer';

function App() {
    return (
        <>
        <Header />
        <Footer />
        </>
    );
}
export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
