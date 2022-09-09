<?php include('../components/biblioteca.php'); ?>

    <link rel="stylesheet" href="../styles/cadastros.css">

    <div class="container">
        <nav class="navbar">
            <div class="logoBox"><img src="https://virtuallibrary.profrodolfo.com.br/public/logoW.png" alt="virtuallibrary"></div>
            <ul>
                <li>
                    <a href="homeAdm.php">
                        <i class="fa-solid fa-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="autor.php">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Autores</span>
                    </a>
                </li>
                <li>
                    <a href="genero.php">
                        <i class="fa-solid fa-address-book"></i>
                        <span>Gêneros</span>
                    </a>
                </li>
                <li>
                    <a href="editora.php">
                        <i class="fa-solid fa-marker"></i>
                        <span>Editoras</span>
                    </a>
                </li>
                <li>
                    <a href="book.php">
                        <i class="fa-solid fa-book"></i>
                        <span>LIvros</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log out</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="containerGen">
            <div class="header">
                <h2>Autores Cadastrados</h2>
                <p>Você pode adicionar, visualizar e editar novos autores.</p>
            </div>

            <div class="modalContainer">
                <button class="btnAdd" id="open-modal"><i class="fa-solid fa-plus"></i> Adicionar Autor</button>
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

            <br>
                
            <table>
                <tr>
                    <th>Autor</th>
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
                                <td><a href="?excluir_listAut='.$listAut->cd.'"><i class="fa-solid fa-trash-can"></i></a></td>
                               </tr>';
                    }
                ?>
            </table>
        </div>
    </div>

    <script src="../components/modal.js"></script>
    <script src="https://kit.fontawesome.com/07cc412226.js" crossorigin="anonymous"></script>