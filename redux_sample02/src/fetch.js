export default function fetchData(text) {
  return fetch(`./src/data/20191011134125.json`)
  .then(res => res.json())
  .catch(error => {error});
}