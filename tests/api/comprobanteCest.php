<?php 
use Helper\Api;
class comprobanteCest
{
    /**
     *
     * @var Helper\Api
     */    
    protected $api;
    
    #beforeAll
    public function _fixtures()
    {
        return [
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
            'proveedor' => app\tests\fixtures\ProveedorFixture::className(),
        ];
    }
    
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
    
    public function verListaDeComprobante(ApiTester $I)
    {
        
        $I->wantTo('Ver Lista de comprobantes');
        $I->sendGET('/comprobantes');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 9,
            "resultado"=> [
                [
                    "id"=> 1,
                    "nro_remito"=> "0001-00001",
                    "fecha_inicial"=> "2019-03-03",
                    "fecha_emision"=> "2019-03-03",
                    "total"=> 7500,
                    "proveedorid"=> 1,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 1",
                    "producto_cant_total"=> "12",
                    "proveedor"=> [
                        "id"=> 1,
                        "nombre"=> "proveedor1",
                        "cuit"=> "10326547418"
                    ]
                ],
                [
                    "id"=> 2,
                    "nro_remito"=> "0001-00002",
                    "fecha_inicial"=> "2019-04-03",
                    "fecha_emision"=> "2019-04-03",
                    "total"=> 2099.99,
                    "proveedorid"=> 1,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 2",
                    "producto_cant_total"=> "2",
                    "proveedor"=> [
                        "id"=> 1,
                        "nombre"=> "proveedor1",
                        "cuit"=> "10326547418"
                    ]
                ],
                [
                    "id"=> 3,
                    "nro_remito"=> "0001-00003",
                    "fecha_inicial"=> "2019-05-03",
                    "fecha_emision"=> "2019-05-03",
                    "total"=> 1500.5,
                    "proveedorid"=> 2,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 3",
                    "producto_cant_total"=> "5",
                    "proveedor"=> [
                        "id"=> 2,
                        "nombre"=> "proveedor2",
                        "cuit"=> "10326547419"
                    ]
                ],
                [
                    "id"=> 4,
                    "nro_remito"=> "0001-00004",
                    "fecha_inicial"=> "2019-06-06",
                    "fecha_emision"=> "2019-06-06",
                    "total"=> 2000,
                    "proveedorid"=> 2,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 4",
                    "producto_cant_total"=> "2",
                    "proveedor"=> [
                        "id"=> 2,
                        "nombre"=> "proveedor2",
                        "cuit"=> "10326547419"
                    ]
                ],
                [
                    "id"=> 5,
                    "nro_remito"=> "0001-00005",
                    "fecha_inicial"=> "2020-03-04",
                    "fecha_emision"=> "2020-03-04",
                    "total"=> 7500,
                    "proveedorid"=> 3,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 5",
                    "producto_cant_total"=> "5",
                    "proveedor"=> [
                        "id"=> 3,
                        "nombre"=> "proveedor3",
                        "cuit"=> "10326547420"
                    ]
                ],
                [
                    "id"=> 6,
                    "nro_remito"=> "0001-00006",
                    "fecha_inicial"=> "2020-03-30",
                    "fecha_emision"=> "2020-03-30",
                    "total"=> 2099.99,
                    "proveedorid"=> "",
                    "descripcion"=> "Esto es una descripcion hecha por fixture 6",
                    "producto_cant_total"=> "0",
                    "proveedor"=> ""
                ],
                [
                    "id"=> 7,
                    "nro_remito"=> "0001-00007",
                    "fecha_inicial"=> "2020-06-06",
                    "fecha_emision"=> "2020-06-06",
                    "total"=> 1500.5,
                    "proveedorid"=> "",
                    "descripcion"=> "Esto es una descripcion hecha por fixture 7",
                    "producto_cant_total"=> "0",
                    "proveedor"=> ""
                ],
                [
                    "id"=> 8,
                    "nro_remito"=> "0001-00008",
                    "fecha_inicial"=> "2019-03-03",
                    "fecha_emision"=> "2019-03-03",
                    "total"=> 2000,
                    "proveedorid"=> "",
                    "descripcion"=> "Esto es una descripcion hecha por fixture 8",
                    "producto_cant_total"=> "0",
                    "proveedor"=> ""
                ],
                [
                    "id"=> 9,
                    "nro_remito"=> "0001-00009",
                    "fecha_inicial"=> "2019-04-03",
                    "fecha_emision"=> "2019-04-03",
                    "total"=> 7500,
                    "proveedorid"=> "",
                    "descripcion"=> "Esto es una descripcion hecha por fixture 9",
                    "producto_cant_total"=> "0",
                    "proveedor"=> ""
                ]
            ]
        ]);
        $I->seeResponseCodeIs(200);
    }
}
