<link rel="stylesheet" href="assets/css/main.css">
<div class="base">
  <script>
    function consulta(){
      window.location.replace('consulta.php')
    }
    function index(){
      window.location.replace('index.html')
    }
  </script>
  <?php

    require("sendgrid-php/sendgrid-php.php");
  // Abre ou cria o arquivo usuario.txt
  // "a+" representa que o arquivo é aberto para ser escrito oi lido
    $fp = fopen("orcamentos/".$_POST["user"].".txt", "a+");

    // Escreve o orçamento no arquido usuario.txt
    $escreve = fwrite($fp, $_POST["order"]."\n\n");

    // Fecha o arquivo
    fclose($fp);


    if(isset($_POST["email"])){
      $from = new SendGrid\Email(null, "fernando.ribeiro3070@gmail.com");
      $subject = "Orçamento";
      $to = new SendGrid\Email(null, $_POST["email"]);
      $content = new SendGrid\Content("text/plain", str_replace("tab", "\t", $_POST['order']));
      $mail = new SendGrid\Mail($from, $subject, $to, $content);

      $apiKey = getenv('SENDGRID_API_KEY');
      $sg = new \SendGrid($apiKey);

      $response = $sg->client->mail()->send()->post($mail);
      echo $response->statusCode();
      echo $response->headers();
      echo $response->body();

    }
        echo "<h1 class='title'>Pedido concluido</h1><br><br>
        <h2 class='txt2'>Obrigado pelo interece ".$_POST["user"].".</h2><br><br>
        <input class='btn csobtn' type='button' onclick='consulta()' value='Consultar orçamentos'>
        <input class='btn foobtn' type='button' onclick='index()' value='Fazer outro orçamento'>"




  ?>
</div>
