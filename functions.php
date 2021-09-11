<?php
function main_menu(){
	$response="Bemvindo ao sistema de pagamento automatico\nEscolha um numero bj:\n1.Registrar\n2.Comprar combustivel\n3.Remanesccente";
	//ussd_proceed($text);
}

//as funcoes das opcoes do menu
function cliente_registar($data){
	global $connection;
if (count($data)==2) {
	$response="O seu primeiro nome";
	//ussd_proceed($text);
}
if (count($data)==3) {
	$response="O segundo nome";
	//ussd_proceed($text); 
}
if (count($data)==4) {
	$phoneNumber = $_POST["phoneNumber"];
	$primeironome=$data[2];
	$segundonome=$data[3];

	$sql=" Insert into registro(primeironome,segundonome,data_hora) values ('$primeironome','$segundonome',Now())";
$result=mysqli_query($connection,$sql) or die("Falha na conexao" .mysqli_error($connection));
if ($result==1) {
	$text="Dados registrados!";
		ussd_stop($text);
}
}
}
//comprar combustivel
function  cliente_comprar($data){	
	global $connection;
	$litros=0;
	$via=0;
	$lt=1.25;
	$falha=0;
	//ler a via de pagamento
	if (count($data)==2) {
	$response="Selecciona:\n1.Paga via Mpesa\n2.Pague no caixa";
	//if ($text >2 && $text<1) {
	//	ussd_stop2($falha);
	//}
	//ussd_proceed($text);	
}
//ler o tipo de combustivel
if (count($data)==3) {
	$response="Escolha o tipo de combustivel:\n1.Diesel\n2.Gasolina\n3.Diesel c/ chumbo\n4.Gasolina Adjectiva";
	//ussd_proceed($text);
}
if (count($data)==4) {
	$response="Digite o valor";
	//ussd_proceed($text);
}
if (count($data)==5) {
	//Gravar a via de pagamento a usar...
	$via=$data[2];
		if ($via==1) {
	$via="M-PESA";
	} elseif ($via==2) {
	$via="Caixa1";
}

//Gravar o tipo de combustivel...
	$combustivel=$data[3];
		if ($combustivel==1) {
	$combustivel="Diesel";
   } elseif ($combustivel==2) {
	$combustivel="Gasolina";
   } elseif ($combustivel==3) {
	$combustivel="Diesel c/ chumbo";
   } elseif ($combustivel==4) {
    $combustivel="Gasolina Adjectiva";
   }
 else{
    	$text="Opcao invalida,por favor tente novamente";
    }
	$valor=$data[4];
	$litros=$valor*0.21;
	$remanescente=$litros/$lt;

	//$quantidade=$valor/0.21;
	$sql=" Insert into comprar(Via_pagamento,Combustivel,Total_pago,Litros,Remanescente,Data) values ('$via','$combustivel','$valor','$litros','$remanescente',Now())";
$result=mysqli_query($connection,$sql) or die("Falha na conexao" .mysqli_error($connection));
if ($result==1) {
	$text="Sucesso!";
	$falha="Opcao invalida,por favor tente novamente";
		ussd_stop($text);


	
}


}
}
//remanescte
function   cliente_remanescente(){
	$text="so tem 431964 lt";
	ussd_proceed($text);
}

//continuacao do form
function ussd_proceed($text){
	echo "CON ".$text;
}

function ussd_stop($text){
echo "END ".$text;
}
function ussd_stop2($falha){
echo "END ".$falha;
}



?>