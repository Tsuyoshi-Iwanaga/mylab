//XMLHttpRequest
let getURL = (URL) => {
  return new Promise((resolve, reject) => {
    //generate XMLHttpRequest
    let req = new XMLHttpRequest();
    //open
    req.open('GET', URL, true);
    //request
    req.onload = () => {
      if(req.status === 200) {
        let result = JSON.parse(req.responseText);
        resolve(result);
      } else {
        reject(new Error(req.statusText));
      }
    }
    //send request
    req.send();
  })
}