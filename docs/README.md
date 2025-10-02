
# Hosterlan

Plataforma web que permita a los usuarios buscar, listar y administrar propiedades para alquiler, así como realizar reservas de alquiler.

# Características Principales:
 Usuarios:
- Registro e inicio de sesión.
- Perfil de usuario con información personal y propiedades alquiladas.
- Historial de alquileres.
Propiedades:
- CRUD de propiedades (Crear, Leer, Actualizar, Eliminar).
- Filtros de búsqueda por ubicación, precio, tipo de propiedad, etc.
- Detalles de la propiedad con descripción, imágenes, precio y ubicación.
- Disponibilidad de fechas para alquiler.
Reservas:
- Posibilidad de que los usuarios reserven propiedades.
- Gestión de reservas con confirmación y cancelación.
- Historial de reservas del usuario.

# Tecnologías Utilizadas:
- Backend: PHP >= 8.1  con Laravel 10
- Frontend: Tailwind CSS, Blade Templates (Laravel)
- Base de Datos: MySQL
- Autenticación: Laravel Breeze 
## Instalacion
Siga estos pasos para configurar y ejecutar el proyecto localmente:



1. Descargue el proyecto o clone el repositorio:

```bash
git clone [URL del repositorio]
```
2. Antes de ejecutar cualquier comando, dirigirse a la carpeta ap,
   que se encuentra en el directorio principal del proyecto
```bash
cd [/ruta/a/mi/proyecto/app/]
```
3. Copie el archivo .env.example y renómbrelo a .env:
```bash
 env.example 
```
4. Instale todas las dependencias del proyecto:
```bash
composer install
```
5. Configure la clave de la aplicación:
``` bash
php artisan key:generate --ansi
```
6. Instale las dependencias 
```bash
npm install
```
7. Ejecute las migraciones para configurar la base de datos:
```bash
php artisan migrate --seed
```
8.  Ejecutar
```bash
    php artisan storage:link 
```
9. Ejecute el gestor de paquetes 

```bash
npm run dev
```
10. Inicie el servidor local:

```bash
php artisan serve
```
11. Visite la aplicación en el navegador:
```bash
http://127.0.0.1:8000
```


