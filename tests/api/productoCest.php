<?php 
use Helper\Api;
class productoCest
{
    /**
     *
     * @var Helper\Api
     */    
    protected $api;
    
    public function _fixtures()
    {
        return [
            'producto' => app\tests\fixtures\ProductoFixture::className()
        ];
    }
    
    public function _before(ApiTester $I,Api $api)
    {
        $I->wantTo('Login');
        $token = $api->generarToken();
        $I->amBearerAuthenticated($token);
    }

    // tests
    public function crearProducto(ApiTester $I)
    {
        
        $param = [
            "nombre"=> "Aceite de girasol",
            "unidad_valor"=> "1,5",
            "unidad_medidaid"=> 3,
            "marcaid"=> 1,
            "categoriaid"=> 1,
            "unidad_medida"=> "lt",
        ];
        
        $I->wantTo('crear un producto');
        $I->sendPOST('/productos',$param);
        $I->seeResponseContainsJson([
            'message' => 'Se guarda un nuevo stock',
            'id' => 10,
        ]);
        $I->seeResponseCodeIs(200);       
    }
    
    public function crearProductoConCamposVacios(ApiTester $I)
    {
        
        $param = [];
        
        $I->wantTo('crear un producto con campos vacio');
        $I->sendPOST('/productos',$param);
        $I->seeResponseContainsJson([
            'message' => '{"nombre":["Nombre cannot be blank."],"unidad_medidaid":["Unidad Medidaid cannot be blank."],"marcaid":["Marcaid cannot be blank."],"categoriaid":["Categoriaid cannot be blank."]}'
        ]);
        $I->seeResponseCodeIs(400);       
    }
}
