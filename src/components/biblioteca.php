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

    /* Functions que futuramente emplementadas: CadastrarUser, ExcluirUser, AtualizarUser, TrocarFoto, TrocarSenha */

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

?>