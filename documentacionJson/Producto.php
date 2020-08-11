<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/productos
* @method GET
* @arrayReturn
 * [
    {
        "id": 1,
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
    {...},
    {
        "id": 2,
        "nombre": "Aceite de girasol",
        "codigo": "A301",
        "unidad_valor": "900",
        "unidad_medidaid": 4,
        "marcaid": 1,
        "categoriaid": 1,
        "marca": "Arcor",
        "unidad_medida": "ml",
        "producto": "Aceite de girasol, 900ml (Arcor)"
    }
 * ]
*/

/*****Para crear****
* @url http://api.gestor-inventario.local/productos 
* @method POST
* @param arrayJson
 * {
        "nombre": "Aceite de girasol",
        "unidad_valor": "1,5",
        "unidad_medidaid": 3,
        "marcaid": 1,
        "categoriaid": 1,
        "unidad_medida": "lt",
    }
**/

/**** Para modificar*****
* @url http://api.gestor-inventario.local/productos/{$id} 
* @method PUT
* @param arrayJson
 * {
        "nombre": "Aceite de girasol",
        "codigo": "A300",
        "unidad_valor": "1,5",
        "unidad_medidaid": 3,
        "marcaid": 1,
        "categoriaid": 1,
        "marca": "Arcor",
        "unidad_medida": "lt",
        "producto": "Aceite de girasol, 1,5lt (Arcor)"
    }
**/

/****** Para visualizar*****
* @url http://api.gestor-inventario.local/productos/{$id} 
* @method GET
* @return arrayJson
 * {
        "id": 1,
        "nombre": "Aceite de girasol",
        "codigo": "A300",
        "unidad_valor": "1,5",
        "unidad_medidaid": 3,
        "marcaid": 1,
        "categoriaid": 1,
        "marca": "Arcor",
        "unidad_medida": "lt",
        "producto": "Aceite de girasol, 1,5lt (Arcor)"
    }
*/

/****** Para borrar producto logicamente *****
* @url http://api.gestor-inventario.local/productos/set-activo/{$id} 
* @method PUT
* @return arrayJson
 * {
	"activo": false
    }
*/
