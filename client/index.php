<?php
require_once ("css.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <label for="profile_pic">Choose file to upload</label>
            <input type="file" id="profile_pic" name="profile_pic"
                accept=".jpg, .jpeg, .png">
        <div>
            <button id="sub1">Submit</button>
        </div>
        <div>
            <img id="upload-img" />
        </div>
</body>
</html>
<script>
$("#profile_pic").change(function(e) {
    let img=e.target.files[0];
    handleFiles(img)
})

$("#sub1").on("click", function () {
  let img=$("#profile_pic").prop('files')[0];
  if (img==null) {
    return;
  }
  let reader = new FileReader();
  let tex;
  reader.readAsDataURL(img); //轉base64
  reader.onload = function () {
    tex= reader.result;
    tex=JSON.stringify(tex); //物件轉字串
    tex=tex.slice(24,-1);
    tex=base64ToHex(tex); //轉HEX
    tex="0x"+tex;
    let form = new FormData();
    form.append("123", tex);
    axios.post("doimgInsert.php", form)
    .then(function (a) {
        console.log(a.data);
    })
  };
})
const imgDOM = document.getElementById('upload-img');

function createImageFromFile(img, file) {
  return new Promise((resolve, rejfect) => {
    img.src = URL.createObjectURL(file);
    img.onload = () => {
      URL.revokeObjectURL(img.src);
      resolve(img);
    };
    // img.onerror = () => reject('Failure to load image.');
  });
}

function handleFiles(a) {
  if (a==null) {
   
    imgDOM.height = 0;
    imgDOM.width = 0;
  }
  else
  createImageFromFile(imgDOM, a).then(img => {
    img.height = 150;
    img.width = 150;
  });
}

function base64ToHex(str) {
  const raw = atob(str);
  let result = '';
  for (let i = 0; i < raw.length; i++) {
    const hex = raw.charCodeAt(i).toString(16);
    result += (hex.length === 2 ? hex : '0' + hex);
  }
  return result;
}
</script>