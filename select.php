<?php

  include ('connect.php');

 

  //$sql = 'SELECT * FROM country where Continent="North America"';

  $sql = 'CALL GetCountriesInNorthAmerica();';


  $query = $conn -> prepare($sql);

  $query -> execute();

  $results = $query -> fetchAll(PDO::FETCH_OBJ);
// var_dump muestra el contenido de un objeto (array, lista, etc)
  //var_dump($results);
// echo muestra el contenido especifico de un campo en un registro
  //echo $results[2]->Population;


// imoreme coo tabla organizando los datos de cauerdo alas columnas que pidas
// en el if da referencia a que si hay más de cero registros hará la tabla
if($query -> rowCount() > 0)   {

    echo "<table border='1px'>";

    echo "<tr>

      <td>Name</td>

      <td>Continent</td>

      <td>Region</td>

      <td>Population</td>

    </tr>";

    foreach($results as $item) {

      echo "<tr>

        <td>" . $item->Name . "</td>

        <td>" . $item->Continent . "</td>

        <td>" . $item->Region . "</td>

        <td>" . $item->Population . "</td>

      </tr>";

    }

    echo "</table>";

  }

?>