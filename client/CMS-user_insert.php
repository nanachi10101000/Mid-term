<?php
require_once ("css.php");
require_once("CMStemplateAcss.php");
require_once ("../partials/nav-bar/sidebar.php");
?>

<!doctype html>
<html lang="en">
<head>
    <title>client_insert</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="page_box">
    <div class="title display-6 text-start fw-bold">
        新增顧客資料
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="mb-2">
                    <label for="">姓名</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="mb-2">
                    <label for="">頭像</label>
                    <br>
                    <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
                    <img id="upload-img" />
                </div>
                <div class="mb-2">
                    <label for="">信箱地址</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="mb-2">
                    <label for="">密碼</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="mb-2">
                    <label for="">身分證字號</label>
                    <input type="text" class="form-control" id="id_number">
                </div>
                <div class="mb-2">
                    <label for="">性別</label>
                    <select class="form-select" id="gender">
                        <option value="1">男</option>
                        <option value="0">女</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="">出生日期</label>
                    <input type="date" class="form-control" id="birth">
                </div>
                <div class="mb-2">
                    <label for="">住址</label>
                    <input type="text" class="form-control" id="address">
                </div>
                <div class="mb-2">
                    <label for="">電話號碼</label>
                    <input type="text" class="form-control" id="telephone">
                </div>
                <button type="button" class="btn btn-primary">送出</button>
            </div>
        </div>
    </div>
</body>
<script>
$(".btn-primary").on("click", function () {
    let name = $('#name').val();
    let email = $(`#email`).val();
    let password = $(`#password`).val();
    let id_number = $(`#id_number`).val();
    let gender = $('#gender').val();
    let birth = $('#birth').val();
    let address = $(`#address`).val();
    let telephone = $(`#telephone`).val();
    let formData = new FormData();
    let img=$("#photo").prop('files')[0];
    if (password.length < 8) {
        alert("密碼太短");
        return;
    } else if(telephone.length != 10) {
        alert("電話號碼錯誤");
        return;
    } else if (id_number.length != 10) {
        alert("身分證格式錯誤");
        return;
    };
    formData.append("name", name);
    formData.append("email", email);
    formData.append("password",password);
    formData.append("id_number", id_number);
    formData.append("gender", gender);
    formData.append("birth", birth);
    formData.append("address", address);
    formData.append("telephone", telephone);
    if(name==''||email==''||password==''||id_number==''||address==''||telephone==''||birth==''||img==null){
        alert("請輸入完整資料");
        return;
    }
    axios.post("doinsert.php", formData)
    .then(function () {
    })

    // 存照片
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
        form.append("photo", tex);
        form.append("email", email);
        axios.post("doimgInsert.php", form)
        .then(function (a) {
            window.location.href='CMS-template-A.php';
            alert("新增成功");
        })
    };
})
</script>
<script>
$("#photo").change(function(e) {
    let img=e.target.files[0];
    handleFiles(img)
})

const imgDOM = document.getElementById('upload-img');

function createImageFromFile(img, file) {
  return new Promise((resolve, rejfect) => {
    img.src = URL.createObjectURL(file);
    img.onload = () => {
      URL.revokeObjectURL(img.src);
      resolve(img);
    };
    img.onerror = () => reject('Failure to load image.');
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
</html>