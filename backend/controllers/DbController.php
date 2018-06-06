<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class DbController extends Controller
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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionGenerar()
    {
        if(Yii::$app->request->post()) {

            $servername = "localhost";
            $username = "root";
            $password = "";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password);
            // Check connection
            if (!$conn) {
                Yii::$app->session->setFlash('error', 'La conexión a la BD fallo. Error: '.mysqli_connect_error()); 
            }else {
                //FILE SQL
                $file = dirname(__FILE__).'\\'.'mercadeo.sql';
                ini_set('max_execution_time', 300);
                // Create database
                $sql = "CREATE DATABASE `mercadeo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
                if (mysqli_query($conn, $sql)) {
                    Yii::$app->session->setFlash('info', 'La BD mercadeo se creó correctamente.'); 
                    mysqli_select_db($conn, "mercadeo");
                    if (!file_exists($file)) {
                        Yii::$app->session->setFlash('error', 'El archivo '. $file. ' no existe.'); 
                    }else {
                        $querys = explode(";", file_get_contents($file));
                        foreach ($querys as $q) {
                            $q = trim($q);
                            if (strlen($q)) {
                                mysqli_query($conn,$q) or die(mysqli_error($conn));
                            }      
                        }
                        Yii::$app->session->setFlash('success', 'Se creó correctamente la Base de Datos mercadeo y todas su tablas.'); 
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Se genero un error al intentar crear la BD. Error: '.mysqli_error($conn)); 
                }
                //Close connection
                mysqli_close($conn);
            }

        }

        return $this->render('generar');
    }
}
