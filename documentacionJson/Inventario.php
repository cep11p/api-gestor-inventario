<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/inventarios?parametro1=valor1&parametro2=valor2
* @parametros estos parametros sirven como criterio de busqueda
 * fecha_vencimiento=2020-03-03
 * fecha_emision=2020-03-03
 * nro_remito=0001-00001
 * defectuoso=1 //verdadero
 * falta=0 //falso
* @method GET
* @arrayReturn
    {
    "pagesize": 20,
    "pages": 1,
    "total_filtrado": 15,
    "cantidad_vencidos": 1,
    "cantidad_faltantes": 21,
    "cantidad_defectuosos": 20,
    "cantidad_stock": 5298,
    "resultado": [
        {
        "comprobanteid": 1,
        "productoid": 1,
        "fecha_vencimiento": null,
        "precio_unitario": 120,
        "defectuoso": 0,
        "egresoid": null,
        "depositoid": null,
        "falta": 1,
        "producto": "Aceite de girasol, 1,5lt (Arcor)",
        "vencido": 0,
        "cantidad": "1",
        "nro_remito": "0001-00001",
        "fecha_incial": "2020-06-17",
        "fecha_emision": "2020-03-15",
        "total": 292.99,
        "proveedorid": null,
        "descripcion": "esto es una descripcion del stock entrante",
        "nombre": "Aceite de girasol",
        "codigo": "A300",
        "unidad_valor": "1,5",
        "unidad_medidaid": 3,
        "marcaid": 1,
        "categoriaid": 1,
        "marca": "Arcor",
        "unidad_medida": "lt"
        },
        ...
        {
            "comprobanteid": 1,
            "productoid": 1,
            "fecha_vencimiento": "2020-03-10",
            "precio_unitario": 120,
            "defectuoso": 0,
            "egresoid": null,
            "depositoid": null,
            "falta": 0,
            "producto": "Aceite de girasol, 1,5lt (Arcor)",
            "vencido": 1,
            "cantidad": "110",
            "nro_remito": "0001-00001",
            "fecha_incial": "2020-06-17",
            "fecha_emision": "2020-03-15",
            "total": 292.99,
            "proveedorid": null,
            "descripcion": "esto es una descripcion del stock entrante",
            "nombre": "Aceite de girasol",
            "codigo": "A300",
            "unidad_valor": "1,5",
            "unidad_medidaid": 3,
            "marcaid": 1,
            "categoriaid": 1,
            "marca": "Arcor",
            "unidad_medida": "lt"
        }
    ]
   }          
*/

/*****Para crear****
* @url http://api.gestor-inventario.local/inventarios 
* @method POST
* @param arrayJson
    {
	"nro_remito":"0001-00001",
	"fecha_emision":"2020-03-15",
	"total":292.99,
	"descripcion":"esto es una descripcion del stock entrante",
	"lista_producto":[
		{"id":1,"fecha_vencimiento":"2020-10-10","precio_unitario":120,"defectuoso":1,"cantidad":10},
		{"id":1,"fecha_vencimiento":"2020-10-10","precio_unitario":120,"falta":1,"cantidad":10},
		{"id":1,"fecha_vencimiento":"2020-10-10","precio_unitario":120,"cantidad":100},
		{"id":1,"fecha_vencimiento":"2020-11-11","precio_unitario":120,"cantidad":50}
	]
    }
**/

/**** Para modificar*****
* @url http://api.gestor-inventario.local/inventarios/{$id} 
* @method PUT
* @param arrayJson
**/

/****** Para visualizar*****
* @url http://api.gestor-inventario.local/inventarios/{$id} 
* @method GET
* @return arrayJson
*/

/****** Para borrar una localidad *****
* @url http://api.gestor-inventario.local/inventarios/{$id} 
* @method Delete
* @return arrayJson
*/
