import Axios from 'axios'

const baseURL = 'https://techblog.ray-beams.xyz'

const instance = Axios.create({
  baseURL,
  timeout: 10000,
})

export const fetchPosts = () => {
  return instance.get('/project', {
  });
}