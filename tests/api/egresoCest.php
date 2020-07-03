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
            "id"=> 1,
            "fecha"=> "2019-03-03",
            "origen"=> "un origen",
            "destino_nombre"=> "Un destino",
            "destino_localidadid"=> 2626,
            "descripcion"=> "Esto es un egreso1 creado con fixture",
            "nro_acta"=> "0001",
            "lista_producto"=> [
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
                ],
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
                    "id"=> 1,
                    "fecha"=> "2019-03-03",
                    "origen"=> "un origen",
                    "destino_nombre"=> "Un destino",
                    "destino_localidadid"=> 2626,
                    "descripcion"=> "Esto es un egreso1 creado con fixture",
                    "nro_acta"=> "0001"
                ],
                [
                    "id"=> 2,
                    "fecha"=> "2019-04-04",
                    "origen"=> "un origen",
                    "destino_nombre"=> "Un destino",
                    "destino_localidadid"=> 2626,
                    "descripcion"=> "Esto es un egreso2 creado con fixture",
                    "nro_acta"=> "0002"
                ],
                [
                    "id"=> 3,
                    "fecha"=> "2019-05-05",
                    "origen"=> "un origen",
                    "destino_nombre"=> "Un destino",
                    "destino_localidadid"=> 2626,
                    "descripcion"=> "Esto es un egreso3 creado con fixture",
                    "nro_acta"=> "0003"
                ]
            ]
        ]);
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
