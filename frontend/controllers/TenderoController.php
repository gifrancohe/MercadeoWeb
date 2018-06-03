<?php

namespace frontend\controllers;

use Yii;
use app\models\Tendero;
use app\models\TenderoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Municipio;
use yii\helpers\ArrayHelper;
use app\models\PuntoVenta;
use common\models\User;

/**
 * TenderoController implements the CRUD actions for Tendero model.
 */
class TenderoController extends Controller
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
     * Lists all Tendero models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TenderoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tendero model.
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
     * Creates a new Tendero model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tendero();
        $municipios =  ArrayHelper::map(Municipio::find()->all(), 'id_municipio', 'municipio');
        $puntos = ArrayHelper::map(PuntoVenta::find()->all(), 'id_punto_venta', 'nombre');
        $usuarios = ArrayHelper::map(User::find()->all(), 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_tendero]);
        }

        return $this->render('create', [
            'model' => $model,
            'municipios' => $municipios,
            'puntos' => $puntos,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Updates an existing Tendero model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $municipios =  ArrayHelper::map(Municipio::find()->all(), 'id_municipio', 'municipio');
        $puntos = ArrayHelper::map(PuntoVenta::find()->all(), 'id_punto_venta', 'nombre');
        $usuarios = ArrayHelper::map(User::find()->all(), 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_tendero]);
        }

        return $this->render('update', [
            'model' => $model,
            'municipios' => $municipios,
            'puntos' => $puntos,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Deletes an existing Tendero model.
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
     * Finds the Tendero model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tendero the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tendero::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
