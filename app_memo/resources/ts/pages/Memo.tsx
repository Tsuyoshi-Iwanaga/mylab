import React, { useState, useEffect } from 'react';
import Header from '../components/Header';
import Main from '../components/Main';
import SideNav from '../components/SideNav';
import Footer from '../components/Footer';
import MemoInput from '../components/MemoInput';
import MemoList from '../components/MemoList';
import { getMemos } from '../functions/client';

const Memo:React.FC = () => {

  const iniPostItems: Array<MemoItem>|null = [];
  const [items, setItems] = useState(iniPostItems);

  useEffect(() => {
    getMemos()
      .then((res) => {
        setItems(res.data);
      });
  }, []);

  return (
    <>
    {/* <Header /> */}
    <main className="py-4">
      <div className="container">
        <h2>メモ</h2>
        <div className="row justify-content-center">
          <Main>
            <MemoInput />
            <MemoList items={items} />
          </Main>
          <SideNav />
        </div>
      </div>
    </main>
    <Footer />
    </>
  );
}
export default Memo;