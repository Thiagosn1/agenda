<?php
include "conectaBanco.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de contatos</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/messages_pt_BR.js"></script>
    <script src="js/pwstrength-bootstrap.js"></script>
    <style>
        html {
            height: 100%;
        }

        body {
            background: url('img/dark-blue-background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="h-100 row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-sm"></div>
                <div class="col-sm-10">
                    <?php
                    if (isset($_POST['acao'])) {
                        $acao = $_POST['acao'];

                        if ($acao == "salvar") {
                            $nomeUsuario = $_POST['nomeUsuario'];
                            $mailUsuario = $_POST['mailUsuario'];
                            $mail2Usuario = $_POST['mail2Usuario'];
                            $senhaUsuario = $_POST['senhaUsuario'];
                            $senha2Usuario = $_POST['senha2Usuario'];

                            $senhaUsuarioMD5 = md5($senhaUsuario);

                            $sqlNovoUsuario = "INSERT INTO usuarios (nomeUsuario, mailUsuario, senhaUsuario) VALUES(:nomeUsuario, :mailUsuario, :senhaUsuario)";

                            $sqlNovoUsuarioST = $conexao->prepare($sqlNovoUsuario);
                            $sqlNovoUsuarioST->bindValue(':nomeUsuario', $nomeUsuario);
                            $sqlNovoUsuarioST->bindValue(':mailUsuario', $mailUsuario);
                            $sqlNovoUsuarioST->bindValue(':senhaUsuario', $senhaUsuarioMD5);
                            
                            $sqlNovoUsuarioST->execute();
                        }
                    }
                    ?>
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5>Cadastro de novo usuário</h5>
                        </div>
                        <div class="card-body">
                            <form id="novoUsuario" method="post" action="novoUsuario.php">
                                <input type="hidden" name="acao" value="salvar">
                                <div class="form-group">
                                    <label for="nomeUsuario">Nome*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="bi-people-fill"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" placeholder="Digite seu nome" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="mailUsuario">E-mail*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="bi-at"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="mailUsuario" name="mailUsuario" placeholder="Digite seu e-mail" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="mail2Usuario"> Repita o e-mail*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="bi-at"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="mail2Usuario" name="mail2Usuario" placeholder="Repita seu e-mail" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="senhaUsuario">Senha*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="password" class="form-control" id="senhaUsuario" name="senhaUsuario" placeholder="Digite sua senha" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="senha2Usuario"> Repita a senha*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="bi-key-fill"></i>
                                                    </div>
                                                </div>
                                                <input type="password" class="form-control" id="senha2Usuario" name="senha2Usuario" placeholder="Repita sua senha" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="campo_senha">
                                    <div class="col-sm barra_senha"></div>
                                    <div class="col-sm"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm text-right">
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm"></div>
            </div>
        </div>
    </div>
    <script>
        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        $(document).ready(function() {

            $("#novoUsuario").validate({
                rules: {
                    nomeUsuario: {
                        minlength: 5
                    },
                    mail2Usuario: {
                        equalTo: "#mailUsuario"
                    },
                    senha2Usuario: {
                        equalTo: "#senhaUsuario"
                    },
                    senhaUsuario: {
                        minlength: 8
                    }
                }
            });
            jQuery(document).ready(function() {
                "use strict";
                var options = {};
                options.ui = {
                    container: "#campo_senha",
                    viewports: {
                        progress: ".barra_senha"
                    },
                    showVerdictsInsideProgressBar: true
                };
                $('#senhaUsuario').pwstrength(options);
            });
        });
    </script>
</body>

</html>