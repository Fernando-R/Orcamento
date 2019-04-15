<link rel="stylesheet" href="assets/css/main.css">
<div class="base">
<form action="consulta.php" method="POST">
    <h1 class='title'>Consultar orçamentos</h1>
    <label for="name"><h2 class="txt2">Digite o nome utilizado para solicitar o orçamento</h2></label><br><br>
    <input type="text" class="txt" name="name" placeholder="Nome" required>
    <div class="consbtn">
        <input type="submit" class="btn" value="Consultar"><br>
        <input class="btn" type="button" onclick='window.location.replace("index.html")' value="Fazer outro orçamento">
    </div>
</form> <br>




<?php
    if(isset($_POST["name"])){
        try{
            if(!(file_exists("orcamentos/".$_POST["name"].".txt"))){
                throw new Exception("Nome não encontrado");
            }

            $fp = fopen("orcamentos/".$_POST["name"].".txt", "r");
            $linha = "";
            while (!feof($fp)) {
                $linha .= fgets($fp, 1024);
            }
            $linha = str_replace("tab", "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp", $linha);
            echo nl2br($linha);
            fclose($fp);
        }
        catch (Exception $e) {
            echo $e -> getMessage();
        }
    }
?>
</div>
