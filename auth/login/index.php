<?php
require "../db.php";
$data = $_POST;

$errors = [];
$error = '';
if(isset($data['signup'])){
    $phone = preg_replace('/[^0-9]/', '', $data['phone']);
    $user = R::findOne('users', 'phone = ?', [$phone]);
    if(!$user){
        $error = 'Бұл номер жүйеде тіркелмеген';
    }
    else{
        if(password_verify($data['password'], $user['password'])){
            $_SESSION['user_id'] = $user->id;
            header('Location: ../../index.php');
        }
        else{
            $error = 'Құпия сөзіңіз қате';
        }
    }

}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atatek || Тіркелу</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="../main.css">
</head>
<body>
<div class="container">
    <div class="auth_block">
        <div class="auth_img">
            <img src="../image%201.png" width="502" alt="">
        </div>
        <div class="auth_form">
            <form method="POST" class="needs-validation" novalidate>
                <h3 class="logo mb-4">Ататек</h3>
                <h2 class="mb-4">Жүйеге кіру</h2>
                <?= $error?>

                <div class="abm-standart">
                    <input type="text" autocomplete="off" name="phone"  id="phone-mask" required value="+7" placeholder="+7 777 777 77 77" class="form-control">
                </div>

                <div class="abm-standart">
                    <input type="password" autocomplete="off" name="password" required placeholder="Құпия сөз" class="form-control">
                </div>
                <div>
                    <button name="signup" class="btn btn-primary w-100">Жүйеге кіру</button>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <div>Аккаунтыңыз жоқ па?</div>
                    <div><a href="../signup" class="a-link">Тіркелу</a></div>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script !src="">
    IMask(
        document.getElementById('phone-mask'),
        {
            mask: '+{7} (000) 000-00-00'
        }
    )
</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>