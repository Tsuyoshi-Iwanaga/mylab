import React from 'react';
import ReactDOM from 'react-dom';
import Header from './Header';
import Main from './Main';
import SideNav from './SideNav';
import Footer from './Footer';

function App() {
    return (
        <>
        <Header />
        <main className="py-4">
            <div className="container">
                <div className="row justify-content-center">
                    <Main />
                    <SideNav />
                </div>
            </div>
        </main>
        <Footer />
        </>
    );
}
export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
