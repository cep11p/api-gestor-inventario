<?php 
use Helper\Api;
class egresoCest
{
    /**
     *
     * @var Helper\Api
     */    
    protected $api;
    
    public function _fixtures()
    {
        return [
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'egreso' => app\tests\fixtures\EgresoFixture::className(),
            'proveedor' => app\tests\fixtures\ProveedorFixture::className(),
        ];
    }
    
    public function _before(ApiTester $I,Api $api)
    {
        $I->wantTo('Login');
        $token = $api->generarToken();
        $I->amBearerAuthenticated($token);
    }

    public function verUnEgreso(ApiTester $I)
    {
        $I->wantTo('Visualizar un egreso');
        $I->sendGET('/egresos/1');
        $I->seeResponseContainsJson([
            "fecha"=> "2019-03-03",
            "origen"=> "origen1",
            "destino_nombre"=> "destino1",
            "destino_localidadid"=> 2626,
            "descripcion"=> "Esto es un egreso1 creado con fixture1",
            "nro_acta"=> "0001",
            "tipo_egresoid"=> 1,
            "fecha_inicial"=> "2019-02-10",
            "id"=> 1,
            "tipo_egreso"=> "Modulo",
            "producto_cant_total"=> 3,
            "lista_producto"=> [
                [
                    "comprobanteid"=> 3,
                    "productoid"=> 7,
                    "fecha_vencimiento"=> "2120-06-06",
                    "precio_unitario"=> 100,
                    "defectuoso"=> false,
                    "egresoid"=> 1,
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "precio_total"=> 100,
                    "nombre"=> "Detergente para vajillas",
                    "codigo"=> "A306",
                    "unidad_valor"=> "750",
                    "unidad_medidaid"=> 4,
                    "marcaid"=> 100,
                    "categoriaid"=> 2,
                    "marca"=> "Trever",
                    "unidad_medida"=> "ml",
                    "producto"=> "Detergente para vajillas, 750ml (Trever)"
                ],
                [
                    "comprobanteid"=> 4,
                    "productoid"=> 8,
                    "fecha_vencimiento"=> "2119-03-03",
                    "precio_unitario"=> 200,
                    "defectuoso"=> false,
                    "egresoid"=> 1,
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "precio_total"=> 200,
                    "nombre"=> "Jabón blanco en pan",
                    "codigo"=> "A307",
                    "unidad_valor"=> "200",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 101,
                    "categoriaid"=> 2,
                    "marca"=> "Canuelas",
                    "unidad_medida"=> "gr",
                    "producto"=> "Jabón blanco en pan, 200gr (Canuelas)"
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
                ]
            ]
        ]);
    }
    
