<?php

/**** Para mostrar listado ****/
/**
* @url http://api.gestor-inventario.local/unidad-medidas
* @method GET
* @arrayReturn
[
    {
        "id": 1,
        "nombre": "Kilogramo",
        "simbolo": "kg"
    },
    {
        "id": 2,
        "nombre": "Gramo",
        "simbolo": "gr"
    },
    {
        "id": 3,
        "nombre": "Litro",
        "simbolo": "lt"
    },
    {
        "id": 4,
        "nombre": "Mililitro",
        "simbolo": "ml"
    },
    {
        "id": 5,
        "nombre": "Unidad",
        "simbolo": "un"
    },
    {
        "id": 6,
        "nombre": "Centimetros cúbicos",
        "simbolo": "cm3"
    }
]
*/

/*****Para crear****
* @url http://api.gestor-inventario.local/unidad-medidas 
* @method POST
* @param arrayJson
{
    "nombre": "Centimetros cúbicos",
    "simbolo": "cm3"
}
**/

/**** Para modificar*****
* @url http://api.gestor-inventario.local/unidad-medidas/{$id} 
* @method PUT
* @param arrayJson
{
    "nombre": "Centimetros cúbicos modificar",
    "simbolo": "cm3"
}
**/

/****** Para visualizar*****
* @url http://api.gestor-inventario.local/unidad-medidas/{$id} 
* @method GET
* @return arrayJson
{
    "id": 6,
    "nombre": "Centimetros cúbicos modificar",
    "simbolo": "cm3"
}
*/
