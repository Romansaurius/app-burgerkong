# Desplegar BurgerKong en Render

## 🚀 Pasos para Desplegar

### 1. **Arreglar Base de Datos Local (Si ya tienes datos)**
```sql
-- Ejecutar en phpMyAdmin o tu gestor MySQL:
-- Copiar y pegar el contenido de: feature_2/sql/fix_database.sql
```

### 2. **Preparar Repositorio Git**
```bash
cd app-burgerkong
git init
git add .
git commit -m "Initial commit - BurgerKong Restaurant System"
```

### 3. **Subir a GitHub**
1. Crear repositorio en GitHub
2. Conectar y subir:
```bash
git remote add origin https://github.com/TU_USUARIO/burgerkong.git
git branch -M main
git push -u origin main
```

### 4. **Configurar en Render**

#### A. Crear Base de Datos MySQL:
1. Ir a [render.com](https://render.com)
2. Crear cuenta/iniciar sesión
3. Click "New" → "MySQL"
4. Configurar:
   - **Name**: `burgerkong-db`
   - **Database Name**: `burgerkong`
   - **User**: `burgerkong_user`
   - **Plan**: Free
5. Click "Create Database"
6. **Guardar** la URL de conexión que aparece

#### B. Crear Web Service:
1. Click "New" → "Web Service"
2. Conectar tu repositorio GitHub
3. Configurar:
   - **Name**: `burgerkong-app`
   - **Environment**: `PHP`
   - **Build Command**: `composer install --no-dev`
   - **Start Command**: `php -S 0.0.0.0:$PORT -t .`

#### C. Variables de Entorno:
En la sección "Environment Variables":
```
DATABASE_URL = [URL de tu base MySQL de Render]
```

### 5. **Configurar Base de Datos**
Una vez desplegado:
1. Ir a tu URL de Render
2. Agregar `/setup_database.php` al final
3. Esto configurará automáticamente las tablas

### 6. **Importar Datos Iniciales**
Conectar a tu base MySQL de Render y ejecutar:
```sql
-- Categorías, productos y sucursales
-- Usar los archivos .sql de la carpeta feature_2/sql/
```

## 🔧 **URLs del Sistema Desplegado**

```
Página Principal: https://tu-app.onrender.com
Menú Cliente:     https://tu-app.onrender.com/feature_1/
Panel Admin:      https://tu-app.onrender.com/feature_2/admin.php
```

## 🔑 **Credenciales por Defecto**
- **Usuario**: admin
- **Contraseña**: password

## 📋 **Checklist de Despliegue**

- [ ] Base de datos MySQL creada en Render
- [ ] Repositorio subido a GitHub
- [ ] Web Service configurado
- [ ] Variable DATABASE_URL configurada
- [ ] Script setup_database.php ejecutado
- [ ] Datos iniciales importados
- [ ] Login admin funcionando
- [ ] Menú cliente funcionando

## 🐛 **Solución de Problemas**

### Error de Conexión DB:
- Verificar que DATABASE_URL esté correcta
- Comprobar que la base MySQL esté activa

### Páginas en Blanco:
- Revisar logs en Render Dashboard
- Verificar que todos los archivos se subieron

### Sesiones No Funcionan:
- Render maneja sesiones automáticamente
- Verificar que no haya errores PHP

## 💡 **Ventajas de Render vs XAMPP**

✅ **Acceso desde cualquier lugar**  
✅ **No necesitas instalar nada local**  
✅ **Base de datos en la nube**  
✅ **SSL automático (HTTPS)**  
✅ **Escalabilidad automática**  
✅ **Backups automáticos**  

## 🆓 **Plan Gratuito Render**
- 750 horas/mes de web service
- Base MySQL con 1GB storage
- Perfecto para desarrollo y demos

¡Tu sistema estará disponible 24/7 en la nube! 🌐