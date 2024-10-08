<?php
require "php/db.php";
$profile = R::findOne('users', 'id = ?', [$_SESSION['user_id']]);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ататек</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css?v=<?= time()?>">
    <style>
        .container{
            width: 100%;
            max-width: 90%;
            margin: 0 auto;
        }
        section.main{
            padding-top: 150px;
        }
        .form{
            display: none;
        }
    </style>
</head>
<body>
<div class="head-cont">
    <div class="header">
        <div class="header-container">
            <div class="d-flex gap-5 align-items-center">
                <div class="p-2 brand">ATATEK</div>
                <div class="p-2 nav d-flex gap-5">
                    <a href="index.php" class="nav_links">Шежіре</a>
                    <a href="my.php" class="nav_links"><?=R::findOne('tree', 'item_id = ?', [$profile->ru])->name?></a>
                    <a href="" class="nav_links">Менің әулетім</a>
                    <a href="" class="nav_links"><?=R::findOne('tree', 'item_id = ?', [$profile->ru])->name?> жаңалықтары</a>
                    <a href="" class="nav_links">Статистика</a>
                </div>
                <div class="ms-auto p-2">
                    <a href="profile.php">
                        <img src="images/avatar.png" width="55" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="text-center mt-3">
                            <div class="chat-avtar d-inline-flex mx-auto">
                                <img class="rounded-circle img-fluid wid-90 img-thumbnail" width="150" src="images/avatar.png" alt="User image">
                            </div>
                            <h5 class="mb-0"><?= $profile->name . " " . $profile->surname . " " . $profile->lastname?></h5>
                        </div>
                        <hr>
                        <div class="profile-navs mt-4 d-flex flex-column">
                            <?if($profile->admin == 1):?>
                            <a href="admin/" class="profile-nav-links" data-tab="home">Админ</a>
                            <?endif;?>
                            <?if($profile->role == 4):?>
                                <a href="moderator/" class="profile-nav-links" data-tab="home">Модератор</a>
                            <?endif;?>
                            <a class="profile-nav-links switch" data-tab="home">Басты мәліметтер</a>
                            <a class="profile-nav-links switch" data-tab="form">Мәліметтерді ауыстыру</a>
                            <a href="auth/next/index.php?back=<?= urlencode('http://' . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'])?>" class="profile-nav-links" data-tab="ruedit">Руды ауыстыру</a>
                            <a class="profile-nav-links" data-tab="pass">Құпия сөзді өзгерту</a>
                            <a href="logout.php" class="profile-nav-links" data-tab="pass">Жүйеден шығу</a>

                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-header">
                        <h5 class="m-0 p-0">Жеке ақпарат</h5>
                    </div>
                    <div class="card-body position-relative">
                        <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                            <p class="mb-0 text-muted me-1">Телефон</p>
                            <p class="mb-0"><?= $profile->phone?></p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-between w-100">
                            <p class="mb-0 text-muted me-1">Ру</p>
                            <p class="mb-0"><?=R::findOne('tree', 'item_id = ?', [$profile->ru])->name?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0 p-0" id="card-title">Басты</h5>
                    </div>
                    <div class="card-body">
                        <form action="php/profile.php" method="POST">
                            <ul class="list-group list-group-flush tabs" id="home">
                                <li class="list-group-item px-0 pt-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted">Есімі</p>
                                            <p class="mb-0"><?= $profile->name?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted">Тегі</p>
                                            <p class="mb-0"><?= $profile->surname?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted">Әкесінің аты</p>
                                            <p class="mb-0"><?= $profile->lastname?></p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Қала / Ауыл</p>
                                            <p class="mb-0"><?= $profile->city?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Телефон номер</p>
                                            <p class="mb-0"><input type="text" class="form-phone-mask" readonly id="phone-mask" value="<?= $profile->phone?>"></p>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                            <ul class="list-group list-group-flush tabs" style="display: none" id="form">
                                <li class="list-group-item px-0 pt-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted">Есіміңіз</p>
                                            <p class="mb-0">
                                                <input type="text" class="form-control" value="<?= $profile->name?>" name="name">

                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted">Тегіңіз</p>
                                            <p class="mb-0">
                                                <input type="text" class="form-control" value="<?= $profile->surname?>" name="surname">
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted">Әкеңіздің аты</p>
                                            <p class="mb-0">
                                                <input type="text" class="form-control" value="<?= $profile->lastname?>" name="lastname">
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Қала / Ауыл</p>
                                            <p class="mb-0">
                                                <input type="text" class="form-control" value="<?= $profile->city?>" name="city">
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Телефон номер</p>
                                            <p class="mb-0">
                                                <input type="text" class="form-control" id='second-mask' value="<?= $profile->phone?>" readonly>
                                            </p>
                                        </div>

                                    </div>
                                </li>

                                <li class="list-group-item px-0 text-end">
                                    <button class="btn btn-success">Өзгерту</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0 p-0">Ру</h5>
                    </div>
                    <div class="card-body">
                        <div class="tree-data" style="font-weight: 600; font-size: 18px">
                            <?php

                            $treeData = [];
                            $child = R::findOne('tree', 'item_id = ?', [$profile->ru]);

                            while ($child) {
                                $treeData[] = $child->name;

                                // Проверяем, есть ли родитель
                                if ($child->parent_id == null) {
                                    break;
                                }

                                // Получаем родителя
                                $child = R::findOne('tree', 'item_id = ?', [$child->parent_id]);
                            }
                            $treeTrueData = array_reverse($treeData);
                            $ancestor_count = count($treeTrueData);
                            $current_index = 0;
                            foreach ($treeTrueData as $key){
                                echo $key;
                                if (++$current_index < $ancestor_count) {
                                    echo " &#8594; ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script !src="">
    IMask(
        document.getElementById('phone-mask'),
        {
            mask: '+{7} (000) 000-00-00'
        }
    )
    IMask(
        document.getElementById('second-mask'),
        {
            mask: '+{7} (000) 000-00-00'
        }
    )
    $(document).ready(function(){
        $('.switch').on('click', function(){
            $('.tabs').each(function() {
                $(this).hide();
            });
            $('#'+ $(this).data('tab')).show();
            $('#card-title').text($(this).text())

        })
    })
</script>
</body>
</html>
