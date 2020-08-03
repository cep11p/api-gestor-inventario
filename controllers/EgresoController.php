<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

use Yii;
use yii\base\Exception;

use app\models\Egreso;

class EgresoController extends ActiveController{
    
    public $modelClass = 'app\models\Egreso';
    
    public function behaviors()
    {

        $behaviors = parent::behaviors();     

        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className()
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        $behaviors['authenticator'] = $auth;

//        $behaviors['authenticator'] = [
//            'class' => \yii\filters\auth\HttpBearerAuth::className(),
//        ];

        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];     

//        $behaviors['access'] = [
//            'class' => \yii\filters\AccessControl::className(),
//            'only' => [],
//            'rules' => []
//        ];



        return $behaviors;
    }
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
//        unset($actions['update']);
        unset($actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    
    public function prepareDataProvider() 
    {
        $searchModel = new \app\models\EgresoSearch();
        $params = \Yii::$app->request->queryParams;
        $resultado = $searchModel->search($params);

        return $resultado;
    }  
    
    public function actionView($id) {
        $model = Egreso::findOne(['id'=>$id]);
        $resultado = array();
        
        if($model==null){
            throw new Exception(json_encode('El egreso no existe'));
        }
        
        $resultado = $model->toArray();
        $resultado['destino_localidad'] = $model->getLocalidad();
        $resultado['lista_producto'] = $model->getListaProducto();
        
        return $resultado;
    }
    
    public function actionCreate() {
        $param = Yii::$app->request->post();
        $model = new Egreso();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            
            $model->setAttributesCustom($param);
            
            if(!$model->save()){
                throw new Exception(json_encode($model->errors));
            }
            
            $model->setListaProducto($param);

            $transaction->commit();
            
            $resultado['message']='Se registra un egreso';
            $resultado['id']=$model->id;
            
            return  $resultado;
           
        }catch (Exception $exc) {
            $transaction->rollBack();
            $mensaje =$exc->getMessage();
            throw new \yii\web\HttpException(400, $mensaje);
        }
    }
}