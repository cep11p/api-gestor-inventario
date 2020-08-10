<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
* ProductoSearch represents the model behind the search form about `app\models\Producto`.
*/
class ProductoSearch extends Producto
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'unidad_medidaid', 'marcaid', 'categoriaid','activo'], 'integer'],
            [['nombre', 'codigo', 'unidad_valor'], 'safe'],
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
        $query = Producto::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'nombre' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params,'');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'unidad_medidaid' => $this->unidad_medidaid,
            'marcaid' => $this->marcaid,
            'categoriaid' => $this->categoriaid,
            'activo' => 1,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'unidad_valor', $this->unidad_valor]);

        $coleccion = array();
        foreach ($dataProvider->getModels() as $value) {
            $coleccion[] = $value->toArray();
        }
        
        $data=$coleccion;

        return $data;
    }
}