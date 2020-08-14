<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/inventarios?parametro1=valor1&parametro2=valor2
* @parametros estos parametros sirven como criterio de busqueda
 * fecha_vencimiento=2020-03-03
 * fecha_emision=2020-03-03
 * nro_remito=0001-00001
 * defectuoso=true //verdadero
 * vencido=true //verdadero
 * unidad_medidaid=2
 * unidad=900
 * marcaid=1
 * categoriaid=1
 * fecha_vencimiento_desde=2019-04-03&fecha_vencimiento_hasta=2020-08-01 (filtrado de fecha por rango)
 * sort=-cantidad (ordenamiento desc)
 * sort=cantida (ordenamiento asc)
 * sort=-producto (ordenamiento desc)
 * sort=producto (ordenamiento asc)
 * sort=-categoriaid (ordenamiento desc)
 * sort=categoriaid (ordenamiento asc)
 * sort=-fecha_vencimiento (ordenamiento desc)
 * sort=fecha_vencimiento (ordenamiento asc)
* @method GET
* @arrayReturn
{
    "pagesize": 20,
    "pages": 1,
    "total_filtrado": 2,
    "cantidad_vencidos": 4,
    "cantidad_faltantes": 3,
    "cantidad_defectuosos": 3,
    "cantidad_stock": 5,
    "resultado": [
        {
            "comprobanteid": 5,
            "productoid": 8,
            "fecha_vencimiento": "",
            "precio_unitario": 30,
            "defectuoso": false,
            "egresoid": "",
            "depositoid": "",
            "falta": false,
            "stock": true,
            "vencido": false,
            "cantidad": "3",
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
            "comprobanteid": 5,
            "productoid": 8,
            "fecha_vencimiento": "2119-04-03",
            "precio_unitario": 30,
            "defectuoso": false,
            "egresoid": "",
            "depositoid": "",
            "falta": false,
            "stock": true,
            "vencido": false,
            "cantidad": "2",
            "nombre": "Jabón blanco en pan",
            "codigo": "A307",
            "unidad_valor": "200",
            "unidad_medidaid": 2,
            "marcaid": 101,
            "categoriaid": 2,
            "marca": "Canuelas",
            "unidad_medida": "gr",
            "producto": "Jabón blanco en pan, 200gr (Canuelas)"
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

/****** Para setear un producto defectuoso o viceversa*****
 * Se necesita el productoid y la fecha exacta para agrupar y cuantificar la cantidad exacta a setear como defectuoso o viceversa. Es funcion asigna y desasigna defectuosos
* @url http://api.gestor-inventario.local/inventarios/set-defectuoso 
* @method POST
* @return arrayJsonç
{
    "fecha_vencimiento":"2119-04-03",
    "productoid":8,
    "cantidad":3,
    "defectuoso":0
}
*/
