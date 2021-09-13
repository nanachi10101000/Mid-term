
<script>
  <?php
    echo "let rows = [];";
    echo "rows[0] = '".$rows[0]['id']."';";  
    echo "rows[1] = '".$rows[0]['client_name']."';";
    echo "rows[2] = '".$rows[0]['email']."';";  
    echo "rows[3] = '".$rows[0]['password']."';";    
    echo "rows[4] = '".$rows[0]['id_number']."';";  
    echo "rows[5] = '".$rows[0]['gender']."';";  
    echo "rows[6] = '".$rows[0]['birth']."';";  
    echo "rows[7] = '".$rows[0]['address']."';";  
    echo "rows[8] = '".$rows[0]['telephone']."';";  
    ?>
    let list='<tr>';
    
    $('#target').empty();
    for (let index = 1; index < rows.length; index++) {
        list+="<td>"+rows[index]+"</td>";
    }
    list+="<td><button data-id='1' class=\"btn btn-primary text-white info-btn\" data-bs-toggle=\"modal\" data-bs-target=\"#user_update\">修改</button><button data-id='"+rows[0]+"' class=\"btn btn-danger text-white edit-btn\" data-bs-toggle=\"modal\" data-bs-target=\"#user_delete\">刪除</button></td></tr>";
    $('#target').html(list);
</script>


<?php foreach($rows as $value): ?>
                <tr id="list">
                  <td id='name_<?= $value["id"] ?>'> <?= $value["client_name"] ?> </td>
                  <td id='email_<?= $value["id"] ?>'> <?= $value["email"] ?> </td>
                  <td id=password_<?= $value["id"] ?>> <?= $value["password"] ?> </td>
                  <td id=id_number_<?= $value["id"] ?>> <?= $value["id_number"] ?> </td>
                  <td id=gender_<?= $value["id"] ?>> <?php  if($value["gender"]==1)
                                                                echo "男";
                                                            else
                                                                echo "女";?> </td>
                  <td id=birth_<?= $value["id"] ?>> <?= $value["birth"] ?> </td>
                  <td id=address_<?= $value["id"] ?>> <?= $value["address"] ?> </td>
                  <td id=telephone_<?= $value["id"] ?>> <?= $value["telephone"] ?> </td>
                  <td class="text-end" style="width: 150px;">
                      <button data-id="<?= $value["id"] ?>" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>
                      <button data-id="<?= $value["id"] ?>" class="btn btn-danger text-white edit-btn" data-bs-toggle="modal" data-bs-target="#user_delete">刪除</button>
                  </td>
                </tr>
              <?php endforeach; ?>

<script>
    $.ajax({
        method: "POST",
        url: "get_users_json.php",
        dataType: "json"
    }).done(function (data) {
        let list = "";
        data.forEach((user) => {
            
            list+=`<tr id="list">
            <td id='name_${user.id}'>${user.client_name}</td>
            <td id='email_${user.id}'>${user.email}</td>
            <td id='password_${user.id}'>${user.password}</td>
            <td id='id_number_${user.id}'>${user.id_number}</td>
            <td id='gender_${user.id}'>1</td>
            <td id='birth_${user.id}'>${user.birth}</td>
            <td id='address_${user.id}'>${user.address}</td>
            <td id='telephone_${user.id}'>${user.telephone}</td>
            <td class="text-end" style="width: 150px;">
                <button data-id="${user.id}" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>
                <button data-id="${user.id}" class="btn btn-danger text-white edit-btn" data-bs-toggle="modal" data-bs-target="#user_delete">刪除</button>
            </td></tr>`;
        })
        $("#target").append(userData)
    })
</script>

<button data-id="1" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>
<button data-id="1" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>