<link rel="stylesheet" href="assets/css/main.css">
<div class="base">



  <?php

      include "Cart/Cart.php";
      include "Item/Item.php";
      date_default_timezone_set('America/Sao_Paulo');

      $Iprices = [19.99, 18.00, 19.00, 19.50, 18.30];

      if($_POST['pagamento'] == 'D'){
        $aux = [];

        foreach($Iprices as $Iprice){
            array_push($aux, $Iprice-(($Iprice/100)*5));
        }

        $Iprices = $aux;
      }

      $c = new Cart($_POST["user"]);

      $i1 = new Item(1,"Cimento - Todas as Obras", $Iprices[0]);
      $i2 = new Item(2,"Cimento - Obras Basicas", $Iprices[1]);
      $i3 = new Item(3,"Cimento - Obras Estruturais", $Iprices[2]);
      $i4 = new Item(4,"Cimento - Obras Especiais", $Iprices[3]);
      $i5 = new Item(5,"Cimento - Obras Especiais Agressivo", $Iprices[4]);


      if($_POST["prod1"] != 0){
          $i1 -> setQuantity($_POST["prod1"]);
          $c -> addItem($i1);
      }
      if($_POST["prod2"] != 0){
          $i2 -> setQuantity($_POST["prod2"]);
          $c -> addItem($i2);
      }
      if($_POST["prod3"] != 0){
          $i3 -> setQuantity($_POST["prod3"]);
          $c -> addItem($i3);
      }
      if($_POST["prod4"] != 0){
          $i4 -> setQuantity($_POST["prod4"]);
          $c -> addItem($i4);
      }
      if($_POST["prod5"] != 0){
          $i5 -> setQuantity($_POST["prod5"]);
          $c -> addItem($i5);
      }
      echo "<h1 class='title'>Carrinho</h1><br><h2 class='txt2'>".$c -> getUser().",</h2><br><h3>por favor, confíra o conteudo se seu carrinho e confirme o pedido</h3><br><br>";
      foreach($c -> getItens() as $item){
          echo "".$item -> getName()."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp quantidade:".$item -> getQuantity()."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp preço unitario:<b>".number_format($item -> getPrice(),2,",",".")."</b>&nbsp&nbsp&nbsptotal do produto:".number_format($item -> getPrice()*$item -> getQuantity(),2,",",".")."<br><br>";
      }

      $date = date("d/m/Y");
      $vdate = date("d/m/Y", strtotime("+1 month"));
      $order = monthToString($date)."tab".$c -> toString()."tabVálido até: ".monthToString($vdate)." \n";
      echo"<p class='txt'>Total do carrinho: R$".$c -> total()."</p><br><br>
          <form action='pedido.php' method='POST'>
              <label class='txt'>Deseja receber o orçamento por email ?</label>
              <input type='checkbox' name='want' value='true' onclick='showEmailBox()'><br><br>
              <div id='emailInput'></div>
              <input class='btn cabtn' type='button' onclick='index()' value='Cancelar'>&nbsp&nbsp
              <input type = 'submit' value='confirmar' class='btn cobtn'><input class='hide txt' type='text' name='user' value='".$c -> getUser()."'><input class='hide' type='text' name='order' value='$order'>
          </form>";

  function monthToString($d){

      $aux = explode("/", $d);

      switch ($aux[1]) {
          case "01": $d = str_replace('01', 'janeiro', $d);break;
          case "02": $d = str_replace('02', 'fevereiro', $d);break;
          case "03": $d = str_replace('03', 'março', $d);break;
          case "04": $d = str_replace('04', 'abril', $d);break;
          case "05": $d = str_replace('05', 'março', $d);break;
          case "06": $d = str_replace('06', 'junho', $d);break;
          case "07": $d = str_replace('07', 'julho', $d);break;
          case "08": $d = str_replace('08', 'agosto', $d);break;
          case "09": $d = str_replace('09', 'setembro', $d);break;
          case "10": $d = str_replace('10', 'outubro', $d);break;
          case "11": $d = str_replace('11', 'novembro', $d);break;
          case "12": $d = str_replace('12', 'dezembro', $d);break;
          default:
          break;
      }
      return $d;
  }
  ?>
</div>
  <script>
  let temp = `Digite seu email <input type="email" name="email" required>`
  function showEmailBox(){
    let e = document.getElementById('emailInput')
    console.log(e.className)
    if(e.className == "active"){
      e.className = 'off'
      e.innerHTML = ''
    }else{
      e.className = "active"
      e.innerHTML = temp
    }
  }
  function index(){
    window.location.replace('index.html');
  }
  </script>
