import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { fetchAll } from '../store/memoSlice';
import { RootState } from '../store';
import { getMemos } from '../functions/client';
import Header from '../components/Header';
import Main from '../components/Main';
import SideNav from '../components/SideNav';
import Footer from '../components/Footer';
import MemoInput from '../components/MemoInput';
import MemoList from '../components/MemoList';

const Memo:React.FC = () => {

  const dispatch = useDispatch();
  const memos = useSelector((state: RootState) => state.memos );

  useEffect(() => {
    getMemos()
    .then((res) => {
      dispatch(fetchAll(res.data));
    });
  }, [dispatch]);

  return (
    <>
    {/* <Header /> */}
    <main className="py-4">
      <div className="container">
        <h2>メモ</h2>
        <div className="row justify-content-center">
          <Main>
            <MemoInput />
            <MemoList items={memos} />
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