import { fork, call, take, put, takeEvery, takeLatest } from 'redux-saga/effects'
import fetchData from './fetch';
  import { registerData } from './actions/tasks';

export function* sendRequest() {
  const payload = yield call(fetchData);
  yield put(registerData(payload))
}

export default function* rootSaga() {
  yield fork(sendRequest);
} 