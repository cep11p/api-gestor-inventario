<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Egreso;

/**
* EgresoSearch represents the model behind the search form about `app\models\Egreso`.
*/
class EgresoSearch extends Egreso
{
    public $global_param;
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'destino_localidadid'], 'integer'],
            [['fecha', 'origen', 'destino_nombre', 'descripcion', 'nro_acta','global_param'], 'safe'],
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
        $query = Egreso::find();
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
            'id' => $this->id,
            'fecha' => $this->fecha,
            'destino_localidadid' => $this->destino_localidadid,
        ]);

        $query->andFilterWhere(['like', 'origen', $this->global_param])
            ->orFilterWhere(['like', 'destino_nombre', $this->global_param])
            ->orFilterWhere(['like', 'descripcion', $this->global_param])
            ->orFilterWhere(['like', 'nro_acta', $this->global_param]);
        
   
        
        $coleccion = array();
        foreach ($dataProvider->getModels() as $value) {
            $item = $value->toArray();
            $coleccion[] = $item;
        }
        /********Vinculamos datos remotos********/
        $coleccion = Egreso::vincularLocalidad($coleccion,$this->obtenerLocalidadIdDeColeccion());
        
        $paginas = ceil($dataProvider->totalCount/$pagesize);           
        $data['pagesize']=$pagesize;            
        $data['pages']=$paginas;            
        $data['total_filtrado']=$dataProvider->totalCount;
        $data['resultado']=$coleccion;
        
        return $data;
    }
    
    /**
     * Se obtienen los id de localidades que están vinculadas a la coleccion
     * @param array $coleccion
     * @return array
     */
    private function obtenerLocalidadIdDeColeccion($coleccion = array()) {
        $ids='';
        $pagesize = count($coleccion); 
        $resultado = array();
        foreach ($coleccion as $valor) {
            #si esta seteada la localidad
            if(isset($valor['localidadid'])){
                $ids .= (empty($ids))?$valor['localidadid']:','.$valor['localidadid'];
            }
            
        }
        
        $response = \Yii::$app->lugar->buscarLocalidad(array("ids"=>$ids,"pagesize"=>$pagesize));
        
        if(isset($response['success']) && $response['success']==true){
            $resultado = $response['resultado'];
        }
        
        return $resultado;
    }
}