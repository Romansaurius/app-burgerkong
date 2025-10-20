# BurgerKong - Sistema de Gestión de Restaurante

## Descripción
Sistema web completo para gestión de restaurante con dos features principales:
- **Feature 1**: Menú público y sistema de carrito
- **Feature 2**: Panel administrativo para gestión de productos y tickets

## Requisitos del Sistema
- XAMPP (Apache + MySQL + PHP)
- Navegador web moderno
- Editor de texto (opcional)

## Instalación y Configuración

### 1. Instalar XAMPP
1. Descargar XAMPP desde https://www.apachefriends.org/
2. Instalar siguiendo las instrucciones del instalador
3. Iniciar Apache y MySQL desde el panel de control de XAMPP

### 2. Configurar la Base de Datos
1. Abrir phpMyAdmin en http://localhost/phpmyadmin
2. Crear una nueva base de datos llamada `burgerkong`
3. Ejecutar el script SQL completo:
   ```sql
   -- Copiar y pegar el contenido de: feature_2/sql/init_database.sql
   ```
4. Importar datos iniciales ejecutando los scripts en este orden:
   - `feature_2/sql/categorias.sql`
   - `feature_2/sql/productos.sql` 
   - `feature_2/sql/sucursales.sql`

### 3. Configurar Credenciales de Base de Datos
Editar el archivo `credenciales.php` en ambos features con tus datos:
```php
<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "burgerkong";
?>
```

### 4. Copiar Archivos al Servidor
1. Copiar la carpeta completa `app-burgerkong` a `C:\xampp\htdocs\`
2. La estructura debe quedar: `C:\xampp\htdocs\app-burgerkong\`

## Cómo Probar el Sistema

### Feature 1 - Menú Público
**URL**: http://localhost/app-burgerkong/feature_1/

**Funcionalidades a probar**:
1. **Página de Sucursales**: `sucursales.php`
   - Ver listado de sucursales
   - Navegar al menú

2. **Menú de Productos**: `menu.php`
   - Filtrar por categorías
   - Ver productos por categoría
   - Agregar productos al carrito
   - Ver contador de productos en carrito

3. **Detalles de Producto**: `detalles.php?id=X`
   - Ver información detallada
   - Agregar al carrito desde detalle

4. **Carrito de Compras**: `carrito.php`
   - Ver productos agregados
   - Modificar cantidades
   - Proceder al checkout

5. **Proceso de Compra**: `ticket.php`
   - Completar datos del cliente
   - Generar ticket de compra
   - Ver página de agradecimiento

### Feature 2 - Panel Administrativo
**URL**: http://localhost/app-burgerkong/feature_2/

**Credenciales por defecto**:
- Usuario: `admin`
- Contraseña: `password`

**Funcionalidades a probar**:

1. **Login Administrativo**: `admin.php`
   - Iniciar sesión con credenciales

2. **Dashboard**: `panel.php`
   - Ver estadísticas generales
   - Accesos rápidos a funciones

3. **Gestión de Productos**:
   - **Listar**: `listar_producto.php` - Ver todos los productos
   - **Crear**: `nuevo_producto.php` - Agregar nuevo producto
   - **Editar**: `editar_producto.php?id=X` - Modificar producto existente
   - **Eliminar**: `borrar_producto.php?id=X` - Eliminar producto

4. **Gestión de Tickets**: `listar_tickets.php`
   - Ver todas las órdenes
   - Cambiar estado de tickets
   - Ver detalles de cada ticket

5. **Cerrar Sesión**: `logout.php`

## Estructura de la Base de Datos

### Tablas Principales:
- `BurgerKong__categorias` - Categorías de productos
- `BurgerKong__productos` - Productos del menú
- `BurgerKong__sucursales` - Sucursales del restaurante
- `BurgerKong__usuarios` - Administradores del sistema
- `BurgerKong__clientes` - Clientes que realizan pedidos
- `BurgerKong__tickets` - Órdenes de compra
- `BurgerKong__ventas` - Detalle de productos por ticket
- `BurgerKong__sesiones` - Control de sesiones

## Flujo de Prueba Completo

### 1. Probar Feature 1 (Cliente)
```
1. Ir a: http://localhost/app-burgerkong/feature_1/sucursales.php
2. Hacer clic en "Ver Menú"
3. Navegar por categorías
4. Agregar productos al carrito
5. Ir al carrito y proceder al checkout
6. Completar datos y generar ticket
```

### 2. Probar Feature 2 (Administrador)
```
1. Ir a: http://localhost/app-burgerkong/feature_2/admin.php
2. Login con: admin / password
3. Crear un nuevo producto
4. Editar un producto existente
5. Ver tickets generados en Feature 1
6. Cambiar estado de tickets
```

## Solución de Problemas Comunes

### Error de Conexión a Base de Datos
- Verificar que MySQL esté ejecutándose en XAMPP
- Revisar credenciales en `credenciales.php`
- Confirmar que la base de datos `burgerkong` existe

### Páginas en Blanco
- Activar display_errors en PHP
- Revisar logs de error de Apache
- Verificar que todos los archivos estén en la ubicación correcta

### Imágenes No Cargan
- Verificar URLs de imágenes en la base de datos
- Asegurar que las rutas sean accesibles

### Sesiones No Funcionan
- Verificar que las cookies estén habilitadas
- Comprobar configuración de sesiones en PHP

## Archivos Importantes

### Configuración:
- `credenciales.php` - Configuración de base de datos
- `conexion.php` - Conexión a MySQL
- `BurgerTools.php` - Funciones principales del sistema

### Estilos:
- `css/styles.css` - Estilos del frontend público
- `css/styles_admin.css` - Estilos del panel administrativo

### Base de Datos:
- `sql/init_database.sql` - Script completo de inicialización
- `sql/*.sql` - Scripts individuales por tabla

## Contacto y Soporte
Para problemas o consultas, revisar el código fuente o contactar al desarrollador.