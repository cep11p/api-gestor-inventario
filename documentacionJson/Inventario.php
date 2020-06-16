<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/inventarios
* @method GET
* @arrayReturn
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
