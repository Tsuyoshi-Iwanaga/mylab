import React from 'react';
import { BrowserRouter as Router, Switch, Route, Link } from 'react-router-dom';
import Header from '../components/Header';
import Main from '../components/Main';
import SideNav from '../components/SideNav';
import Footer from '../components/Footer';

function Memo() {
  return (
    <>
    {/* <Header /> */}
    <main className="py-4">
        <div className="container">
            <h2>メモ</h2>
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
export default Memo;