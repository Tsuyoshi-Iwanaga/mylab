const http = require('http')

http.createServer(function (req, res) {
  if(req.url === "/" && req.method === "GET") {
    res.setHeader('Content-Type', 'text/plain;charset=utf-8')
    res.write('こんにちは')
    res.end()
  } else if (req.url === "/about" && req.method === "GET") {
    res.setHeader('Content-Type', 'text/plain;charset=utf-8')
    res.write('これはaboutのページです')
    res.end()
  } else if (req.url === "/hobby" && req.method === "GET") {
    res.setHeader('Content-Type', 'text/html')
    res.write('<form action="/outdoor" method="post"><input type="text" name="sports"><button type="submit">Submit</button></form>')
    res.end()
  } else if (req.url === "/outdoor" && req.method === "POST") {
    let data = ""
    req.on('data', function(chunk) { data += chunk })
      .on('end', function(){
        res.setHeader('Content-Type', 'text/plain;charset=utf-8')
        res.write(data)
        res.end()
      })
  }
}).listen(4000, function() {
  console.log('server is ready...')
})