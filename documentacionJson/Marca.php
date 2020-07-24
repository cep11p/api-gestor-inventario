<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/marcas
* @method GET
* @arrayReturn
 * [
    {
        "id": 230,
        "nombre": "1 2 3 listo"
    },
    {
        "id": 338,
        "nombre": "1888"
    },
    {
        "id": 68,
        "nombre": "3 arroyos"
    },
    {
        "id": 256,
        "nombre": "3arroyos"
    },
    {
        "id": 289,
        "nombre": "7up"
    }
 * ]
*/

/*****Para crear****
* @url http://api.gestor-inventario.local/marcas 
* @method POST
* @param arrayJson
 * {
        "nombre": "nuevaMarca"
    }
**/

/**** Para modificar*****
* @url http://api.gestor-inventario.local/marcas/{$id} 
* @method PUT
* @param arrayJson
 * {
        "nombre": "MarcaModificada"
    }
**/

/****** Para visualizar*****
* @url http://api.gestor-inventario.local/marcas/{$id} 
* @method GET
* @return arrayJson
 * {
    "id": 1,
    "nombre": "Arcor"
    }
*/

/****** Para borrar una localidad *****
* @url http://api.gestor-inventario.local/marcas/{$id} 
* @method Delete
* @return arrayJson
*/
