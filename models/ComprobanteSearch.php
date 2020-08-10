<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comprobante;

/**
* ComprobanteSearch represents the model behind the search form about `app\models\Comprobante`.
*/
class ComprobanteSearch extends Comprobante
{
    public $global_param;

    /**
    * @inheritdoc
    */
    public function rules()
    {
    return [
            [['id', 'proveedorid'], 'integer'],
            [['nro_remito', 'fecha_inicial', 'fecha_emision', 'descripcion','global_param'], 'safe'],
            [['total'], 'number'],
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
        $query = Comprobante::find();

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

        $query->andFilterWhere(['like', 'nro_remito', $this->global_param])
            ->orFilterWhere(['like', 'descripcion', $this->global_param]);
        
        #### Filtro por rango de fecha ####
        if(isset($params['fecha_desde']) && isset($params['fecha_hasta'])){
            $query->andWhere(['between', 'fecha_emision', $params['fecha_desde'], $params['fecha_hasta']]);
        }else if(isset($params['fecha_desde'])){
            $query->andWhere(['between', 'fecha_emision', $params['fecha_desde'], date('Y-m-d')]);
        }else if(isset($params['fecha_hasta'])){
            $query->andWhere(['between', 'fecha_emision', '1970-01-01', $params['fecha_hasta']]);
        }

        $coleccion = array();
        foreach ($dataProvider->getModels() as $value) {
            $item = $value->toArray();
            $coleccion[] = $item;
        }

        $paginas = ceil($dataProvider->totalCount/$pagesize);           
        $data['pagesize']=$pagesize;            
        $data['pages']=$paginas;            
        $data['total_filtrado']=$dataProvider->totalCount;
        $data['resultado']=$coleccion;
        
        return $data;
    }
}