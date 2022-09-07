<?php include('../components/biblioteca.php')?>

<link rel="stylesheet" href="../styles/cadastros.css">

<div class="container">
    <div class="header">
        <h2>Autores Cadastrados</h2>
        <p>Você pode adicionar, visualizar e editar novos autores.</p>
    </div>

    <div class="modalContainer">
        <button class="btnAdd" id="open-modal"><i class="fa-solid fa-plus"></i> Adicionar Gênero</button>
        <div id="fade" class="hide"></div>
            
        <div id="modal" class="hide">
            <div class="modal-header">
                <h2>Cadastrar Autor</h2>
                <button id="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <form method="POST">
                    <input type="text" name="autor" id="autor" placeholder="Digite um Autor">
                    <input type="submit" id="enviar" value="Enviar">
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['autor'])){
            CadastrarAutor($_POST['autor']);
    }
    ?>

    <table>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php
            if(isset($_GET['excluir_listAut'])){
                ExcluirAutor($_GET['excluir_listAut']);
            }

            $FuncAut = ListarAutor("");
            while($listAut = $FuncAut->fetch_object()){
                echo ' <tr>
                        <td>'.$listAut->nome.'</td>
                        <td> 
                            <a href="?excluir_listAut='.$listAut->cd.'"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                </tr>';
            }
        ?>
    </table>
</div>

<script src="../components/modal.js"></script>
<script src="https://kit.fontawesome.com/07cc412226.js" crossorigin="anonymous"></script>