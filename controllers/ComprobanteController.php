<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

use Yii;
use yii\base\Exception;

use app\models\Comprobante;

class ComprobanteController extends ActiveController{
    
    public $modelClass = 'app\models\Comprobante';
    
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
        unset($actions['view']);
        unset($actions['update']);
//        unset($actions['delete']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    
    public function prepareDataProvider() 
    {
        $searchModel = new \app\models\ComprobanteSearch();
        $params = \Yii::$app->request->queryParams;
        $resultado = $searchModel->search($params);

        return $resultado;
    }  
    
    public function actionView($id) {
        $model = Comprobante::findOne(['id'=>$id]);
        $resultado = array();
        
        if($model==null){
            throw new Exception(json_encode('El comprobante no existe'));
        }
        
        $resultado = $model->toArray();
        $resultado['lista_producto'] = $model->getListaProducto();
        
        return $resultado;
    }
    
    public function actionProductoFalta($id) {
        $param = \Yii::$app->request->post();
        $model = Comprobante::findOne(['id'=>$id]);

        if($model==null){
            throw new Exception(json_encode('El comprobante no existe'));
        }        
        
        $transaction = Yii::$app->db->beginTransaction();
        try {            
            $model->updateToProductoFalta($param);

            $transaction->commit();
            
            $resultado['message']='Se modifica el comprobante';
            $resultado['comprobanteid']=$model->id;
            
            return  $resultado;
           
        }catch (Exception $exc) {
            $transaction->rollBack();
            $mensaje =$exc->getMessage();
            throw new \yii\web\HttpException(400, $mensaje);
        }
        
        return $resultado;
    }
    
        
}