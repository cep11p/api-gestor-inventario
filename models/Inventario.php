<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use \app\models\base\Inventario as BaseInventario;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "inventario".
 */
class Inventario extends BaseInventario
{
    public $cantidad;
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['fecha_vencimiento','date','format' => 'php:Y-m-d'],
            ]
        );
    }
    
    public function newStock($param) {
        $comprobante = new \app\models\Comprobante();
        
        /**** Nuevo Comprobante *****/
        $comprobante->setAttributesCustom($param);
        if(!$comprobante->save()){
            throw new Exception(json_encode($comprobante->getErrors()));
        }
        
        /** Agregamos al stock un lista de productos **/
        $this->agregarProductoAlStock($comprobante->id, $param);
        
        return $comprobante->id;
    }
    
    private function agregarProductoAlStock($comprobanteid, $param) {
        
        if(!isset($param['lista_producto']) || count($param['lista_producto'])<=0){
            throw new Exception('Falta lista de productos');
        }
        
        foreach ($param['lista_producto'] as $producto) {
            if(!is_numeric($producto['cantidad']) || intval($producto['cantidad'])<=0){
                throw new Exception('La cantidad debe ser un numero y mayor a 0');
            }

            /** Guardamos un stock segun la cantidad de cada producto **/
            if(isset($producto['cantidad']) && $producto['cantidad']>0){
                for($i = 1; $i <= $producto['cantidad']; $i++ ){
                    $stock = new Inventario();
                    $stock->setAttributes($producto);
                    $stock->comprobanteid = $comprobanteid;
                    $stock->productoid = $producto['id'];
                    if(!$stock->save()){
                        throw new Exception(json_encode($stock->getErrors()));
                    }
                }                    
            }
        }
    }
    
    /**
     * Chequeamos si los productos son defectuosos
     * @return boolean
     */
    private function esDefectuoso() {
        $resultado = false;
        if($this->defectuoso == 1){
            $resultado = true;
        }
        
        return $resultado;
    }
    
    /**
     * Chequeamos si los productos son Faltantes
     * @return boolean
     */
    private function esFaltante() {
        $resultado = false;
        if($this->falta == 1){
            $resultado = true;
        }
        
        return $resultado;
    }
    
    /**
     * Chequeamos si los productos son adecuados para ser visto como stock
     * @return boolean
     */
    private function esStock() {
        $resultado = false;
        if($this->falta == 0 && $this->defectuoso == 0){
            $resultado = true;
        }
        
        return $resultado;
    }
    
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'producto'=> function($model){
                return $model->producto;
            },
            'vencido'=> function($model){
                $resultado = 0;
                if($model->fecha_vencimiento <= date('Y-m-d') && $model->fecha_vencimiento != null){
                    $resultado = 1;
                };
                return $resultado;
            }
        ]);
        
    }
}
