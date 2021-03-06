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
            "producto_cant_total"=> "15",
            "proveedor"=> [
                "id"=> 1,
                "nombre"=> "proveedor1",
                "cuit"=> "10326547418"
            ],
            "lista_producto"=> [
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "depositoid"=> "",
                    "falta"=> true,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "3",
                    "precio_total"=> 900,
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
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "2019-03-03",
                    "precio_unitario"=> 100,
                    "defectuoso"=> true,
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
                    "producto_cant_total"=> "15",
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
    
    public function filtrarListaComprobantePorGlobalParam(ApiTester $I)
    {
        
        $I->wantTo('Filtrar lista de comprobante por global param');
        
        //Un acta
        $I->sendGET('/comprobantes?global_param=00001');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 1,
            "resultado"=> [
                [
                    "id"=> 1,
                    "nro_remito"=> "0001-00001",
                    "fecha_inicial"=> "2019-03-03",
                    "fecha_emision"=> "2019-03-03",
                    "total"=> 7500,
                    "proveedorid"=> 1,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 1",
                    "producto_cant_total"=> "15",
                    "proveedor"=> [
                        "id"=> 1,
                        "nombre"=> "proveedor1",
                        "cuit"=> "10326547418"
                    ]
                ]
            ]
        ]);
        $I->seeResponseCodeIs(200);
        
        //Una descripcion
        $I->sendGET('/comprobantes?global_param=fixture 2');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 1,
            "resultado"=> [
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
                ]
            ]
        ]);
        $I->seeResponseCodeIs(200);
    }
    
    public function filtrarListaComprobantePorRangoFecha(ApiTester $I)
    {
        
        $I->wantTo('Filtrar lista de comprobante por rango de fecha');
        
        //fecha desde
        $I->sendGET('/comprobantes?fecha_desde=2019-04-03');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 7,
            "resultado"=> [
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
        
        //hasta
        $I->sendGET('/comprobantes?fecha_hasta=2019-04-03');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 4,
            "resultado"=> [
                [
                    "id"=> 1,
                    "nro_remito"=> "0001-00001",
                    "fecha_inicial"=> "2019-03-03",
                    "fecha_emision"=> "2019-03-03",
                    "total"=> 7500,
                    "proveedorid"=> 1,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 1",
                    "producto_cant_total"=> "15",
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
        
        //desde y hasta
        $I->sendGET('/comprobantes?fecha_desde=2019-04-03&fecha_hasta=2020-03-04');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 5,
            "resultado"=> [
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
    
    // tests
    public function registrarProductoFaltaTrue(ApiTester $I)
    {
        $I->wantTo('registrar productos pendiente');
        $param = [
            "cantidad"=>2,
            "productoid"=>3,
            "fecha_vencimiento"=>"2019-03-20",
            "falta"=>'true'
        ];
        $I->sendPUT('/comprobantes/registrar-producto-pendiente/1',$param);
        $I->seeResponseContainsJson([
            "message"=> 'Se registran los productos pendientes de entregas',
            "comprobanteid"=> 1
        ]);
        
        $I->sendGET('/comprobantes/1');
        $I->seeResponseContainsJson([
            "id"=> 1,
            "nro_remito"=> "0001-00001",
            "fecha_inicial"=> "2019-03-03",
            "fecha_emision"=> "2019-03-03",
            "total"=> 7500,
            "proveedorid"=> 1,
            "descripcion"=> "Esto es una descripcion hecha por fixture 1",
            "producto_cant_total"=> "15",
            "proveedor"=> [
                "id"=> 1,
                "nombre"=> "proveedor1",
                "cuit"=> "10326547418"
            ],
            "lista_producto"=> [
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "depositoid"=> "",
                    "falta"=> true,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "5",
                    "precio_total"=> 1500,
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
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "2019-03-03",
                    "precio_unitario"=> 100,
                    "defectuoso"=> true,
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
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "2",
                    "precio_total"=> 600,
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
    }
    
    public function registrarProductoFaltaFalse(ApiTester $I)
    {
        $I->wantTo('registrar productos que faltaba (productos pendiente de entrega)');
        $param = [
            "cantidad"=>2,
            "productoid"=>3,
            "fecha_vencimiento"=>"2019-03-20",
            "falta"=>'false'
        ];
        $I->sendPUT('/comprobantes/registrar-producto-pendiente/1',$param);
        $I->seeResponseContainsJson([
            "message"=> 'Se registran los productos pendientes de entregas',
            "comprobanteid"=> 1
        ]);
        
        $I->sendGET('/comprobantes/1');
        $I->seeResponseContainsJson([
            "id"=> 1,
            "nro_remito"=> "0001-00001",
            "fecha_inicial"=> "2019-03-03",
            "fecha_emision"=> "2019-03-03",
            "total"=> 7500,
            "proveedorid"=> 1,
            "descripcion"=> "Esto es una descripcion hecha por fixture 1",
            "producto_cant_total"=> "15",
            "proveedor"=> [
                "id"=> 1,
                "nombre"=> "proveedor1",
                "cuit"=> "10326547418"
            ],
            "lista_producto"=> [
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "depositoid"=> "",
                    "falta"=> true,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "precio_total"=> 300,
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
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "2019-03-03",
                    "precio_unitario"=> 100,
                    "defectuoso"=> true,
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
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "6",
                    "precio_total"=> 1800,
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
    }
    
    public function registrarProductoPendienteSinAtributoFalta(ApiTester $I)
    {
        
        $I->wantTo('registrar productos pendiente sin el atributo falta');
        $param = [
            "cantidad"=>20,
            "productoid"=>3,
            "fecha_vencimiento"=>"2019-03-20",
        ];
        $I->sendPUT('/comprobantes/registrar-producto-pendiente/1',$param);
        $I->seeResponseContainsJson([
            "name"=> "Bad Request",
            "message"=> 'El atributo falta es obligatorio',
            "code"=> 0,
            "status"=> 400,
            "type"=> "yii\\web\\HttpException"
        ]);
        
        $I->seeResponseCodeIs(400);
    }
    
    public function registrarProductoPendienteConCantidadExcesiva(ApiTester $I)
    {
        
        $I->wantTo('registrar productos pendiente con cantidad excesiva');
        $param = [
            "cantidad"=>20,
            "productoid"=>3,
            "fecha_vencimiento"=>"2019-03-20",
            "falta"=>"true"
        ];
        $I->sendPUT('/comprobantes/registrar-producto-pendiente/1',$param);
        $I->seeResponseContainsJson([
            "name"=> "Bad Request",
            "message"=> 'La cantidad a modificar es mayor a la cantidad de productos existentes en el inventario (3)',
            "code"=> 0,
            "status"=> 400,
            "type"=> "yii\\web\\HttpException"
        ]);
        
        $I->seeResponseCodeIs(400);
    }
    
    public function registrarProductoPendienteSinCantidad(ApiTester $I)
    {
        
        $I->wantTo('registrar productos pendiente sin cantidad');
        $param = [
            "productoid"=>3,
            "fecha_vencimiento"=>"2019-03-20",
            "falta"=>"true"
        ];
        $I->sendPUT('/comprobantes/registrar-producto-pendiente/1',$param);
        $I->seeResponseContainsJson([
            "name"=> "Bad Request",
            "message"=> "La cantidad es obligatoria y debe ser un numero y mayor a 0",
            "code"=> 0,
            "status"=> 400,
            "type"=> "yii\\web\\HttpException"
        ]);
        
        $I->seeResponseCodeIs(400);
    }
    
    public function registrarProductoPendienteConFechaErronea(ApiTester $I)
    {
        
        $I->wantTo('registrar productos pendiente con fecha erronea');
        $param = [
            "cantidad"=>20,
            "productoid"=>3,
            "fecha_vencimiento"=>"2asd",
            "falta"=>"true"
        ];
        $I->sendPUT('/comprobantes/registrar-producto-pendiente/1',$param);
        $I->seeResponseContainsJson([
            "name"=> "Bad Request",
            "message"=> "La fecha es obligatoria y debe tener el formato aaaa-mm-dd",
            "code"=> 0,
            "status"=> 400,
            "type"=> "yii\\web\\HttpException"
        ]);
        
        $I->seeResponseCodeIs(400);
    }
}
