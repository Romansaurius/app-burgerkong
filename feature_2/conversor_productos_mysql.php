<?php  

$csvFile = fopen("CSV/productos.csv", "r");

if ($csvFile === false) {
    die("Error: No se pudo abrir el archivo CSV.");
}

$sqlFile = fopen("productos.sql", "w");

if ($sqlFile === false) {
    die("Error: No se pudo crear el archivo SQL.");
}

$headers = fgetcsv($csvFile, 1000, "|");



while (($row = fgetcsv($csvFile, 1000, "|")) !== FALSE) {
    $sql = "INSERT INTO BurgerKong__productos (id, idCategoria, titulo, subtitulo, imagenMenu, imagenDescripcion, precio, FechaCreacion) VALUES ('" . $row[0] . "', '" . $row[1] . "', '" . $row[2] . "','" . $row[3] . "','" . $row[4] . "','" . $row[5] . "','" . $row[6] . "','" . $row[7] . "');\n";
    

    fwrite($sqlFile, $sql);
}



fclose($csvFile);
fclose($sqlFile);

echo "Archivo SQL generado con éxito.";

?>
