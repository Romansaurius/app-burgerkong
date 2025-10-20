<?php
// Script para configurar la base de datos en Render
if (isset($_ENV['DATABASE_URL'])) {
    // Parsear DATABASE_URL de Render
    $db_url = parse_url($_ENV['DATABASE_URL']);
    
    $servidor = $db_url['host'];
    $usuario = $db_url['user'];
    $password = $db_url['pass'];
    $baseDatos = ltrim($db_url['path'], '/');
    $puerto = $db_url['port'] ?? 3306;
    
    // Crear archivos de credenciales para ambos features
    $credenciales_content = "<?php\n";
    $credenciales_content .= "\$servidor = \"$servidor\";\n";
    $credenciales_content .= "\$usuario = \"$usuario\";\n";
    $credenciales_content .= "\$password = \"$password\";\n";
    $credenciales_content .= "\$baseDatos = \"$baseDatos\";\n";
    $credenciales_content .= "\$puerto = $puerto;\n";
    $credenciales_content .= "?>";
    
    // Escribir credenciales para feature_1
    file_put_contents('feature_1/credenciales.php', $credenciales_content);
    
    // Escribir credenciales para feature_2
    file_put_contents('feature_2/credenciales.php', $credenciales_content);
    
    // Conectar y ejecutar script de base de datos
    try {
        $pdo = new PDO("mysql:host=$servidor;port=$puerto;dbname=$baseDatos", $usuario, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Ejecutar script de inicialización
        $sql = file_get_contents('feature_2/sql/init_database.sql');
        $pdo->exec($sql);
        
        echo "Base de datos configurada correctamente\n";
    } catch (Exception $e) {
        echo "Error configurando base de datos: " . $e->getMessage() . "\n";
    }
}
?>