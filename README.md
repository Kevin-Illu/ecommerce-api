# E-commerce REST API

Este proyecto tiene como propósito el aprendizaje de PHP y el desarrollo del backend.

Tecnologías utilizadas:

- MySQL
- PHP
- Slim (framework de PHP)
- PHP-DI (contenedor de dependencias)
- Doctrine:DBAL (capa de abstracción de base de datos)

## Rutas

- **URL base `/api/v1/`**

- **Productos `/products/`**  
  Lista todos los productos (límite 10).

- **Productos destacados `/products/featured`**  
  Lista los productos destacados (límite 10).

- **Producto por código `/products/code`**  
  Retorna el producto con el ID.

## Pendientes

A continuación, se describen las tareas por hacer:

- [ ] Agregar autenticación
- [ ] Agregar tokens JSON Web
- [ ] Finalizar la ruta de productos
- [ ] Crear la ruta de clientes
- [ ] Agregar funcionalidad de usuarios
- [ ] Agregar pagos
- [ ] Crear pruebas
