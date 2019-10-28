import Axios from 'axios';

interface Header {
  'Content-Type': string;
  'Access-Control-Allow-Origin': string;
}

const axios = Axios.create({
  baseURL: './',
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  },
  responseType: 'json'  
});

export default async function fetchData(url:string) {
  const res = await axios.get<object>(url)
  return res
}