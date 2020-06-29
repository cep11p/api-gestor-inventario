<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/egresos
* @method GET
* @arrayReturn
*/

/*****Para crear****
* @url http://api.gestor-inventario.local/egresos 
* @method POST
* @param arrayJson
**/

/**** Para modificar*****
* @url http://api.gestor-inventario.local/egresos/{$id} 
* @method PUT
* @param arrayJson
**/

/****** Para visualizar*****
* @url http://api.gestor-inventario.local/egresos/{$id} 
* @method GET
* @return arrayJson
{
    "id": 2,
    "fecha": "2019-04-04",
    "origen": "un origen",
    "destino_nombre": "Un destino",
    "destino_localidadid": 2626,
    "descripcion": "Esto es un egreso2 creado con fixture",
    "nro_acta": "0002",
    "lista_producto": [
        {
            "comprobanteid": 1,
            "productoid": 2,
            "fecha_vencimiento": "2019-03-20",
            "precio_unitario": 300,
            "defectuoso": false,
            "egresoid": 2,
            "depositoid": "",
            "falta": false,
            "stock": false,
            "vencido": true,
            "cantidad": "2",
            "nro_remito": "0001-00001",
            "fecha_inicial": "2019-03-03",
            "fecha_emision": "2019-03-03",
            "total": 7500,
            "proveedorid": 1,
            "descripcion": "Esto es una descripcion hecha por fixture 1",
            "nombre": "Aceite de girasol",
            "codigo": "A301",
            "unidad_valor": "900",
            "unidad_medidaid": 4,
            "marcaid": 1,
            "categoriaid": 1,
            "marca": "Arcor",
            "unidad_medida": "ml",
            "producto": "Aceite de girasol, 900ml (Arcor)"
        },
        {
            "comprobanteid": 1,
            "productoid": 9,
            "fecha_vencimiento": "2019-03-20",
            "precio_unitario": 300,
            "defectuoso": false,
            "egresoid": 2,
            "depositoid": "",
            "falta": false,
            "stock": false,
            "vencido": true,
            "cantidad": "3",
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
        }
    ]
}
*/

/****** Para borrar una localidad *****
* @url http://api.gestor-inventario.local/egresos/{$id} 
* @method Delete
* @return arrayJson
*/
