;(function(){

  var outputImg = document.getElementById("js-drag");
  var outputSource = document.getElementById("js-dropShow");

  outputImg.addEventListener('dragover', ev => {
    ev.preventDefault();
    ev.dataTransfer.dropEffect = 'copy';
  });

  outputImg.addEventListener('drop', ev => {
    ev.preventDefault();

    var file = ev.dataTransfer.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', ev => {
      var image = document.createElement("img");

      image.src = ev.target.result;

      outputSource.appendChild(image);

    }, true);

    reader.readAsDataURL(file);
  });
})();
