export default function fetchData(text) {
  return fetch(`xxxx`)
  .then(res => res.json())
  .catch(error => {error});
}