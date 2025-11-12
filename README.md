
# Proyecto de Venta de Pisos

Este proyecto es un trabajo práctico especial para la materia de Web 2. La temática del proyecto es la venta de pisos, ofreciendo una variedad de tamaños y calidades.

## Participantes

- jeronimovargas2604@gmail.com
- giulianonicolasbellocchio@gmail.com

## Temática

La página web se centrará en la venta de pisos, con una amplia gama de opciones en cuanto a materiales, tamaños y calidades.

## Base de Datos

La base de datos del proyecto se llama `pisostpe` y consta de las siguientes tablas:

### Tabla `categorias`

Esta tabla almacena las categorías de los pisos.

- **id**: Identificador único para cada categoría (Clave primaria).
- **nombre**: Nombre de la categoría (ej. Mármoles, Travertinos, Baldosas).

### Tabla `pisos`

Esta tabla almacena los detalles de los pisos disponibles.

- **id**: Identificador único para cada tipo de piso (Clave primaria).
- **id_categoria**: Referencia a la categoría a la que pertenece el piso (Clave foránea a `categorias.id`).
- **tipo_variante**: El tipo o variante del piso.
- **origen**: El país o región de origen del material.
- **acabados_comunes**: Los acabados más comunes para ese tipo de piso.
- **uso_recomendado**: El uso recomendado para el piso.

### Tabla `usuarios`

Esta tabla almacena la información de los usuarios registrados.

- **id**: Identificador único para cada usuario (Clave primaria).
- **email**: Correo electrónico del usuario (Único).
- **password**: Contraseña hasheada del usuario.
- **level**: Nivel de permisos del usuario (ej. usuario, admin).


## Admin Login

user: admin@todopisos.com

password: admin

## Imágenes del Proyecto

- [Ver Imagen](349c28fd-a95e-450c-8a3d-085ac4d34c7b.jfif)
