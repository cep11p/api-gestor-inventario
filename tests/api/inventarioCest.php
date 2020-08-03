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
        $I->wantTo('Se registra un nuevo Stock con campos vacios');
        
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
                ["id"=>2,"fecha_vencimiento"=>"2020-10-10","precio_unitario"=>120,"cantidad"=>100],
                ["id"=>3,"fecha_vencimiento"=>"2020-10-10","precio_unitario"=>100,"cantidad"=>10,"falta"=>1],
                ["id"=>1,"fecha_vencimiento"=>"2020-10-10","precio_unitario"=>120,"falta"=>true,"cantidad"=>10],
            ]
        ];
        
        $I->sendPOST('/inventarios',$param);
        
        $I->seeResponseContainsJson([
            'message' => 'Se guarda un nuevo stock',
            'comprobanteid' => 10
        ]);        
        $I->seeResponseCodeIs(200);
        $comprobanteid = app\models\Comprobante::findOne(['nro_remito'=>'0001-00010'])->id;
        $I->sendGET('/comprobantes/'.$comprobanteid);
        $I->seeResponseContainsJson([
            "id"=> 10,
            "nro_remito"=> "0001-00010",
            "fecha_inicial"=> date('Y-m-d'),
            "fecha_emision"=> "2020-03-15",
            "total"=> 2920.99,
            "proveedorid"=> "",
            "descripcion"=> "esto es una descripcion del stock entrante",
            "producto_cant_total"=> "220",
            "proveedor"=> "",
            "lista_producto"=> [
                [
                    "comprobanteid"=> 10,
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 120,
                    "defectuoso"=> false,
   
                    "depositoid"=> "",
                    "falta"=> true,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "10",
                    "precio_total"=> 1200,
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A300",
                    "unidad_valor"=> "1,5",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "lt",
                    "producto"=> "Aceite de girasol, 1,5lt (Arcor)",
                    'activo' => 1
                ],
                [
                    "comprobanteid"=> 10,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 100,
                    "defectuoso"=> false,
   
                    "depositoid"=> "",
                    "falta"=> true,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "10",
                    "precio_total"=> 1000,
                    "nombre"=> "Arroz blanco",
                    "codigo"=> "A302",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 1,
                    "marcaid"=> 168,
                    "categoriaid"=> 1,
                    "marca"=> "Dos hermanos",
                    "unidad_medida"=> "kg",
                    "producto"=> "Arroz blanco, 1kg (Dos hermanos)",
                    'activo' => 1
                ],
                [
                    "comprobanteid"=> 10,
                    "productoid"=> 1,
                    "fecha_vencimiento"=> "2020-10-10",
                    "precio_unitario"=> 120,
                    "defectuoso"=> false,
   
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "100",
                    "precio_total"=> 12000,
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A300",
                    "unidad_valor"=> "1,5",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "lt",
                    "producto"=> "Aceite de girasol, 1,5lt (Arcor)",
                    'activo' => 1
                ],
                [
                    "comprobanteid"=> 10,
                    "productoid"=> 2,
                    "fecha_vencimiento"=> "2020-10-10",
                    "precio_unitario"=> 120,
                    "defectuoso"=> false,    
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "100",
                    "precio_total"=> 12000,
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A301",
                    "unidad_valor"=> "900",
                    "unidad_medidaid"=> 4,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "ml",
                    "producto"=> "Aceite de girasol, 900ml (Arcor)",
                    'activo' => 1
                ]
            ]
        ]);  
    }
    
    public function verStock(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se visualiza el listado de stock');
        
        $I->sendGET('/inventarios');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 2,
            "cantidad_vencidos"=> 7,
            "cantidad_faltantes"=> 6,
            "cantidad_defectuosos"=> 3,
            "cantidad_stock"=> 5,
            "resultado"=> [
                [
                    "comprobanteid"=> 5,
                    "productoid"=> 8,
                    "fecha_vencimiento"=> "",
                    "precio_unitario"=> 30,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "3",
                    "nombre"=> "Jabón blanco en pan",
                    "codigo"=> "A307",
                    "unidad_valor"=> "200",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 101,
                    "categoriaid"=> 2,
                    "marca"=> "Canuelas",
                    "unidad_medida"=> "gr",
                    "producto"=> "Jabón blanco en pan, 200gr (Canuelas)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 5,
                    "productoid"=> 8,
                    "fecha_vencimiento"=> "2119-04-03",
                    "precio_unitario"=> 30,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> true,
                    "vencido"=> false,
                    "cantidad"=> "2",
                    "nombre"=> "Jabón blanco en pan",
                    "codigo"=> "A307",
                    "unidad_valor"=> "200",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 101,
                    "categoriaid"=> 2,
                    "marca"=> "Canuelas",
                    "unidad_medida"=> "gr",
                    "producto"=> "Jabón blanco en pan, 200gr (Canuelas)",
                    "activo"=> 1
                ]
            ]
        ]);   
        $I->seeResponseCodeIs(200);
    }
    
    public function verProductosVencidos(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se visualizan los productos vencidos');
        
        $I->sendGET('/inventarios?vencido=true');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 5,
            "cantidad_vencidos"=> 7,
            "cantidad_faltantes"=> 6,
            "cantidad_defectuosos"=> 3,
            "cantidad_stock"=> 5,
            "resultado"=> [
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
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A300",
                    "unidad_valor"=> "1,5",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "lt",
                    "producto"=> "Aceite de girasol, 1,5lt (Arcor)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 2,
                    "productoid"=> 2,
                    "fecha_vencimiento"=> "2019-04-03",
                    "precio_unitario"=> 200,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A301",
                    "unidad_valor"=> "900",
                    "unidad_medidaid"=> 4,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "ml",
                    "producto"=> "Aceite de girasol, 900ml (Arcor)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 3,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "2019-05-03",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "nombre"=> "Arroz blanco",
                    "codigo"=> "A302",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 1,
                    "marcaid"=> 168,
                    "categoriaid"=> 1,
                    "marca"=> "Dos hermanos",
                    "unidad_medida"=> "kg",
                    "producto"=> "Arroz blanco, 1kg (Dos hermanos)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 4,
                    "productoid"=> 4,
                    "fecha_vencimiento"=> "2019-06-06",
                    "precio_unitario"=> 100,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "nombre"=> "Arroz blanco",
                    "codigo"=> "A303",
                    "unidad_valor"=> "500",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 2,
                    "categoriaid"=> 1,
                    "marca"=> "La serenisima",
                    "unidad_medida"=> "gr",
                    "producto"=> "Arroz blanco, 500gr (La serenisima)",
                    "activo"=> 1
                ]
            ]
        ]);   
        $I->seeResponseCodeIs(200);
    }
    
    public function verProductosDefectuosos(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se visualizan los productos defectuoso');
        
        $I->sendGET('/inventarios?defectuoso=true');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 3,
            "cantidad_vencidos"=> 7,
            "cantidad_faltantes"=> 6,
            "cantidad_defectuosos"=> 3,
            "cantidad_stock"=> 5,
            "resultado"=> [
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
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A300",
                    "unidad_valor"=> "1,5",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "lt",
                    "producto"=> "Aceite de girasol, 1,5lt (Arcor)",
                    "activo"=> 1
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
                    "nombre"=> "Arvejas",
                    "codigo"=> "A304",
                    "unidad_valor"=> "300",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 60,
                    "categoriaid"=> 1,
                    "marca"=> "Noel",
                    "unidad_medida"=> "gr",
                    "producto"=> "Arvejas, 300gr (Noel)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 2,
                    "productoid"=> 6,
                    "fecha_vencimiento"=> "2120-03-30",
                    "precio_unitario"=> 300,
                    "defectuoso"=> true,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "nombre"=> "Azucar blanca",
                    "codigo"=> "A305",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 1,
                    "marcaid"=> 4,
                    "categoriaid"=> 1,
                    "marca"=> "Knorr",
                    "unidad_medida"=> "kg",
                    "producto"=> "Azucar blanca, 1kg (Knorr)",
                    "activo"=> 1
                ]
            ]
        ]);   
        $I->seeResponseCodeIs(200);
    }
    
    public function verProductosDefectuososYVencidos(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se visualizan los productos defectuoso y/o vencidos');
        
        $I->sendGET('/inventarios?defectuoso=true&vencido=true');
        $I->seeResponseContainsJson([
            "pagesize"=> 20,
            "pages"=> 1,
            "total_filtrado"=> 7,
            "cantidad_vencidos"=> 7,
            "cantidad_faltantes"=> 6,
            "cantidad_defectuosos"=> 3,
            "cantidad_stock"=> 5,
            "resultado"=> [
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
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A300",
                    "unidad_valor"=> "1,5",
                    "unidad_medidaid"=> 3,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "lt",
                    "producto"=> "Aceite de girasol, 1,5lt (Arcor)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 2,
                    "productoid"=> 2,
                    "fecha_vencimiento"=> "2019-04-03",
                    "precio_unitario"=> 200,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "nombre"=> "Aceite de girasol",
                    "codigo"=> "A301",
                    "unidad_valor"=> "900",
                    "unidad_medidaid"=> 4,
                    "marcaid"=> 1,
                    "categoriaid"=> 1,
                    "marca"=> "Arcor",
                    "unidad_medida"=> "ml",
                    "producto"=> "Aceite de girasol, 900ml (Arcor)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 3,
                    "productoid"=> 3,
                    "fecha_vencimiento"=> "2019-05-03",
                    "precio_unitario"=> 300,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "nombre"=> "Arroz blanco",
                    "codigo"=> "A302",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 1,
                    "marcaid"=> 168,
                    "categoriaid"=> 1,
                    "marca"=> "Dos hermanos",
                    "unidad_medida"=> "kg",
                    "producto"=> "Arroz blanco, 1kg (Dos hermanos)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 4,
                    "productoid"=> 4,
                    "fecha_vencimiento"=> "2019-06-06",
                    "precio_unitario"=> 100,
                    "defectuoso"=> false,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> true,
                    "cantidad"=> "1",
                    "nombre"=> "Arroz blanco",
                    "codigo"=> "A303",
                    "unidad_valor"=> "500",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 2,
                    "categoriaid"=> 1,
                    "marca"=> "La serenisima",
                    "unidad_medida"=> "gr",
                    "producto"=> "Arroz blanco, 500gr (La serenisima)",
                    "activo"=> 1
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
                    "nombre"=> "Arvejas",
                    "codigo"=> "A304",
                    "unidad_valor"=> "300",
                    "unidad_medidaid"=> 2,
                    "marcaid"=> 60,
                    "categoriaid"=> 1,
                    "marca"=> "Noel",
                    "unidad_medida"=> "gr",
                    "producto"=> "Arvejas, 300gr (Noel)",
                    "activo"=> 1
                ],
                [
                    "comprobanteid"=> 2,
                    "productoid"=> 6,
                    "fecha_vencimiento"=> "2120-03-30",
                    "precio_unitario"=> 300,
                    "defectuoso"=> true,
                    "egresoid"=> "",
                    "depositoid"=> "",
                    "falta"=> false,
                    "stock"=> false,
                    "vencido"=> false,
                    "cantidad"=> "1",
                    "nombre"=> "Azucar blanca",
                    "codigo"=> "A305",
                    "unidad_valor"=> "1",
                    "unidad_medidaid"=> 1,
                    "marcaid"=> 4,
                    "categoriaid"=> 1,
                    "marca"=> "Knorr",
                    "unidad_medida"=> "kg",
                    "producto"=> "Azucar blanca, 1kg (Knorr)",
                    "activo"=> 1
                ]
            ]
        ]);   
        $I->seeResponseCodeIs(200);
    }
    
    public function setearDefectuosoSinProductoid(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registrar defectuoso sin productoid');
        
        $param = [
            "fecha_vencimiento"=>"2119-04-03",
            "cantidad"=>3,
            "defectuoso"=>1
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'Se requiere el atributo productoid'
        ]);   
        $I->seeResponseCodeIs(400);
    }
    
    public function setearDefectuosoSinFechaVencimiento(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registrar defectuoso sin fecha vencimiento');
        
        $param = [
            "productoid"=>8,
            "cantidad"=>3,
            "defectuoso"=>1
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'La fecha es obligatoria y debe tener el formato aaaa-mm-dd'
        ]);   
        $I->seeResponseCodeIs(400);
    }
    
    public function setearDefectuosoSinCantidad(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registrar defectuoso sin cantidad');
        
        $param = [
            "fecha_vencimiento"=>"2119-04-03",
            "productoid"=>8,
            "defectuoso"=>1
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'La cantidad debe ser un numero mayor a 0'
        ]);   
        $I->seeResponseCodeIs(400);
    }
    
    public function setearDefectuosoConCantidadErronea(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registrar defectuoso con cantidad erronea');
        
        $param = [
            "fecha_vencimiento"=>"2119-04-03",
            "productoid"=>8,
            "defectuoso"=>1,
            "cantidad" => 'cero',
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'La cantidad debe ser un numero mayor a 0'
        ]);   
        $I->seeResponseCodeIs(400);
    }
    
    public function setearDefectuosoSinValorDefectuoso(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registrar defectuoso sin valor defectuoso');
        
        $param = [
            "fecha_vencimiento"=>"2119-04-03",
            "productoid"=>8,
            "cantidad" => 2,
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'El atributo defectuoso es obligatorio'
        ]);   
        $I->seeResponseCodeIs(400);
    }
    
    public function setearDefectuoso(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se registrar defectuoso');
        
        $param = [
            "fecha_vencimiento"=>"2119-04-03",
            "productoid"=>8,
            "cantidad" => 2,
            'defectuoso' => 1
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'Se registra el/los productos defectuosos'
        ]);   
        $I->seeResponseCodeIs(200);
    }
    
    public function revertirItemDefectuoso(ApiTester $I) {
        $I->haveFixtures([
            'inventario' => app\tests\fixtures\InventarioFixture::className(),
            'comprobante' => app\tests\fixtures\ComprobanteFixture::className(),
        ]);
        $I->wantTo('Se revierte un defectuoso');
        
        $param = [
            "fecha_vencimiento"=>"2120-03-30",
            "productoid"=>6,
            "cantidad" => 2,
            'defectuoso' => 0
        ];
        
        $I->sendPOST('/inventarios/set-defectuoso', $param);
        $I->seeResponseContainsJson([
            'message' => 'Se registra el/los productos defectuosos'
        ]);   
        $I->seeResponseCodeIs(200);
    }
}
