<?php
$connection= mysqli_connect("localhost","root","","ussd");
if (!$connection) {
	echo "Falha na conexao com a database".mysqli_error($connection);
}
  



?>