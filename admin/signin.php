<?php
    require 'connect.php';

    if (isset($_POST['login'])) {
        $stmt = $db->prepare('SELECT * FROM users WHERE login = :login AND pass = :pass');
        $stmt->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $_POST['pass'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row)) {
            $_SESSION['admin'] = array(
                'id' => $row['id'],
                'login' => $row['login'],
                'name' => $row['name'],
                'photo' => $row['photo'],
                'position_id' => $row['position_id'],
                'carrier_id' => $row['carrier_id'],
                'role_id' => $row['role_id'],
            );
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
                //$ip = '192.168.100.200';
            }
            $sql = 'UPDATE `users` SET `ip` = "'.$ip.'",  `last_login` = "'.date("Y-m-d H:i:s").'" WHERE id = '.$_SESSION['admin']['id'];
            $query = $db->query($sql);
            header('Location: index.php');
        } else {
            echo "Невірний логін або пароль!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <title>Signin</title>
  <meta name="description"
    content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/animate.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/app.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/signin.css" type="text/css"/>  

  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>


<body>  
    <div class="wp-login animated fadeInUp">
        <form action="" method="post" class="form login">
            <h2 class="navbar-brand block">Bus System</h2>
            <section class="panel-login">
                <p>Для входу в систему введіть ім'я користувача та пароль</p>
                <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" name="login" class="form-control" placeholder="Ім'я користувача" required>
                </div>
                <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" name="pass" class="form-control" placeholder="Пароль" required>
                </div>              
                <button type="submit" class="btn">Ввійти</button>                
            </section>
        </form>     
    </div>
    
</body>

</html>