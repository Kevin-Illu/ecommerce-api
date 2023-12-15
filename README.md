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

A continuación se detallan las rutas disponibles en esta API Rest.

- Obtener todos los productos  
  Ruta: GET /api/v1/products  
  Descripción: Obtiene todos los productos.

- Obtener un producto por código  
  Ruta: GET /api/v1/product/{code}  
  Descripción: Obtiene un producto específico mediante su código.

- Actualizar un producto
  Ruta: PUT /api/v1/product/{code}  
   Descripción: Actualiza un producto existente.
  Se debe proporcionar el código del producto a actualizar.

- Eliminar un producto  
   Ruta: DELETE /api/v1/product/{code}  
   Descripción: Elimina un producto existente. Se debe proporcionar
  el código del producto a eliminar.

- Agregar un nuevo producto  
  Ruta: POST /api/v1/product/add  
  Descripción: Agrega un nuevo producto a la base de datos.

- Obtener productos destacados  
  Ruta: GET /api/v1/products/featured
  Descripción: Obtiene una lista de productos destacados.

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
  - [ ] agregar paginacion
  - [ ] habilitar la opcion de limite en las solicitudes
- [ ] Crear la ruta de clientes
- [ ] Agregar usuarios y roles
- [ ] Agregar pagos
- [ ] Test unitarios y de integracion
- [ ] Logs
- [ ] Documentacion Automatica
