<?php

namespace frontend\controllers;

use Yii;
use app\models\Venta;
use app\models\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Tendero;
use app\models\Precio;
use app\models\Presentacion;
use app\models\Producto;
use app\models\Pedido;
use yii\db\Query;



/**
 * VentaController implements the CRUD actions for Venta model.
 */
class VentaController extends Controller
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
     * Lists all Venta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venta model.
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
     * Creates a new Venta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Venta();
        $tenderos = ArrayHelper::map(Tendero::find()->All(), 'id_tendero', 'nombre');
        $productos = ArrayHelper::map(Producto::find()->All(), 'id_producto', 'nombre');
        $precios = ArrayHelper::map(Precio::find()->All(), 'id_precio', 'precio');
        $presentaciones = ArrayHelper::map(Presentacion::find()->All(), 'id_presentacion', 'descripcion');

        if ($model->load(Yii::$app->request->post())) {
            $tendero = Tendero::find()->where(['user_id' => \Yii::$app->user->id])->one();
            $mensaje = "El producto ". $model->producto->nombre. " esta por debajo del 10% de la cantidad del total de sus pedidos, recuerde realizar un nuevo pedido para dicho producto.";
                            $this->sendEmail($tendero->user->email, 'giovannyfrancohe@mattelsa.net', 'Producto menor al 10%', $mensaje);
            if(!empty($tendero)) {
                
                $pedidos = Pedido::find()->where([
                    'tendero_id' => $tendero->id_tendero, 
                    'producto_id' => $model->producto_id,
                    'presentacion_id' => $model->presentacion_id,
                    'precio_id' => $model->precio_id
                ])->All();
                $ventas = Venta::find()->where([
                    'tendero_id' => $tendero->id_tendero,
                    'producto_id' => $model->producto_id,
                    'presentacion_id' => $model->presentacion_id,
                    'precio_id' => $model->precio_id
                ])->All();
                if(!empty($pedidos)) {
                    $validar_existencia = $this->productoAgotado($pedidos, $ventas, $model->cantidad); 
                    switch ($validar_existencia) {
                        case 0:
                            Yii::$app->getSession()->setFlash('error', 'No tiene este prodcuto en existencia.');
                            break;
                        case 1:
                            Yii::$app->getSession()->setFlash('error', 'No tiene producto en Strock para registrar esta venta.');
                            break;
                        case 2:
                            $mensaje = "El producto $model->producto->nombre esta por debajo del 10% de la cantidad del total de sus pedidos, recuerde realizar un nuevo pedido para dicho producto.";
                            $this->sendEmail($tendero->user->email, 'mercadeo.item@notificaciones.com', 'Producto menor al 10%', $mensaje);
                            Yii::$app->getSession()->setFlash('info', "El producto  $model->producto->nombre de esta venta, esta por debajo del 10% en existencia, recuerde generar un nuevo pedido.");
                            break;
                    }
                    if($validar_existencia === 3) {
                        $model->tendero_id = $tendero->id_tendero;
                        if($model->save()) {
                            return $this->redirect(['view', 'id' => $model->id_venta]);
                        }
                    }   
                }else {
                    Yii::$app->getSession()->setFlash('error', 'Aún no tiene este producto en existencias.');
                }
            }
        }

        return $this->render('create', [
           'model' => $model,
           'tenderos' => $tenderos,
           'productos' => $productos,
           'precios' => $precios,
           'presentaciones' => $presentaciones,
        ]);
    }

    /**
     * Updates an existing Venta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_venta]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Venta model.
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
     * Finds the Venta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Venta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function productoAgotado($pedidos, $ventas, $venta_actual) {
        $total_pedidos = 0;
        $total_ventas = 0;
        
        foreach($pedidos as $pedido) {
            $total_pedidos += $pedido->cantidad;
        }
        foreach($ventas as $venta) {
            $total_ventas += $venta->cantidad;
        }

        if($total_ventas > $total_pedidos) {
            return 0;
        }

        $total_ventas += $venta_actual;

        if($total_ventas > $total_pedidos) {
            return 1;
        }else {
            $existencia = $total_pedidos - $total_ventas;
            $porcentaje = ($existencia * 100)/$total_pedidos;
            if($porcentaje <= 10) {
                return 2;
            }
            return 3;
        }
    }


    public function actionEstadistica() {
        $model = new Venta;
        $connection = \Yii::$app->db;

        $data = array();

        if ($model->load(Yii::$app->request->post())) {
            $datos = Yii::$app->request->post();
            $fecha_inicio = $datos['Venta']['fecha_inicio'].' 00:00:00';
            $fecha_fin = $datos['Venta']['fecha_fin'].' 23:59:59';

            $ventas = Venta::find()
            ->where(['between', 'fecha_venta', $fecha_inicio, $fecha_fin ])->all();

            $data['ventas'] = $ventas;

            $sql = $connection->createCommand("SELECT venta.producto_id, SUM(venta.cantidad) as total FROM venta 
            WHERE venta.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            GROUP BY venta.producto_id ORDER BY SUM(venta.cantidad) DESC LIMIT 1");
            $mayor_venta = $sql->queryOne();
            $producto_mas_vendido = $mayor_venta['producto_id'];
            $total_mas_ventas = $mayor_venta['total'];
            if(!empty($producto_mas_vendido)) {
                $data['producto_mas_vendido'] = Producto::findOne($producto_mas_vendido);
                $data['total_prod_mas_ventas'] = $total_mas_ventas;
            }

            $sql = $connection->createCommand("
            SELECT venta.producto_id, SUM(venta.cantidad) as total 
            FROM venta 
            WHERE venta.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            GROUP BY venta.producto_id LIMIT 1");
            $menor_venta = $sql->queryOne();
            $producto_menos_vendido = $menor_venta['producto_id'];
            $total_menos_venta = $menor_venta['total'];
            if(!empty($producto_menos_vendido)) {
                $data['producto_menos_vendido'] = Producto::findOne($producto_menos_vendido);
                $data['total_prod_menos_ventas'] = $total_menos_venta;
            }

            $sql = $connection->createCommand("
            SELECT 
                venta.presentacion_id, 
                COUNT(venta.presentacion_id) as total 
            FROM venta 
            WHERE venta.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            GROUP BY venta.presentacion_id 
            ORDER BY venta.presentacion_id DESC
            LIMIT 1");
            $presentacion = $sql->queryOne();
            $presentacion_mas_id = $presentacion['presentacion_id'];
            $presentacion_mas_total = $presentacion['total'];
            if(!empty($presentacion_mas_id)) {
                $data['presentacion_mas_id'] = Presentacion::findOne($presentacion_mas_id);
                $data['presentacion_mas_total'] = $presentacion_mas_total;
            }

            $sql = $connection->createCommand("
            SELECT 
                venta.presentacion_id, 
                COUNT(venta.presentacion_id) as total 
            FROM venta 
            WHERE venta.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            GROUP BY venta.presentacion_id 
            LIMIT 1");
            $presentacion = $sql->queryOne();
            $presentacion_menos_id = $presentacion['presentacion_id'];
            $presentacion_menos_total = $presentacion['total'];
            if(!empty($presentacion_menos_id)) {
                $data['presentacion_menos_id'] = Presentacion::findOne($presentacion_menos_id);
                $data['presentacion_menos_total'] = $presentacion_menos_total;
            }

            $sql = $connection->createCommand("
            SELECT 
                venta.tendero_id, 
                COUNT(venta.tendero_id) as total 
            FROM venta 
            WHERE venta.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            GROUP BY venta.tendero_id
            ORDER BY venta.tendero_id DESC 
            LIMIT 1");
            $tendero = $sql->queryOne();
            $tendero_mas_id = $tendero['tendero_id'];
            $tendero_mas_total = $tendero['total'];
            if(!empty($tendero_mas_id)) {
                $tendero_mas_id = Tendero::findOne($tendero_mas_id);
                $data['punto_venta_mas'] = $tendero_mas_id->puntoVenta;
            }


            $sql = $connection->createCommand("
            SELECT 
                venta.tendero_id, 
                COUNT(venta.tendero_id) as total 
            FROM venta 
            WHERE venta.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            GROUP BY venta.tendero_id
            LIMIT 1");
            $tendero = $sql->queryOne();
            $tendero_menos_id = $tendero['tendero_id'];
            $tendero_menos_total = $tendero['total'];
            if(!empty($tendero_menos_id)) {
                $tendero_menos_id = Tendero::findOne($tendero_menos_id);
                $data['punto_venta_menos'] = $tendero_menos_id->puntoVenta;
            }


            $total_cantidad = 0;
            $total_precio = 0;
            foreach($ventas as $venta) {
                $total_cantidad += $venta->cantidad;
                $total_precio += $venta->cantidad * $venta->precio->precio; 
            }
            $data['total_cantidad_ventas'] = $total_cantidad;
            $data['total_precio_ventas'] = $total_precio;

        }

        return $this->render('estadisticas', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    
}
