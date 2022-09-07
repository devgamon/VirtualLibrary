<?php include('src/components/biblioteca.php'); ?>

   <link rel="stylesheet" href="src/styles/index.css">

    <div class="container">
        <div class="imgBox"><img src="assets/logo.png" alt="virtuallibrary"></div> 
        <h2>Login</h2>
        <span class="subtitle">Welcome back! Please enter your details.</span>
        
        <form method="POST">
            <div class="inputBox">
                <input type="email" name="login" id="login" placeholder="Email">
                <div class="underline"></div>
            </div>
            <div class="inputBox">
                <input type="password" name="senha" id="senha" placeholder="Password">
                <div class="underline"></div>
            </div>

            <div class="passwordF"><a href="#">Forgot password?</a></div>

            <input type="submit" value="Log in">
        </form>

        <div class="spanBox">
            <span>Don't have an account? <a href="#"><span style="color: #35187f;"> Sign up for free</span></a></span>
        </div>   
    </div>

    <?php
            if($_POST){
                $resultado = Login($_POST['login'], $_POST['senha'], "");
                if($resultado['erro']){
                    echo '<div class="warningBox">Usuário e/ou senha inválido!!</div>';
                }else{
                    $user = $resultado['dados'];
                    if($user->status == 'bloqueado'){
                        echo '<div class="warningBox">Usuário bloqueado!!</div>';
                    }else{
                        if($user->adm == 0){
                            $user = $resultado['dados'];
                            $_SESSION['rm'] = $user->rm;
                            $_SESSION['nome'] = $user->nome;
                            $_SESSION['email'] = $user->email;
                            $_SESSION['senha'] = $user->senha;
                            $_SESSION['perfil'] = $user->perfil;
                            $_SESSION['status'] = $user->status;
                            $_SESSION['adm'] = $user->adm;
                            echo '<script>location.href="src/pages/homeUser.php";</script>';
                            // header('location: 'src/pages/homeUser.php');
                        }else{
                            echo '<div class="goodBox">Bem Vindo!!</div>';
                            echo '<script>location.href="src/pages/homeAdm.php";</script>';
                            // header('location: 'src/pages/homeAdm.php');                          
                            // Não entendi o pq do "header('location')" não funcionar então tive que praticar gambiarras desculpa :)
                        }
                    }
                }
            }
        ?>

<script src="https://kit.fontawesome.com/07cc412226.js" crossorigin="anonymous"></script>
    