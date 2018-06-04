<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nombre;
    public $apellido;
    public $cedula;
    public $direccion;
    public $telefono;
    public $municipio_id;
    public $tipo_usuario_id;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya fue utilizado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Esta dirección de correo ya esta registrada.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['nombre', 'required'],
            ['nombre', 'string', 'min' => 2, 'max' => 255],

            ['apellido', 'required'],
            ['apellido', 'string', 'min' => 2, 'max' => 255],

            ['cedula', 'required'],
            ['cedula', 'string', 'min' => 2, 'max' => 10],

            ['direccion', 'string', 'min' => 8, 'max' => 255],

            ['telefono', 'string', 'min' => 7, 'max' => 100],

            ['municipio_id', 'integer'],

            ['tipo_usuario_id', 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->nombre = $this->nombre;
        $user->apellido = $this->apellido;
        $user->cedula = $this->cedula;
        $user->direccion = $this->direccion;
        $user->telefono = $this->telefono;
        $user->municipio_id = $this->municipio_id;
        $user->tipo_usuario_id = $this->tipo_usuario_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = time();
        $user->updated_at = time();
        
        return $user->save() ? $user : null;
    }

    public function sendEmail($emailTo)
    {
        return Yii::$app->mailer->compose()
            ->setTo($emailTo)
            ->setFrom(['mercadeo@itm.com' => 'Alertas Mercadeo'])
            ->setSubject('Bienvenido')
            ->setTextBody('Este es el correo de bienvenida.')
            ->send();
    }
}
