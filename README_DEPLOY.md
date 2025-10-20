# 🚀 Despliegue BurgerKong

## 📋 Configuración Inicial

### 1. **Configurar Credenciales**
```bash
# Copiar archivos ejemplo
cp feature_2/credenciales.example.php feature_2/credenciales.php
cp feature_1/credenciales.example.php feature_1/credenciales.php
```

### 2. **Editar credenciales.php con tus datos de Railway:**
```php
<?php
$servidor = "containers-us-west-xxx.railway.app";
$usuario = "root";
$password = "tu_password_railway";
$baseDatos = "burgerkong";
$puerto = 3306;
?>
```

## 🐳 **Docker**
```bash
# Ejecutar con Docker Compose
docker-compose up -d

# Ver en: http://localhost:8080
```

## 🌐 **Render**
1. Conectar repositorio GitHub
2. Configurar variable `DATABASE_URL` con tu conexión Railway
3. Desplegar automáticamente

## 🔑 **Credenciales Admin**
- Usuario: `admin`
- Contraseña: `password`

## 📁 **Archivos Protegidos**
Los siguientes archivos están en `.gitignore`:
- `credenciales.php`
- `credenciales_docker.php` 
- `conexion.php`