<?php header("Access-Control-Allow-Origin: *");
      session_start();

    $user = 'root';
    $pass = '';
    $banco = 'virtuallibrary';
    $server = 'localhost';
    $conn = new mysqli($server, $user, $pass, $banco);
    if(!$conn){
        echo 'Erro de conexão: '.$conn->error;
    }

    function Login($email, $senha, $tipo){
        $sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha = "'.$senha.'"';
        $res = $GLOBALS['conn']->query($sql);

        if($res->num_rows > 0){
            $retorno['erro'] = false;
            $user = $res->fetch_object();
            $retorno['dados'] = $user;
        }else{
            $retorno['erro'] = true;
        }

        if($tipo == "json"){
            return json_encode($retorno);
        }else{
            return $retorno;
        }
    }

    function CadastrarUsuario($rm,$nome,$email,$senha,$userstatus,$adm){
        $sql = 'INSERT INTO usuario(rm, nome, email, senha, user_status, adm) VALUES ('.$rm.',"'.$nome.'","'.$email.'","'.$senha.'","'.$userstatus.'","'.$adm.'")';
        $destino = 'usuario/fotos/'.$rm;
        if (is_dir($destino)){
            mkdir($destino, 0777);
        }
        $res = $GLOBALS['conn']->query($sql);
        if($res){
          echo "Usuário cadastrado com sucesso!";
        }else{
          echo "Erro ao cadastrar";
        }
    }

    function MostrarUsuario(){
        $query = "SELECT rm, nome, email FROM usuario";
        $result = $GLOBALS['conn']->query($query);
        if($result){
            while($fetch = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($fetch as $field => $value) {
                echo '<td>'.$value.'</td>' ;
                }
            }
        }else{
            echo "Erro";
        }
    }

    function ExcluirUsuario($rm){
        $sql = 'DELETE FROM usuario WHERE rm = '.$rm;
        $res = $GLOBALS['conn']->query($sql);
  
        if($res)
          echo "Excluído com sucesso!";
        else 
          echo "Erro ao excluir";
    }

    function AtualizarUsuario($rm,$nome,$nasc,$gen,$tel){
        $sql = 'UPDATE usuario SET nome = "'.$nome.'",dt_nascimento = "'.$nasc.'", genero = "'.$gen.'", telefone = "'.$tel.'" WHERE rm ='.$rm;
        $res = $GLOBALS['conn']-> query($sql);
        if($res)
            echo "Atualizado com sucesso!";
        else
            echo "Erro ao atualizar";
    }
    
    function TrocarFoto($rm,$foto){
        $destino = 'usuario/fotos/'.$rm.'/'.$foto['name'];
        if(move_uploaded_file($foto['tmp_name'], $destino)){
            $sql = 'SELECT * FROM usuario WHERE rm = '.$rm;
            $res = $GLOBALS['conn']->query($sql);
            $user = $res->fetch_array();
            unlink($user['perfil']);
            $sql = 'UPDATE usuario SET perfil "'.$destino.'" WHERE rm = '.$rm;
            $res = $GLOBALS['conn']->query($sql);
                if($res){
                    echo "Atualizado com sucesso";
                }else{
                    echo "Erro ao atualizar foto";
            }
        }
    }

    function TrocarSenha($rm){
        $msg ='';
        $nova_senha = ""; //fazer método
        $sql = 'UPDATE usuario SET senha ="'.$nova_senha.'" WHERE rm = '.$rm;
        $res = $GLOBALS['conn']->query($sql);
        $user = $res->fetch_array();
            if(mail($user['email'], "Biblioteca [nova senha]",$msg)){
                $sql = 'UPDATE usuario SET senha = "'.$nova_senha.'" WHERE rm = '.$rm;
                $res = $GLOBALS['conn']->query($sql);
                    if($res){
                        echo "Nova senha encaminhada para seu email!";
                    }else{
                        echo "Erro ao trocar a senha. Tente novamente";
            }
        }
    }  

    function CadastrarGenero($nome){
        $sql = 'INSERT INTO genero VALUES (null, "'.$nome.'")';
        $res = $GLOBALS['conn']->query($sql);
        if($res){
            echo 'Genero Cadastrado';
        }else{
            echo 'Eroo ao Cadastrar: '.$GLOBALS['conn']->eror;
        }
    }

    function ExcluirGenero($cd){
        $sql = 'DELETE FROM genero WHERE cd = '.$cd;
        $res = $GLOBALS['conn']->query($sql);
        if($res){		
            echo 'Gênero Excluído';
        }else{
            echo 'Erro ao Excluir, verifique se há livros utilizando.';
        }
    }

    function ListarGenero($cd){
        $sql = 'SELECT * FROM genero';
        if($cd != ""){
            $sql.= ' WHERE cd = '.$cd;
        }
        $res = $GLOBALS['conn']->query($sql);	
        return $res;
    }

    function CadastrarAutor($nome){
        $sql = 'INSERT INTO autor VALUES (null, "'.$nome.'")';
        $res = $GLOBALS['conn']->query($sql);
        if($res){
            echo 'Autor Cadastrado';
        }else{
            echo 'Erro ao Cadastrar: '.$GLOBALS['conn']->error;
        }
    }

    function ListarAutor($cd){
        $sql = 'SELECT * FROM autor';
        if($cd != ""){
            $sql.= ' WHERE cd = '.$cd;
        }
        $res = $GLOBALS['conn']->query($sql);	
        return $res;
    }

    function ExcluirAutor($cd){
        $sql = 'DELETE FROM autor WHERE cd = '.$cd;
        $res = $GLOBALS['conn']->query($sql);
        if($res){		
            echo "Autor Excluído";
        }else{
            echo "Erro ao Excluir, verifique se há livros utilizando.";
        }
    }

    function CadastrarEditora($nome){
        $sql = 'INSERT INTO editora VALUES (null, "'.$nome.'")';
        $res = $GLOBALS['conn']->query($sql);
        if($res){
            echo 'Editora Cadastrada';
        }else{
            echo 'Erro ao Cadastrar: '.$GLOBALS['conn']->error;
        }
    }

    function ExcluirEditora($cd){
        $sql = 'DELETE FROM editora WHERE cd = '.$cd;
        $res = $GLOBALS['conn']->query($sql);
        if($res){		
            echo "Editora Excluída";
        }else{
            echo "Erro ao Excluir, verifique se há livros utilizando.";
        }
    }

    function ExibirEditora($cd){
        $sql = 'SELECT * FROM editora';
        if($cd != ""){
            $sql.= ' WHERE cd = '.$cd;
        }
        $res = $GLOBALS['conn']->query($sql);	
        return $res;
    }

    function ListarLivro ($cd){
        $sql = 'SELECT * FROM livro';
        if ($cd>0){
            $sql.= 'WHERE cd='.$cd;
        }
        $res = $GLOBALS ['conn']->query($sql);
        return $res;
    }

    function CadastrarLivro($isbn, $titulo, $ano, $qtd, $sinopse, $classificacao, $id_editora, $id_genero, $estado, $capa){
        $sql = 'INSERT INTO livro(isbn, titulo, ano, qtd, sinopse, classificacao, id_editora, id_genero, estado, capa) VALUES ("'.$isbn.'","'.$titulo.'","'.$ano.'","'.$qtd.'","'.$sinopse.'","'.$classificacao.'","'.$id_editora.'","'.$id_genero.'","'.$estado.'","'.$capa.'")';
        $res = $GLOBALS['conn']->query($sql);
        if($res){
          echo "Livro cadastrado com sucesso!";
        }else{
          echo "Erro ao cadastrar";
        }
    }

    function ExcluirLivro($cd){
        $sql = 'DELETE FROM livro WHERE cd ='.$cd;
        $res = $GLOBALS['conn']->query($sql);
        if($res){
          echo "Livro excluído";
        } else {
          echo "Erro ao excluir";
        }
    }

?>