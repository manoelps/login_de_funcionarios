<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            
            if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
                $login = formataInput($_POST['login']);
                $senha = md5(formataInput($_POST['senha']));

                $conexao = "mysql:dbname=banco_de_empresa;host=localhost";
                $user = "root";
                $pass = "";

                try {
                    $pdo = new PDO($conexao, $user, $pass);

                    $sql = "select login, senha from funcionarios where login = '$login' and senha = '$senha'";
                    $sql = $pdo->query($sql);

                    if ($sql->rowCount() > 0) {
                        $sql = $sql->fetch();
                        if ($login == $sql[0] && $senha == $sql[1]) {
                            $_SESSION['login'] = $login;
                            header("Location: index.php");
                        }
                    }
                } catch (PDOException $ex) {
                    echo "Falhou: " . $ex->getMessage();
                }
            }
            
            function formataInput($valor) {
                    $valor = addslashes($valor);
                    $valor = htmlspecialchars($valor);
                    return $valor;
            }
            
            
        ?>
        <form method="POST">
            <table>
                <tr>
                    <td>Login:</td>
                    <td><input type="text" name="login" required></td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="senha" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Acessar"></td>
                </tr>
            </table>
        </form>

    </body>
</html>
