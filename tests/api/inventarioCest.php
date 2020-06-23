<?php 

use Helper\Api;

class inventarioCest
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
    
    #beforeAll
    public function _fixtures()
    {
//        return [
//            'inventarios' => app\tests\fixtures\InventarioFixture::className(),
//        ];
    }
    
    // tests
    public function crearNuevoStockConCamposVacios(ApiTester $I)
    {
        $I->wantTo('Se registra un nuevo Stock');
        
        $I->sendPOST('/inventarios',[]);
        
        $I->seeResponseContainsJson([
            'message' => '{"nro_remito":["Nro Remito cannot be blank."],"fecha_emision":["Fecha Emision cannot be blank."]}'
        ]);        
        $I->seeResponseCodeIs(400);
    }
    
    public function crearNuevoStockConNroRemitoExistente(ApiTester $I)
    {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registra un nuevo Stock con nro remito existente');
        
        $param = [
            "nro_remito"=>"0001-00001",
            "fecha_emision"=>"2020-03-15",
            "total"=>2920.99,
            "descripcion"=>"esto es una descripcion del stock entrante",
            "lista_producto"=>[]
        ];
        
        $I->sendPOST('/inventarios',$param);
        
        $I->seeResponseContainsJson([
            'message' => '{"nro_remito":["Nro Remito \"0001-00001\" has already been taken."]}'
        ]);        
        $I->seeResponseCodeIs(400);
    }
    
    public function crearNuevoStockSinListaProducto(ApiTester $I)
    {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registra un nuevo Stock sin lista de producto');
        
        $param = [
            "nro_remito"=>"0001-00010",
            "fecha_emision"=>"2020-03-15",
            "total"=>2920.99,
            "descripcion"=>"esto es una descripcion del stock entrante",
            "lista_producto"=>[]
        ];
        
        $I->sendPOST('/inventarios',$param);
        
        $I->seeResponseContainsJson([
            'message' => 'Falta lista de productos'
        ]);        
        $I->seeResponseCodeIs(400);
    }
    
    public function crearNuevoStock(ApiTester $I)
    {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registra un nuevo Stock');
        
        $param = [
            "nro_remito"=>"0001-00010",
            "fecha_emision"=>"2020-03-15",
            "total"=>2920.99,
            "descripcion"=>"esto es una descripcion del stock entrante",
            "lista_producto"=>[
                ["id"=>1,"fecha_vencimiento"=>"2020-10-10","precio_unitario"=>120,"cantidad"=>100],
            ]
        ];
        
        $I->sendPOST('/inventarios',$param);
        
        $I->seeResponseContainsJson([
            'message' => 'Se guarda un nuevo stock',
            'comprobanteid' => 10
        ]);        
        $I->seeResponseCodeIs(200);
    }
    
    public function verInventario(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se visualiza todo el inventario');
        
        $I->sendGET('/inventarios');
        $I->seeResponseContainsJson([
            'pagesize' => 20,
            'pages' => 1,
            'total_filtrado' => 11,
            'cantidad_vencidos' => 3,
            'cantidad_faltantes' => 3,
            'cantidad_defectuosos' => 3,
            'cantidad_stock' => 5,
            'resultado' => Array (
                [
                    "comprobanteid"=> 5,
                    "productoid"=> 8,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 30,
                    "defectuoso"=> 0,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> 0,
                    "vencido"=> 0,
                    "cantidad"=> "3",
                    "nro_remito"=> "0001-00005",
                    "fecha_inicial"=> "2020-03-04",
                    "fecha_emision"=> "2020-03-04",
                    "total"=> 7500,
                    "proveedorid"=> 3,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 5",
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
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "2019-03-03",
                    "precio_unitario"=> 100,
                    "defectuoso"=> 1,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> 0,
                    "vencido"=> 1,
                    "cantidad"=> "1",
                    "nro_remito"=> "0001-00001",
                    "fecha_inicial"=> "2019-03-03",
                    "fecha_emision"=> "2019-03-03",
                    "total"=> 7500,
                    "proveedorid"=> 1,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 1",
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
                    "comprobanteid"=> 2,
                    "productoid"=> 10,
                    "fecha_vencimiento"=> "2019-03-03",
                    "precio_unitario"=> 100,
                    "defectuoso"=> 0,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> 0,
                    "vencido"=> 1,
                    "cantidad"=> "1",
                    "nro_remito"=> "0001-00002",
                    "fecha_inicial"=> "2019-04-03",
                    "fecha_emision"=> "2019-04-03",
                    "total"=> 2099.99,
                    "proveedorid"=> 1,
                    "descripcion"=> "Esto es una descripcion hecha por fixture 2",
                    "producto"=> []
                ]
            )

        ]);   
        $I->seeResponseCodeIs(200);
    }
}
