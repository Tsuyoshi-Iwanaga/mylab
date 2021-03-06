;(function(){
  'use strict';

  const canvas = document.getElementById('canvas-container');
  canvas.width = canvas.clientWidth;
  canvas.height = canvas.clientHeight;
  const ctx = canvas.getContext('2d');

  //設定
  const density = 300;
  const particles = [];
  const colors = ['#D0A000', '#6DD0A5', '#E084C5'];
  
  //コンストラクタ
  var Particle = function(scale, color, speed) {
    this.scale = scale;
    this.color = color;
    this.speed = speed;
    this.position = {
      x: 100,
      y: 100
    }
  }
  Particle.prototype.draw = function () {
    ctx.beginPath();
    ctx.arc(this.position.x, this.position.y, this.scale, 0, 2 * Math.PI, false);
    ctx.fillStyle = this.color;
    ctx.fill();
  }

  //パーティクル量産
  for(var i=0; i < density; i++) {
    var scale = ~~(Math.random() * 5 ) + 3;
    var color = colors[~~(Math.random() * 3)];

    particles[i] = new Particle(scale, color, scale / 2);
    particles[i].position.x = Math.random() * canvas.width;
    particles[i].position.y = Math.random() * canvas.height;
    particles[i].draw();
  }

  //アニメーションループ
  loop();
  function loop() {
    requestAnimationFrame(loop);//16msに1回実行される
    ctx.clearRect(0, 0, canvas.width, canvas.height);//描画をクリア

    for(var i=0; i<density; i++) {
      particles[i].position.x += particles[i].speed;
      particles[i].draw();
      if (particles[i].position.x > canvas.width) particles[i].position.x = -30;//画面外にいったら戻る
    }
  }

})();