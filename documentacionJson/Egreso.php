<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/egresos
* @method GET
* @arrayReturn
    {
        "pagesize": 20,
        "pages": 1,
        "total_filtrado": 3,
        "resultado": [
            {
                "id": 1,
                "fecha": "2019-03-03",
                "origen": "un origen",
                "destino_nombre": "Un destino",
                "destino_localidadid": 2626,
                "descripcion": "Esto es un egreso1 creado con fixture",
                "nro_acta": "0001"
            },
            {
                "id": 2,
                "fecha": "2019-04-04",
                "origen": "un origen",
                "destino_nombre": "Un destino",
                "destino_localidadid": 2626,
                "descripcion": "Esto es un egreso2 creado con fixture",
                "nro_acta": "0002"
            },
            {
                "id": 3,
                "fecha": "2019-05-05",
                "origen": "un origen",
                "destino_nombre": "Un destino",
                "destino_localidadid": 2626,
                "descripcion": "Esto es un egreso3 creado con fixture",
                "nro_acta": "0003"
            }
        ]
    }
*/

/*****Para crear****
 * Creamos un egreso con su lista de productos a egresar
 * @url http://api.gestor-inventario.local/egresos 
 * @method POST
 * @param arrayJson
{
    "fecha":"2020-03-03",
    "origen":"Origen 1",
    "destino_nombre":"Destino 1",
    "destino_localidadid":2626,
    "nro_acta":"456-123",
    "tipo_egresoid":1,
    "descripcion":"Esto es una descripcion de egreso",
    "lista_producto":[
            {
                    "id":27
            },
            {
                    "id":28
            },
            {
                    "id":24
            }	
    ]
}
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
    "id": 1,
    "fecha": "2019-03-03",
    "origen": "origen1",
    "destino_nombre": "destino1",
    "destino_localidadid": 2626,
    "descripcion": "Esto es un egreso1 creado con fixture1",
    "nro_acta": "0001",
    "tipo_egresoid": 1,
    "tipo_egreso": "Modulo",
    "producto_cant_total": 3,
    "lista_producto": [
        {
            "comprobanteid": 3,
            "productoid": 7,
            "fecha_vencimiento": "2120-06-06",
            "precio_unitario": 100,
            "defectuoso": false,
            "egresoid": 1,
            "depositoid": "",
            "falta": false,
            "stock": true,
            "vencido": false,
            "cantidad": "1",
            "precio_total": 100,
            "nombre": "Detergente para vajillas",
            "codigo": "A306",
            "unidad_valor": "750",
            "unidad_medidaid": 4,
            "marcaid": 100,
            "categoriaid": 2,
            "marca": "Trever",
            "unidad_medida": "ml",
            "producto": "Detergente para vajillas, 750ml (Trever)"
        },
        {
            "comprobanteid": 4,
            "productoid": 8,
            "fecha_vencimiento": "2119-03-03",
            "precio_unitario": 200,
            "defectuoso": false,
            "egresoid": 1,
            "depositoid": "",
            "falta": false,
            "stock": true,
            "vencido": false,
            "cantidad": "1",
            "precio_total": 200,
            "nombre": "Jabón blanco en pan",
            "codigo": "A307",
            "unidad_valor": "200",
            "unidad_medidaid": 2,
            "marcaid": 101,
            "categoriaid": 2,
            "marca": "Canuelas",
            "unidad_medida": "gr",
            "producto": "Jabón blanco en pan, 200gr (Canuelas)"
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
        }
    ]
}
*/

/****** Para borrar una localidad *****
* @url http://api.gestor-inventario.local/egresos/{$id} 
* @method Delete
* @return arrayJson
*/
