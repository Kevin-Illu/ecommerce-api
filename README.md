# E-commerce REST API

Este proyecto tiene como propósito el aprendizaje de PHP y el desarrollo del backend.

## Ejecutar Projecto

para ejecutar el projecto utiliza el siguiente comando

```shell
php -S localhost: 3000 -t public
```

Tecnologías utilizadas:

- MySQL
- PHP
- Slim (framework de PHP)
- PHP-DI (contenedor de dependencias)
- Doctrine:DBAL (capa de abstracción de base de datos)

## Rutas

- **URL base `/api/v1/`**

- **Products `/products/`**  
  Lista todos los productos (límite 10).

- **Featured `/products/featured`**  
  Lista los productos destacados (límite 10).

- **Product by Code `/products/code`**  
  Optiene un producto en base a us Codigo de producto.

## Pendientes

A continuación, se describen las tareas por hacer:

- [ ] Agregar autenticación
- [ ] Agregar tokens JSON Web
- [ ] Finalizar la ruta de productos
  - [x] get product by code
  - [x] add new product
  - [x] edit product by code
  - [x] delete product by code
  - [x] get all products
  - [x] get featued products
  - [ ] protejer estas rutas con tokens
- [ ] Crear la ruta de clientes
- [ ] Agregar usuarios y roles
- [ ] Agregar pagos
- [ ] Test unitarios y de integracion
- [ ] Logs
- [ ] Documentacion Automatica
