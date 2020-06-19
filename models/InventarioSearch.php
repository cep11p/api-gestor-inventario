<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventario;

/**
* InventarioSearch represents the model behind the search form about `app\models\Inventario`.
*/
class InventarioSearch extends Inventario
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['comprobanteid', 'productoid', 'defectuoso', 'egresoid', 'depositoid', 'id', 'falta'], 'integer'],
            [['fecha_vencimiento','cantidad'], 'safe'],
            [['precio_unitario'], 'number'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    /**
     * Obtenemos la cantidad de productos vencidos que en el inventario
     * @return int
     */
    private function cantidadVencidos() {
        $query = new \yii\db\Query();
        
        $query->select([
            'cantidad_vencidos'=>'count(productoid)'
        ]);
        $query->from(['inventario']);
        $query->where(['<=','fecha_vencimiento', date('Y-m-d')]);
        $query->andWhere(['egresoid' => null]);
        $query->andWhere(['falta' => 0]);
        $query->andWhere(['defectuoso' => 0]);
        
        $command = $query->createCommand();        
        $rows = $command->queryAll();

        $resultado = ($rows[0]['cantidad_vencidos']=='')?0:$rows[0]['cantidad_vencidos'];
                
        return intval($resultado);     
    }
    
    /**
     * Obtenemos la cantidad de productos faltantes en el inventario
     * @return int
     */
    private function cantidadFaltantes() {
        $query = new \yii\db\Query();
        
        $query->select([
            'cantidad_faltantes'=>'count(productoid)'
        ]);
        $query->from(['inventario']);
        $query->where(['falta' => 1]);
        $query->andWhere(['egresoid' => null]);
        
        $command = $query->createCommand();        
        $rows = $command->queryAll();
        $resultado = ($rows[0]['cantidad_faltantes']=='')?0:$rows[0]['cantidad_faltantes'];
                
        return intval($resultado);     
    }
    
    /**
     * Obtenemos la cantidad de productos defectuosos en el inventario
     * @return int
     */
    private function cantidadDefectuosos() {
        $query = new \yii\db\Query();
        
        $query->select([
            'cantidad_defectuosos'=>'count(productoid)'
        ]);
        $query->from(['inventario']);
        $query->where(['defectuoso' => 1]);
        $query->andWhere(['egresoid' => null]);
        
        $command = $query->createCommand();        
        $rows = $command->queryAll();
        $resultado = ($rows[0]['cantidad_defectuosos']=='')?0:$rows[0]['cantidad_defectuosos'];
                
        return intval($resultado);     
    }
    
    /**
     * Obtenemos la cantidad de productos en stock
     * @return int
     */
    private function cantidadStock() {
        $query = new \yii\db\Query();
        
        $query->select([
            'cantidad_stock'=>'count(productoid)'
        ]);
        $query->from(['inventario']);
        $query->where(['defectuoso' => 0]);
        $query->andWhere(['>','fecha_vencimiento', date('Y-m-d')]);
        $query->andWhere(['falta' => 0]);
        $query->andWhere(['egresoid' => null]);
        
        $command = $query->createCommand();        
        $rows = $command->queryAll();
        $resultado = ($rows[0]['cantidad_stock']=='')?0:$rows[0]['cantidad_stock'];
                
        return intval($resultado);     
    }

    /**
    * Creates data provider instance with search query applied
    *
    * @param array $params
    *
    * @return ActiveDataProvider
    */
    public function search($params)
    {
        $query = Inventario::find();
        $pagesize = (!isset($params['pagesize']) || !is_numeric($params['pagesize']) || $params['pagesize']==0)?20:intval($params['pagesize']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pagesize,
                'page' => (isset($params['page']) && is_numeric($params['page']))?$params['page']:0
            ]
        ]);

        $this->load($params,'');

        if (!$this->validate()) {
        // uncomment the following line if you do not want to any records when validation fails
        // $query->where('0=1');
        return $dataProvider;
    }
    
        $query->select(['*','cantidad'=>'count(productoid)']);
        
        $query->where(['egresoid' => null]);
        $query->andFilterWhere([
            'comprobanteid' => $this->comprobanteid,
            'productoid' => $this->productoid,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'precio_unitario' => $this->precio_unitario,
            'defectuoso' => $this->defectuoso,
            'egresoid' => $this->egresoid,
            'depositoid' => $this->depositoid,
            'id' => $this->id,
            'falta' => $this->falta,
        ]);
        $query->groupBy(['fecha_vencimiento','productoid','defectuoso','falta']);
        
        $coleccion = array();
        foreach ($dataProvider->getModels() as $value) {
            $item = $value->toArray();
            $item['cantidad'] = $value->cantidad;
            
            $producto = $value->producto->toArray();
            $comprobante = $value->comprobante->toArray();
            
            unset($producto['id']);
            unset($comprobante['id']);
            unset($item['id']);

            
            $item = \yii\helpers\ArrayHelper::merge($item, $comprobante);
            $item = \yii\helpers\ArrayHelper::merge($item, $producto);
            $coleccion[] = $item;
        }
        
        $paginas = ceil($dataProvider->totalCount/$pagesize);           
        $data['pagesize']=$pagesize;            
        $data['pages']=$paginas;            
        $data['total_filtrado']=$dataProvider->totalCount;
        $data['cantidad_vencidos'] = $this->cantidadVencidos();
        $data['cantidad_faltantes'] = $this->cantidadFaltantes();
        $data['cantidad_defectuosos'] = $this->cantidadDefectuosos();
        $data['cantidad_stock'] = $this->cantidadStock();
        $data['resultado']=$coleccion;
        
        return $data;
    }
    
    
    public function obtenerProductosPorComprobanteid($comprobanteid)
    {
        $query = Inventario::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
    
        $query->select(['*','cantidad'=>'count(productoid)']);
        $query->where(['comprobanteid' => $comprobanteid]);
        $query->groupBy(['fecha_vencimiento','productoid','defectuoso','falta']);
        
        $coleccion = array();
        foreach ($dataProvider->getModels() as $value) {
            $cantidad = $value->cantidad;
            $value = $value->toArray();
            $value['cantidad'] = $cantidad;
            $producto = $value['producto'];
            $item = \yii\helpers\ArrayHelper::merge($value, $producto);
            unset($item['comprobanteid']);
            unset($item['id']);
            $coleccion[] = $item;
        }
        
        $data['cantidad_productos']=$dataProvider->totalCount;
        $data['lista_producto']=$coleccion;
        
        return $data;
    }
}