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
            "suscrito"=> "suscrito1",
            "tipo_egreso"=> "Modulo",
            "producto_cant_total"=> 3,
            "destino_localidad"=> "Rio Colorado",
            "lista_producto"=> [
                [
                    "comprobanteid"=> 3,
                    "productoid"=> 7,
                    "fecha_vencimiento"=> "2120-06-06",
                    "precio_unitario"=> 100,
                    "egresoid"=> 1,
                    "depositoid"=> "",
                    "cantidad"=> "1",
                    "precio_total"=> 100,
                    "nombre"=> "Detergente para vajillas",
                    "codigo"=> "A306",
                    "unidad_valor"=> "750",
                    "unidad_medidaid"=> 4,
                    "marcaid"=> 100,
                    "categoriaid"=> 2,
                    "activo"=> 1,
                    "marca"=> "Trever",
                    "unidad_medida"=> "ml",
                    "producto"=> "Detergente para vajillas, 750ml (Trever)"
                ],
                [
                    "comprobanteid"=> 4,
                    "productoid"=> 8,
                    "fecha_vencimiento"=> "2119-03-03",
                    "precio_unitario"=> 200,
                    "egresoid"=> 1,
                    "depositoid"=> "",
                    "cantidad"=> "1",
                    "precio_total"=> 200,
                    "nombre"=> "Jabón blanco en pan",
                    "codigo"=> "A307",
                    "unidad_valor"=> "200",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 101,
                    "categoriaid"=> 2,
                    "activo"=> 1,
                    "marca"=> "Canuelas",
                    "unidad_medida"=> "gr",
                    "producto"=> "Jabón blanco en pan, 200gr (Canuelas)"
                ],
                [
                    "comprobanteid"=> 1,
                    "productoid"=> 9,
                    "fecha_vencimiento"=> "2119-04-03",
                    "precio_unitario"=> 300,
                    "egresoid"=> 1,
                    "depositoid"=> "",
                    "cantidad"=> "1",
                    "precio_total"=> 300,
                    "nombre"=> "Lavandina",
                    "codigo"=> "A308",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 102,
                    "categoriaid"=> 2,
                    "activo"=> 1,
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
                    "suscrito"=> "suscrito1",
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
                    "suscrito"=> "suscrito2",
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
                    "suscrito"=> "suscrito3",
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
            'message' => 'En la lista de productos, algunos de ellos no tienen vinculado su id'
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
                    "productoid"=>8,
                    "fecha_vencimiento"=>"",
                    "cantidad"=>3
		],
		[
                    "productoid"=>3,
                    "fecha_vencimiento"=>"2019-03-20",
                    "cantidad"=>3
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Se registra un egreso',
            'id' => 4
        ]);
        $I->seeResponseCodeIs(200);
    }
    
    public function CrearEgresoConfechaInvalida(ApiTester $I)
    {        
        $I->wantTo('crear egreso con fecha invalida');
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
                    "productoid"=>8,
                    "fecha_vencimiento"=>"",
                    "cantidad"=>3
		],
		[
                    "productoid"=>3,
                    "fecha_vencimiento"=>"asd",
                    "cantidad"=>3
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'La fecha debe tener el formato aaaa-mm-dd'
        ]);
        $I->seeResponseCodeIs(400);
    }
    
    public function CrearEgresoSinCantidad(ApiTester $I)
    {        
        $I->wantTo('crear egreso sin cantidad');
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
                    "productoid"=>8,
                    "fecha_vencimiento"=>"",
                    "cantidad"=>3
		],
		[
                    "productoid"=>3,
                    "fecha_vencimiento"=>"",
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'La cantidad es obligatoria y debe ser un numero mayor a 0'
        ]);
        $I->seeResponseCodeIs(400);
    }
    
    public function CrearEgresoConCantidadExcesiva(ApiTester $I)
    {        
        $I->wantTo('crear egreso con cantidad excesiva');
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
                    "productoid"=>8,
                    "fecha_vencimiento"=>"",
                    "cantidad"=>30
		],
		[
                    "productoid"=>3,
                    "fecha_vencimiento"=>"",
                    "cantidad"=>3
		]
            ]
        ];
        $I->sendPOST('/egresos',$param);
        $I->seeResponseContainsJson([
            'message' => 'La cantidad a egresar es mayor a la cantidad de productos en stock'
        ]);
        $I->seeResponseCodeIs(400);
    }
    
    
    public function FiltrarEgresoPorNroActa(ApiTester $I)
    {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'egreso' => app\tests\fixtures\EgresoFixture::className(),
        ]);
        
        $I->wantTo('filtrar por nro acta');
        $I->sendGET('/egresos?global_param=0002');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 1,
            "resultado"=> [
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
                    "suscrito"=> "suscrito2",
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 2,
                    "destino_localidad"=> "Rio Colorado"
                ]
            ]
        ]);
    }
    
    public function FiltrarEgresoPorRangoDeFecha(ApiTester $I)
    {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'egreso' => app\tests\fixtures\EgresoFixture::className(),
        ]);
        
        //desde
        $I->wantTo('filtrar por rango de fecha');
        $I->sendGET('/egresos?fecha_desde=2019-04-04');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 2,
            "resultado"=> [
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
                    "suscrito"=> "suscrito2",
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 2,
                    "destino_localidad"=> "Rio Colorado"
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
                    "suscrito"=> "suscrito3",
                    "tipo_egreso"=> "Bulto",
                    "producto_cant_total"=> 1,
                    "destino_localidad"=> "Rio Colorado"
                ]
            ]
        ]);
        
        //hasta
        $I->sendGET('/egresos?fecha_hasta=2019-04-04');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 2,
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
                    "suscrito"=> "suscrito1",
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 3,
                    "destino_localidad"=> "Rio Colorado"
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
                    "suscrito"=> "suscrito2",
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 2,
                    "destino_localidad"=> "Rio Colorado"
                ]
            ]
        ]);
        
        //desde y hasta
        $I->sendGET('/egresos?fecha_desde=2019-03-03&fecha_hasta=2019-05-05');
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
                    "suscrito"=> "suscrito1",
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 3,
                    "destino_localidad"=> "Rio Colorado"
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
                    "suscrito"=> "suscrito2",
                    "tipo_egreso"=> "Modulo",
                    "producto_cant_total"=> 2,
                    "destino_localidad"=> "Rio Colorado"
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
                    "suscrito"=> "suscrito3",
                    "tipo_egreso"=> "Bulto",
                    "producto_cant_total"=> 1,
                    "destino_localidad"=> "Rio Colorado"
                ]
            ]
        ]);
    }
}