    public function ListaDeEgreso(ApiTester $I)
    {        
        $I->wantTo('Visualizar lista de egreso');
        $I->sendGET('/egresos');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 3,
            "resultado"=> [
                [
                    "fecha"=> "2019-03-03",
                    "origen"=> "origen1",
                    "destino_nombre"=> "destino1",
                    "destino_localidadid"=> 2626,
                    "descripcion"=> "Esto es un egreso1 creado con fixture1",
                    "nro_acta"=> "0001",
                    "tipo_egresoid"=> 1,
                    "fecha_inicial"=> "2019-02-10",
                    "id"=> 1,
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 3
                ],
                [
                    "fecha"=> "2019-04-04",
                    "origen"=> "origen2",
                    "destino_nombre"=> "destino2",
                    "destino_localidadid"=> 2626,
                    "descripcion"=> "Esto es un egreso2 creado con fixture2",
                    "nro_acta"=> "0002",
                    "tipo_egresoid"=> 1,
                    "fecha_inicial"=> "2019-03-11",
                    "id"=> 2,
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 2
                ],
                [
                    "fecha"=> "2019-05-05",
                    "origen"=> "origen3",
                    "destino_nombre"=> "destino3",
                    "destino_localidadid"=> 2626,
                    "descripcion"=> "Esto es un egreso3 creado con fixture3",
                    "nro_acta"=> "0003",
                    "tipo_egresoid"=> 2,
                    "fecha_inicial"=> "2020-04-12",
                    "id"=> 3,
                    "tipo_egreso"=> "Bulto",
                    "producto_cant_total"=> 1
                ]
            ]
        ]);
    }
    
    public function CrearEgresoSinListaProducto(ApiTester $I)
    {        
        $I->wantTo('crear egreso sin lista producto');
        $param = [            
            "fecha"=>"2020-03-03",
            "origen"=>"Origen 1",
            "destino_nombre"=>"Destino 1",
            "destino_localidadid"=>2626,
            "nro_acta"=>"456-123",
            "tipo_egresoid"=>1,
            "descripcion"=>"Esto es una descripcion de egreso",
            "lista_producto"=>[]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Lista de producto vacia.'
        ]);
        $I->seeResponseCodeIs(400);
    }
    public function CrearEgresoSinProductoId(ApiTester $I)
    {        
        $I->wantTo('crear egreso sin lista producto id');
        $param = [            
            "fecha"=>"2020-03-03",
            "origen"=>"Origen 1",
            "destino_nombre"=>"Destino 1",
            "destino_localidadid"=>2626,
            "nro_acta"=>"456-123",
            "tipo_egresoid"=>1,
            "descripcion"=>"Esto es una descripcion de egreso",
            "lista_producto"=>[
                [
			"sinid"=>27
		],
		[
			"id"=>28
		],
		[
			"id"=>24
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Falta id de la lista de productos'
        ]);
        $I->seeResponseCodeIs(400);
    }
    
    public function CrearEgreso(ApiTester $I)
    {        
        $I->wantTo('crear egreso');
        $param = [            
            "fecha"=>"2020-03-03",
            "origen"=>"Origen 1",
            "destino_nombre"=>"Destino 1",
            "destino_localidadid"=>2626,
            "nro_acta"=>"456-123",
            "tipo_egresoid"=>1,
            "descripcion"=>"Esto es una descripcion de egreso",
            "lista_producto"=>[
                [
			"id"=>27
		],
		[
			"id"=>28
		],
		[
			"id"=>29
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Se registra el egreso'
        ]);
        $I->seeResponseCodeIs(200);
    }
    
    public function CrearEgresoConProductoEgresado(ApiTester $I)
    {        
        $I->wantTo('crear egreso con producto egresado');
        $param = [            
            "fecha"=>"2020-03-03",
            "origen"=>"Origen 1",
            "destino_nombre"=>"Destino 1",
            "destino_localidadid"=>2626,
            "nro_acta"=>"456-123",
            "tipo_egresoid"=>1,
            "descripcion"=>"Esto es una descripcion de egreso",
            "lista_producto"=>[
                [
			"id"=>27
		],
		[
			"id"=>28
		],
		[
			"id"=>23
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Algunos de los productos ya fueron egresados'
        ]);
        $I->seeResponseCodeIs(400);
    }
    
    public function CrearEgresoConProductoFaltante(ApiTester $I)
    {        
        $I->wantTo('crear egreso con producto faltante');
        $param = [            
            "fecha"=>"2020-03-03",
            "origen"=>"Origen 1",
            "destino_nombre"=>"Destino 1",
            "destino_localidadid"=>2626,
            "nro_acta"=>"456-123",
            "tipo_egresoid"=>1,
            "descripcion"=>"Esto es una descripcion de egreso",
            "lista_producto"=>[
                [
			"id"=>27
		],
		[
			"id"=>28
		],
		[
			"id"=>24
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Unos de los productos falta ser entregado por el proveedor'
        ]);
        $I->seeResponseCodeIs(400);
    }
    
//    public function FiltrarEgresoPorNroActa(ApiTester $I)
//    {
//        $I->haveFixtures([
//            'inventario' => app\tests\fixtures\InventarioFixture::className(),
//            'egreso' => app\tests\fixtures\EgresoFixture::className(),
//        ]);
//        
//        $I->wantTo('Visualizar lista de egreso');
//        $I->sendGET('/egresos');
//        $I->seeResponseContainsJson([
//            "pagesize"=> 20,
//            "pages"=> 1,
//            "total_filtrado"=> 3,
//            "resultado"=> [
//                [
//                    "id"=> 1,
//                    "fecha"=> "2019-03-03",
//                    "origen"=> "un origen",
//                    "destino_nombre"=> "Un destino",
//                    "destino_localidadid"=> 2626,
//                    "descripcion"=> "Esto es un egreso1 creado con fixture",
//                    "nro_acta"=> "0001"
//                ],
//                [
//                    "id"=> 2,
//                    "fecha"=> "2019-04-04",
//                    "origen"=> "un origen",
//                    "destino_nombre"=> "Un destino",
//                    "destino_localidadid"=> 2626,
//                    "descripcion"=> "Esto es un egreso2 creado con fixture",
//                    "nro_acta"=> "0002"
//                ],
//                [
//                    "id"=> 3,
//                    "fecha"=> "2019-05-05",
//                    "origen"=> "un origen",
//                    "destino_nombre"=> "Un destino",
//                    "destino_localidadid"=> 2626,
//                    "descripcion"=> "Esto es un egreso3 creado con fixture",
//                    "nro_acta"=> "0003"
//                ]
//            ]
//        ]);
//    }
}
