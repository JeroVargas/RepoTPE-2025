# Proyecto de Venta de Pisos

Este proyecto es un trabajo práctico especial para la materia de Web 2. La temática del proyecto es la venta de pisos, ofreciendo una variedad de tamaños y calidades.

## Participantes

- jeronimovargas2604@gmail.com
- giulianonicolasbellocchio@gmail.com

## Temática

La página web se centrará en la venta de pisos, con una amplia gama de opciones en cuanto a materiales, tamaños y calidades.

## Base de Datos

La base de datos del proyecto se llama `pisostpe` y consta de las siguientes tablas:

### Tabla `pisos`

Esta tabla almacena los tipos de pisos disponibles.

- **id**: Identificador único para cada tipo de piso (Clave primaria).
- **baldosa**: Información sobre pisos de baldosa.
- **marmol**: Información sobre pisos de mármol.
- **travertino**: Información sobre pisos de travertino.

### Tabla `baldosas`

Esta tabla almacena detalles específicos de las baldosas.

- **id**: Identificador único para cada baldosa (Clave primaria).
- **id_origen**: Referencia al tipo de piso al que pertenece la baldosa (Clave foránea a `pisos.id`).
- **lugar_colocacion**: Lugar de colocación recomendado para la baldosa.
- **tamanio**: Tamaño de la baldosa.


## Admin Login

user: admin@todopisos.com

password: admin

## Imágenes del Proyecto

- [Ver Imagen](349c28fd-a95e-450c-8a3d-085ac4d34c7b.jfif)
