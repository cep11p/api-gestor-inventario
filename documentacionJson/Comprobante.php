<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/comprobantes
* @method GET
* @arrayReturn
*/

/*****Para crear****
* @url http://api.gestor-inventario.local/comprobantes 
* @method POST
* @param arrayJson
**/

/**** Para modificar*****
* @url http://api.gestor-inventario.local/comprobantes/{$id} 
* @method PUT
* @param arrayJson
**/

/****** Para visualizar*****
* @url http://api.gestor-inventario.local/comprobantes/{$id} 
* @method GET
* @return arrayJson
{
    "id": 1,
    "nro_remito": "0001-00001",
    "fecha_inicial": "2019-03-03",
    "fecha_emision": "2019-03-03",
    "total": 7500,
    "proveedorid": 1,
    "descripcion": "Esto es una descripcion hecha por fixture 1",
    "cantidad_productos": 3,
    "lista_producto": [
        {
            "comprobanteid": 1,
            "productoid": 1,
            "fecha_vencimiento": "2019-03-03",
            "precio_unitario": 100,
            "defectuoso": 1,
            "egresoid": "",
            "depositoid": "",
            "falta": 0,
            "vencido": 1,
            "cantidad": "1",
            "nro_remito": "0001-00001",
            "fecha_inicial": "2019-03-03",
            "fecha_emision": "2019-03-03",
            "total": 7500,
            "proveedorid": 1,
            "descripcion": "Esto es una descripcion hecha por fixture 1",
            "nombre": "Aceite de girasol",
            "codigo": "A300",
            "unidad_valor": "1,5",
            "unidad_medidaid": 3,
            "marcaid": 1,
            "categoriaid": 1,
            "marca": "Arcor",
            "unidad_medida": "lt",
            "producto": "Aceite de girasol, 1,5lt (Arcor)"
        },
        {
            "comprobanteid": 1,
            "productoid": 9,
            "fecha_vencimiento": "2119-04-03",
            "precio_unitario": 300,
            "defectuoso": 0,
            "egresoid": 1,
            "depositoid": "",
            "falta": 0,
            "vencido": 0,
            "cantidad": "1",
            "nro_remito": "0001-00001",
            "fecha_inicial": "2019-03-03",
            "fecha_emision": "2019-03-03",
            "total": 7500,
            "proveedorid": 1,
            "descripcion": "Esto es una descripcion hecha por fixture 1",
            "nombre": "Lavandina",
            "codigo": "A308",
            "unidad_valor": "1",
            "unidad_medidaid": 3,
            "marcaid": 102,
            "categoriaid": 2,
            "marca": "Oddis nuts",
            "unidad_medida": "lt",
            "producto": "Lavandina, 1lt (Oddis nuts)"
        },
        {
            "comprobanteid": 1,
            "productoid": 5,
            "fecha_vencimiento": "2120-03-04",
            "precio_unitario": 200,
            "defectuoso": 0,
            "egresoid": "",
            "depositoid": "",
            "falta": 1,
            "vencido": 0,
            "cantidad": "1",
            "nro_remito": "0001-00001",
            "fecha_inicial": "2019-03-03",
            "fecha_emision": "2019-03-03",
            "total": 7500,
            "proveedorid": 1,
            "descripcion": "Esto es una descripcion hecha por fixture 1",
            "nombre": "Arvejas",
            "codigo": "A304",
            "unidad_valor": "300",
            "unidad_medidaid": 2,
            "marcaid": 60,
            "categoriaid": 1,
            "marca": "Noel",
            "unidad_medida": "gr",
            "producto": "Arvejas, 300gr (Noel)"
        }
    ]
}
*/

/****** Para borrar una localidad *****
* @url http://api.gestor-inventario.local/comprobantes/{$id} 
* @method Delete
* @return arrayJson
*/
