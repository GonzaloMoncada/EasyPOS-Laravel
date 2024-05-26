# EasyPOS-Laravel
** Sistema de Ventas con Implementación de Rifa, Control de Stock, Carga de Inventario y Login **

## Instalación
  Este proyecto requiere la instalación de un motor de base de datos MySQL para gestionar la información. En el archivo .env, se deben completar las credenciales de la base de datos. 
  Para crear al usuario se debe ir a la ruta `localhost/register` y luego instalar los modulos y dependencias.
  ```bash
composer install
npm install
npm run dev
php artisan serve
```
  
## Tecnologias empleadas:
 - Laravel con Blade y Jetstream para el login.
 - Flatpickr para los Datepicker.
 - Tailwind CSS para el diseño y estilizado del frontend.
 - MySQL para el manejo de los datos.
 - DataTables para la visualización de los datos en tablas.

## Caracteristicas
- Autenticación: Los usuarios pueden autenticarse en el sistema para acceder a sus funcionalidades.
- Control de Stock: Permite gestionar y mantener un registro actualizado del inventario de productos.
- Gestión de Rifas: Proporciona herramientas para organizar y administrar rifas dentro del sistema.
- POS (Punto de Venta): Ofrece una interfaz de punto de venta para realizar transacciones de ventas de manera eficiente.
- Gestión de Productos: Facilita la administración de productos, incluyendo la creación, edición y eliminación de los mismos.
- Registro de Movimientos: Permite mantener un registro histórico de todas las transacciones de ventas y compras realizadas en el sistema.

## Screenshots
### POS
![alt POS](https://github.com/GonzaloMoncada/EasyPOS-Laravel/blob/main/screenshots/POS.png?raw=true "POS")
### Productos
 ![alt dataTables](https://github.com/GonzaloMoncada/EasyPOS-Laravel/blob/main/screenshots/dataTables.png?raw=true "POS")
 ### Rifa
 ![alt riaf](https://github.com/GonzaloMoncada/EasyPOS-Laravel/blob/main/screenshots/rifa.png?raw=true "POS")
 ### Carga de stock
 ![alt venta](https://github.com/GonzaloMoncada/EasyPOS-Laravel/blob/main/screenshots/venta.png?raw=true "POS")
  ### Historial
 ![alt historial](https://github.com/GonzaloMoncada/EasyPOS-Laravel/blob/main/screenshots/historial.png?raw=true "POS")