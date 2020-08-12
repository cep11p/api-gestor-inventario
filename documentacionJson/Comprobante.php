<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/comprobantes
* @url con parametros http://api.gestor-inventario.local/comprobantes?global_param=00001&fecha_desde=2015-03-03
* @method GET
* @parametros estos parametros sirven como criterio de busqueda
* global_param = (nro de remito)
* fecha_desde = (fecha de emision)
* fecha_hasta = (fecha de emision)
* defectuoso=true //verdadero
* vencido=true //verdadero
* sort=-fecha_emision (ordenamiento desc)
* sort=-nro_remito (ordenamiento desc)
* @arrayReturn
{
    "pagesize": 20,
    "pages": 1,
    "total_filtrado": 9,
    "resultado": [
        {
            "id": 1,
            "nro_remito": "0001-00001",
            "fecha_inicial": "2019-03-03",
            "fecha_emision": "2019-03-03",
            "total": 7500,
            "proveedorid": 1,
            "descripcion": "Esto es una descripcion hecha por fixture 1",
            "producto_cant_total": "12",
            "proveedor": {
                "id": 1,
                "nombre": "proveedor1",
                "cuit": "10326547418"
            }
        },
        {
            "id": 2,
            "nro_remito": "0001-00002",
            "fecha_inicial": "2019-04-03",
            "fecha_emision": "2019-04-03",
            "total": 2099.99,
            "proveedorid": 1,
            "descripcion": "Esto es una descripcion hecha por fixture 2",
            "producto_cant_total": "2",
            "proveedor": {
                "id": 1,
                "nombre": "proveedor1",
                "cuit": "10326547418"
            }
        },
        {...},
        {...},
        {...},
        {
            "id": 9,
            "nro_remito": "0001-00009",
            "fecha_inicial": "2019-04-03",
            "fecha_emision": "2019-04-03",
            "total": 7500,
            "proveedorid": "",
            "descripcion": "Esto es una descripcion hecha por fixture 9",
            "producto_cant_total": "0",
            "proveedor": ''
        }
    ]
}
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


/**** Para registrar las modificaciones que hay sobre un producto en un comprobante*****
* Hay aveces que le proveedor no entrega todos los productos que dice en el comprobantes..
 * Por lo tanto registramos los productos que estan pendiente en entrega con falta=true o viceversa
* @url http://api.gestor-inventario.local/comprobantes/registrar-producto-pendiente/{$id} 
* @method PUT
* @param arrayJson
    {
	"cantidad":3,
	"productoid":3,
	"fecha_vencimiento":"2022-03-20"
    }
 * @return 
    {
        "message": "Se registran los productos pendientes de entregas",
        "comprobanteid": 1
    }
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
    "producto_cant_total": "12",
    "lista_producto": [
        {
            "comprobanteid": 1,
            "productoid": 1,
            "fecha_vencimiento": "2019-03-03",
            "precio_unitario": 100,
            "defectuoso": true,
            "egresoid": "",
            "depositoid": "",
            "falta": false,
            "stock": false,
            "vencido": true,
            "cantidad": "1",
            "precio_total": 100,
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
            "precio_total": 600,
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
            "productoid": 3,
            "fecha_vencimiento": "2019-03-20",
            "precio_unitario": 300,
            "defectuoso": false,
            "egresoid": 3,
            "depositoid": "",
            "falta": false,
            "stock": false,
            "vencido": true,
            "cantidad": "4",
            "precio_total": 1200,
            "nombre": "Arroz blanco",
            "codigo": "A302",
            "unidad_valor": "1",
            "unidad_medidaid": 1,
            "marcaid": 168,
            "categoriaid": 1,
            "marca": "Dos hermanos",
            "unidad_medida": "kg",
            "producto": "Arroz blanco, 1kg (Dos hermanos)"
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
            "precio_total": 900,
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
            "productoid": 9,
            "fecha_vencimiento": "2119-04-03",
            "precio_unitario": 300,
            "defectuoso": false,
            "egresoid": 1,
            "depositoid": "",
            "falta": false,
            "stock": true,
            "vencido": false,
            "cantidad": "1",
            "precio_total": 300,
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
            "defectuoso": true,
            "egresoid": "",
            "depositoid": "",
            "falta": false,
            "stock": false,
            "vencido": false,
            "cantidad": "1",
            "precio_total": 200,
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
