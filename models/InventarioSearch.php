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
            [['fecha_vencimiento'], 'safe'],
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

        $coleccion = array();
        foreach ($dataProvider->getModels() as $value) {
            $coleccion[] = $value->toArray();
        }
        
        $paginas = ceil($dataProvider->totalCount/$pagesize);           
        $data['pagesize']=$pagesize;            
        $data['pages']=$paginas;            
        $data['total_filtrado']=$dataProvider->totalCount;
        $data['resultado']=$coleccion;
        
        return $data;
    }
}