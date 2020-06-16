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
    
    public function crearNuevoStockSinListaProducto(ApiTester $I)
    {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registra un nuevo Stock sin lista de producto');
        
        $param = [
            "nro_remito"=>"0001-00001",
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
            "nro_remito"=>"0001-00001",
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
            'comprobanteid' => 1
        ]);        
        $I->seeResponseCodeIs(200);
    }
}
