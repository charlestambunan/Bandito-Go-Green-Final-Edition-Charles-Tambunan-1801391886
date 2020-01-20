<?php


//membangun dan Membuat Helper Hak Akses

function check($permision,$role){
    $access = getMyPermision($role);
    foreach($permision as $key => $value){
        if($value ==  $access){
            return true;
        }
    }
}

//untuk admin, seller dan buyer
function getMyPermision($id){
    switch ($id){
        case "admin":
            return "admin";
        break;
        case "seller":
            return "seller";
        break;
        case "buyer":
            return "buyer";
        break;
    }
}
