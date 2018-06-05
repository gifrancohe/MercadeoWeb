<?php

namespace frontend\controllers;

use Yii;
use app\models\Encuesta;
use app\models\EncuestaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\EncuestaUsuario;

/**
 * EncuestaController implements the CRUD actions for Encuesta model.
 */
class EncuestaController extends Controller
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
     * Lists all Encuesta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EncuestaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Encuesta model.
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
     * Creates a new Encuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Encuesta();

        if ($model->load(Yii::$app->request->post())) {
            $model->estado = 1;
            $model->create_at = date('Y-m-d h:i:s');
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_encuesta]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Encuesta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_encuesta]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Encuesta model.
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
     * Finds the Encuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Encuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEncuesta() {
        $model = Encuesta::find()->where(['estado' => 1])->all();
        $encuesta_usuario = EncuestaUsuario::find()->where(['usuario_id' => Yii::$app->user->id])->all();
        if(!empty($encuesta_usuario)) {
            Yii::$app->session->setFlash('error', 'Usted ya ha diligenciado la encuesta, no debe hacerlo nuevamente.'); 
            $encuesta_respuestas = true;
        }else {
            $encuesta_respuestas = false;
        }
        if (Yii::$app->request->post()) {
            $respuestas = Yii::$app->request->post();
            $usuario_id = Yii::$app->user->id;
            $registros = array();
            $error = false;
            foreach($respuestas['Encuesta'] as $key => $respuesta) {
                if(!empty($respuesta)) {
                    $encuesta_usuario = new EncuestaUsuario;
                    if($key == 2 || $key == 5) {
                        $encuesta_usuario->respuesta = json_encode($respuesta);
                    }else {
                        $encuesta_usuario->respuesta = $respuesta;
                    }
                    $encuesta_usuario->usuario_id = $usuario_id;
                    $encuesta_usuario->create_at = date('Y-m-d h:i:s');
                    $encuesta_usuario->encuesta_id = $key;
                    $registros[] = $encuesta_usuario;
                }else {
                    $error = true;
                    Yii::$app->session->setFlash('error', 'La pregunta #'.($key+1)," falta por responser."); 
                    break;
                }
            }
            if(!$error) {
                foreach($registros as $insert) {
                    $insert->save();
                }
                Yii::$app->session->setFlash('success', 'Gracias por diligenciar la encuesta, al correo se le enviará un bono de descueto para su proxima compra de nuestros productos.'); 
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('encuesta', [
            'model' => $model,
            'encuesta_respuestas' => $encuesta_respuestas,
        ]);
    }
}
