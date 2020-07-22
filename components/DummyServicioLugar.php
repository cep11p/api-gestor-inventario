<?php

namespace app\components;
use yii\base\Component;
use GuzzleHttp\Client;
use Exception;


/**
 * Description of ServicioLugar
 *
 * @author cep11p
 */
class DummyServicioLugar extends Component implements IServicioLugar
{
    public $base_uri;
    private $_client;
   
    public function __construct(Client $guzzleClient, $config=[])
    {
        parent::__construct($config);
        $this->_client = $guzzleClient;
    }
   
    /**
     * Buscar la localidad por id y devuelve los datos de la localidad encontrada
     * @param int $id
     * @return boolean
     */
    public function buscarLocalidadPorId($id)
    {       
        #preparamos el resultado
        $resultado = array(
            "id"=> 2640,
            "nombre"=> "ViedmaDummy",
            "regionid"=> null,
            "departamentoid"=> 405,
            "municipioid"=> null            
        );        
        
        return $resultado;
       
    }
    
    public function crearLugar($data)
    {
        return 1;
    }
    
    
    public function buscarLugar($param)
    {
        #injectamos el array de datos (mock)
        $data = require(\Yii::getAlias('@app').'/components/DataLugar.php');   
        
        
        $arrayEncontrado = Help::filtrarArrayAsociativo($data, $param);
        
        $response = $coleccion = array(
            "success"=>true,
            "resultado"=>array(),
        );
        if(isset($arrayEncontrado)){
            $response['resultado'][] = $arrayEncontrado;
        }
        
        return $response;
       
    }
    
    public function buscarLugarIdentico($param)
    {
        #injectamos el array de datos (mock)
        $data = require(\Yii::getAlias('@app').'/components/DataLugar.php');   
        
        
        $arrayEncontrado = Help::filtrarArrayAsociativo($data, $param);
        
        $response = $coleccion = array(
            "success"=>true,
            "resultado"=>array(),
        );
        if(isset($arrayEncontrado)){
            $response['resultado'][] = $arrayEncontrado;
        }
        
        return $response;
       
    }
    
    public function buscarLocalidad($param)
    {
        #injectamos el array de datos (mock)
        $data = require(\Yii::getAlias('@app').'/components/DataLugar.php');   
        
        #set page
        $page = 0;
        if(isset($param['page']) && is_numeric($param['page'])){
            $page = $param['page'];
        }
        
        #preparamos el resultado
        $resultado = array(
            "success"=>FALSE,
            "resultado"=>array()
        );
        
        $data = array_chunk($data, 20);
        
        $response = $coleccion = array(
            "success"=> "true",
            "pagesize"=> 20,
            "pages"=> 6,
            "total_filtrado"=> 104,
            "resultado"=>$data,
        );
        
        return $response;
       
    }
    
    public function buscarMunicipio($param = array())
    {
        
        $response = $coleccion = array(
            "lista"=> "crear listado para el dev"
        );
        
        return $response;
       
    }
    
    public function buscarDelegacion($param = array())
    {
        
        $response = $coleccion = array(
            "lista"=> "crear listado para el dev"
        );
        
        return $response;
       
    }
    
    public function buscarComisionFomento($param = array())
    {
        
        $response = $coleccion = array(
            "lista"=> "crear listado para el dev"
        );
        
        return $response;
       
    }
    
    public function buscarLugarPorId($id)
    {
       
        #injectamos el array de datos (mock)
        $data = require(\Yii::getAlias('@app').'/components/DataLugar.php');
        
        #preparamos el resultado
        $resultado = array(
            "success"=>FALSE,
            "resultado"=>array()
        );
        
        #filtramos por la clave el array $data
        $modelEncontrado = Help::filter_by_value($data, 'id', $id);        
        
        if($modelEncontrado){
            $resultado['success'] = true;
            $resultado['resultado'] = $modelEncontrado;
        }
        
        return $resultado;
    }
    public function buscarDelegacionPorId($id)
    {
       
        
        return 'sin hacer';
    }
    public function buscarMunicipioPorId($id)
    {
       
        
        return 'sin hacer';
    }
    public function buscarComisionFomentoPorId($id)
    {
       
        
        return 'sin hacer';
    }
    
    
    /**
     * crear un string con los criterio de busquedad por ejemplo: localidadid=1&calle=mata negra&altura=123
     * @param array $param
     * @return string
     */
    public function crearCriterioBusquedad($param){
        //funcion armar url con criterio de busquedad
        $criterio = '';
        $primeraVez = true;
        foreach ($param as $key => $value) {
            if($primeraVez){
                $criterio.=$key.'='.$value;
                $primeraVez = false;
            }else{
                $criterio.='&'.$key.'='.$value;
            }            
        }
        
        return $criterio;
    }
    
    
    
    /**
     * 
     * @param int $nro_documento
     * @return int personaid
     */
    public static function buscarPersonaEnRegistralPorNumeroDocuemento($nro_documento)
    {
        $resultado = null;
        
        return $resultado;
    }
    
    public function obtenerParametro() {
        return [];
    }
    public function obtenerParametroPersonalizado($param) {
        return [];
    }
   
   
   
       
}