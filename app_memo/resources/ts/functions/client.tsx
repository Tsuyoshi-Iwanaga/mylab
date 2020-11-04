import Axios, { AxiosInstance, AxiosResponse } from 'axios'

type PostItem = {
  id: number,
  author_id?: string,
  status?: string,
  deadline?: string,
  planed_time?: string,
  actual_time?: string,
  body?: string,
  updated_at?: string,
  created_at?: string,
}

const baseURL = '/'

const instance: AxiosInstance = Axios.create({
  baseURL,
  timeout: 10000,
})

export const fetchPosts = ():Promise<AxiosResponse<Array<PostItem>>> => {
  return instance.get('/todo/get');
}