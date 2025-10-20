<?php  

$csvFile = fopen("CSV/categorias.csv", "r");

if ($csvFile === false) {
    die("Error: No se pudo abrir el archivo CSV.");
}

$sqlFile = fopen("categorias.sql", "w");

if ($sqlFile === false) {
    die("Error: No se pudo crear el archivo SQL.");
}

$headers = fgetcsv($csvFile, 1000, "|");


while (($row = fgetcsv($csvFile, 1000, "|")) !== FALSE) {
    
    $sql = "INSERT INTO BurgerKong__categorias (id, nombre, fechaCreacion) VALUES ('" . $row[0] . "', '" . $row[1] . "', '" . $row[2] . "');\n";
    
    fwrite($sqlFile, $sql);
}


fclose($csvFile);
fclose($sqlFile);

echo "Archivo SQL generado con éxito.";

?>
