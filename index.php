<?php
include "conexao_ussd.php";
include "functions.php";
// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];



$data= explode("*",$text);
$level=0;
$level=count($data);

if ($level==0 || $level==1) {
    main_menu();
}

if ($level>1)  
{
    switch ($data[1]) {
        case '1':
        cliente_registar($data,$phoneNumber);
            break;

          case '2':
        cliente_comprar($data,$phoneNumber);
        
            break;

              case '3':
        cliente_remanescente();
            break;
            
        default:
            $response= "invalido nuumero de opcao\n Insira o a opcao correnta";
            ussd_stop($response);
            break;
    }
}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;
?>