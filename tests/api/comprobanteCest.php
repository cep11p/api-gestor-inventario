<?php 
use Helper\Api;
class comprobanteCest
{
    /**
     *
     * @var Helper\Api
     */    
    protected $api;
    
    public function _before(ApiTester $I,Api $api)
    {
        $I->wantTo('Login');
        $token = $api->generarToken();
        $I->amBearerAuthenticated($token);
    }

    // tests
    public function verUnComprobante(ApiTester $I)
    {
        $I->wantTo('Visualizar un comprobante');
        $I->sendGET('/comprobantes/1');
        $I->seeResponseContainsJson([
            "id"=> 1,
            "nro_remito"=> "0001-00001",
            "fecha_inicial"=> "2019-03-03",
            "fecha_emision"=> "2019-03-03",
            "total"=> 7500,
            "proveedorid"=> 1,
            "descripcion"=> "Esto es una descripcion hecha por fixture 1",
            "producto_cant_total"=> "12",
            "lista_producto"=> [
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "2019-03-03",
                    "precio_unitario"=> 100,
                    "defectuoso"=> true,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "precio_total"=> 100,
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A300",
                    "unidad_valor"=> "1,5",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "lt",
                    "producto"=> "Aceite de girasol, 1,5lt (Arcor)"
                ],
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 2,
                    "fecha_vencimiento"=> "2019-03-20",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "egresoid"=> 2,
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "2",
                    "precio_total"=> 600,
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A301",
                    "unidad_valor"=> "900",
                    "unidad_medidaid"=> 4,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "ml",
                    "producto"=> "Aceite de girasol, 900ml (Arcor)"
                ],
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "2019-03-20",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "egresoid"=> 3,
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "4",
                    "precio_total"=> 1200,
                    "nombre"=> "Arroz blanco",
                    "codigo"=> "A302",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 1,
                    "marcaid"=> 168,
                    "categoriaid"=> 1,
                    "marca"=> "Dos hermanos",
                    "unidad_medida"=> "kg",
                    "producto"=> "Arroz blanco, 1kg (Dos hermanos)"
                ],
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 9,
                    "fecha_vencimiento"=> "2019-03-20",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "egresoid"=> 2,
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "3",
                    "precio_total"=> 900,
                    "nombre"=> "Lavandina",
                    "codigo"=> "A308",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 102,
                    "categoriaid"=> 2,
                    "marca"=> "Oddis nuts",
                    "unidad_medida"=> "lt",
                    "producto"=> "Lavandina, 1lt (Oddis nuts)"
                ],
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 9,
                    "fecha_vencimiento"=> "2119-04-03",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "egresoid"=> 1,
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "precio_total"=> 300,
                    "nombre"=> "Lavandina",
                    "codigo"=> "A308",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 102,
                    "categoriaid"=> 2,
                    "marca"=> "Oddis nuts",
                    "unidad_medida"=> "lt",
                    "producto"=> "Lavandina, 1lt (Oddis nuts)"
                ],
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 5,
                    "fecha_vencimiento"=> "2120-03-04",
                    "precio_unitario"=> 200,
                    "defectuoso"=> true,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "precio_total"=> 200,
                    "nombre"=> "Arvejas",
                    "codigo"=> "A304",
                    "unidad_valor"=> "300",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 60,
                    "categoriaid"=> 1,
                    "marca"=> "Noel",
                    "unidad_medida"=> "gr",
                    "producto"=> "Arvejas, 300gr (Noel)"
                ]
            ]
        ]);
        $I->seeResponseCodeIs(200);
    }
}
