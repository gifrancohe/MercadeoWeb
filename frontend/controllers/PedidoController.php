<?php

namespace frontend\controllers;

use Yii;
use app\models\Pedido;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Producto;
use yii\helpers\ArrayHelper;
use app\models\Precio;
use app\models\Presentacion;
use app\models\Tendero;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pedido();
        $productos = ArrayHelper::map(Producto::find()->where(['estado' => 1])->all(), 'id_producto', 'nombre');
        $precios = ArrayHelper::map(Precio::find()->All(), 'id_precio', 'precio');
        $presentaciones = ArrayHelper::map(Presentacion::find()->All(), 'id_presentacion', 'descripcion');

        if ($model->load(Yii::$app->request->post()) ) {
            $tendero = Tendero::find()->where(['user_id' => \Yii::$app->user->id])->one();
            if(!empty($tendero)) {
                $model->tendero_id = $tendero->id_tendero;
                $model->fecha_pedido = date('Y-m-d h:i:s');
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id_pedido]);
                }
            }    
        }

        return $this->render('create', [
            'model' => $model,
            'productos' => $productos,
            'precios' => $precios,
            'presentaciones' => $presentaciones, 
        ]);
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $productos = ArrayHelper::map(Producto::find()->where(['estado' => 1])->all(), 'id_producto', 'nombre');
        $precios = ArrayHelper::map(Precio::find()->All(), 'id_precio', 'precio');
        $presentaciones = ArrayHelper::map(Presentacion::find()->All(), 'id_presentacion', 'descripcion');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pedido]);
        }

        return $this->render('update', [
            'model' => $model,
            'productos' => $productos,
            'precios' => $precios,
            'presentaciones' => $presentaciones,
        ]);
    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
