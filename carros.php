<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        #figure{width: 800px; margin: 0px auto;}
        body { background-color:#9ACD32;}
        h1 p { font-size: 50px; text-align: center;}
        h1   {color: rgb(2, 2, 11);}
        input {color: #FF0000;}
        form { font-size: 20px;}
        form input { font: size 5px;}
    </style>
    <title>Document</title>
</head>
<body>

    <form action="cadastrar.php" method="POST" >
        <h1><p>Projeto de aplicação Cadastro de veiculos</p></h1>
        <hr>
        <input type="hidden" name="id" >
        Nome:
        <input type="text" name="nome" />

         E-mail:
        <input type="text" name="email" />
        Celular:
        <input type="text" name="celular" />
        Cor:
        <input type="text" name="cor" />
         Modelo:
        <input type="text" name="modelo" />
         Ano:
        <input type="text" name="ano" />
        <input type="submit" value="salvar" />
        <input type="reset" value="Novo" />
        <hr>
       
    </form>
        <figure class="figure" >
            
         <img src="https://img2.icarros.com/dbimg/imgadicionalnoticia/4/105564_1" class="figure-img img-fluid rounded" alt="" height="400" width="400" left="500" >
            <figcaption class="figure-caption text-end">Ferrari.</figcaption>
            
        </figure>
        
</body>
</html>