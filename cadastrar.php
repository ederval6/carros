<?php
/**
 * Projeto de aplicação Cadastro de veiculos
 *
 * EDERVAL DIAS DOS SANTOS
 */
 
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $celular = (isset($_POST["celular"]) && $_POST["celular"] != null) ? $_POST["celular"] : "";
    $cor = (isset($_POST["cor"]) && $_POST["cor"] != null) ? $_POST["cor"] :"";
    $modelo = (isset($_POST["modelo"]) && $_POST["modelo"] != null) ? $_POST["modelo"] : "";
    $ano = (isset($_POST["ano"]) && $_POST["ano"] != null) ? $_POST["ano"] : "";

    
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $email = NULL;
    $celular = NULL;
    $cor = NULL;
    $modelo = NULL;
    $ano = NULL;
}
 
// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=cadastro", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}
 
// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE veiculos SET Nome=?, E_mail=?, Celular=?,Cor=?,Modelo=?,ano=? WHERE id = ?");
            $stmt->bindParam(7, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO veiculos (Nome, E_mail, Celular,Cor,Modelo,ano) VALUES (?, ?,?,?,?,?)");
        }
       // $stmt->bindParam(0, $id);
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $celular);
        $stmt->bindParam(4, $cor);
        $stmt->bindParam(5, $modelo);
        $stmt->bindParam(6, $ano);
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<p>Dados cadastrados com sucesso!</p>";
                $id = null;
                $nome = null;
                $email = null;
                $celular = null;
                $cor = NULL;
                $modelo = NULL;
                $ano = NULL;
                        } else {
                echo "<p>Erro ao tentar efetivar cadastro</p>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
 
// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM veiculos WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->Nome;
            $email = $rs->E_mail;
            $celular = $rs->Celular;
            $cor = $rs->Cor;
            $modelo = $rs->Modelo;
            $ano = $rs->ano;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
 
// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM veiculos WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<b>Registo foi excluído com êxito</b>";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
<!DOCTYPE html>
    <html>
        <head>
            
            <meta charset="UTF-8">
            <title>Cadastro</title>
        </head>
        <style>
        body { background-color: red;}
        h1 p { font-size: 50px;}
        h1   {color:#FF0000;}
        input {color: red;}
        form { font-size: 20px;}
        form input { font-size:small}
        h1 p {text-align: center}
        a{background-color:greenyellow;}
        td{ background-color: #98FB98; }
        </style>
        <body style="background-color:#9ACD32">
            <form action="?act=save" method="POST"  >
                <h1><p>Cadastro de Veiculos</p></h1>
                <hr>
                <input type="hidden" name="id" <?php
                 
                // Preenche o id no campo id com um valor "value"
                if (isset($id) && $id != null || $id != "") {
                    echo "value=\"{$id}\"";
                }
                ?> />
                Nome:
               <input type="text" name="nome" <?php
 
               // Preenche o nome no campo nome com um valor "value"
               if (isset($nome) && $nome != null || $nome != "") {
                   echo "value=\"{$nome}\"";
               }
               ?> />
               E-mail:
               <input type="text" name="email" <?php
 
               // Preenche o email no campo email com um valor "value"
               if (isset($email) && $email != null || $email != "") {
                   echo "value=\"{$email}\"";
               }
               ?> />
               Celular:
               <input type="text" name="celular" <?php
 
               // Preenche o celular no campo celular com um valor "value"
               if (isset($celular) && $celular != null || $celular != "") {
                   echo "value=\"{$celular}\"";
               }
               ?> />
               Cor:
               <input type="text" name="cor" <?php
               // Preenche o cor no campo celular com um valor "value"
               if (isset($cor) && $cor != null || $cor != "") {
                echo "value=\"{$cor}\"";
                }
                ?> />
               Modelo:
               <input type="text" name="modelo" <?php
                // Preenche o Modelo no campo celular com um valor "value"
               if (isset($modelo) && $modelo != null || $modelo != "") {
                echo "value=\"{$modelo}\"";
                }
                ?> />
               Ano:
               <input type="text" name="ano"  <?php
                // Preenche o ano no campo celular com um valor "value"
               if (isset($ano) && $ano!= null || $ano != "") {
                echo "value=\"{$ano}\"";
                }
               ?> />
               <input type="submit" value="salvar" />
               <form method="post" action="carros.php">
               <hr>
                </form>
                <table width="100%" border="1px" bgcolor="#20B2AA"  >
                    <tr>
                    
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Cor</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>
                
                <?php
 
                    // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                    try {
                        $stmt = $conexao->prepare("SELECT * FROM veiculos");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo  "<td>".$rs->Nome.
                                "</td><td>".$rs->E_mail."</td><td>".$rs->Celular."</td><td>".$rs->Cor."</td><td>".$rs->Modelo."</td><td>".$rs->ano
                                        ."</td><td><center><a href=\"?act=upd&id=".$rs->id."\">[Alterar]</a>"
                                        ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                        ."<a href=\"?act=del&id=".$rs->id."\">[Excluir]</a></center></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "Erro: Não foi possível recuperar os dados do banco de dados";
                        }
                   } catch (PDOException $erro) {
                        echo "Erro: ".$erro->getMessage();
                   }
                ?>
            </table>
            
        </body>
    </html>
</html