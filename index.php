<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();

            if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
                try {
                    $conexao = "mysql:dbname=banco_de_empresa;host=localhost";
                    $user = "root";
                    $pass = "";
                    
                    $pdo = new PDO($conexao, $user, $pass);
                    
                    $sql = "select * from funcionarios";
                    
                    $sql = $pdo->query($sql);
                    
                    
                } catch (PDOException $ex) {
                    echo "Falhou: " . $ex->getMessage();
                }
                
                
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nome</th>";
                echo "<th>Login</th>";
                echo "<th>Senha</th>";
                echo "<th>Cargo</th>";
                echo "<th>Sigla do Cargo</th>";
                echo "</tr>";
               

                
                
                echo "</table>";
            } else {
                header("Location: login.php");
            }
        ?>
    </body>
</html>
