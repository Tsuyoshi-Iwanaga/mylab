import React from 'react';
import Header from '../components/Header';
import Main from '../components/Main';
import SideNav from '../components/SideNav';
import Footer from '../components/Footer';

function Todo() {
  return (
    <>
    {/* <Header /> */}
    <main className="py-4">
        <div className="container">
          <h2>Todo</h2>
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
export default Todo;