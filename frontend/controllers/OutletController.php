<?php

namespace frontend\controllers;

use Yii;
use app\models\Outlet;
use app\models\OutletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OutletController implements the CRUD actions for Outlet model.
 */
class OutletController extends Controller
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
     * Lists all Outlet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user_type = Yii::$app->user->identity->tipo_usuario_id;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user_type' => $user_type,
        ]);
    }

    /**
     * Displays a single Outlet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user_type = Yii::$app->user->identity->tipo_usuario_id;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'user_type' => $user_type
        ]);
    }

    /**
     * Creates a new Outlet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Outlet();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_at = date('Y-m-d h:i:s');
            $model->update_at = date('Y-m-d h:i:s');
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_outlet]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Outlet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_outlet]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Outlet model.
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
     * Finds the Outlet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Outlet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Outlet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
