<?

namespace app\models;

use yii\base\Model;

class Signup extends Model {

    public $email;
    public $password;
    public $username;
    public $password_repeat;

    private $rules ="default"; //for signup form
    
    public function setRulesName($name) {
        $this->rules = $name;
        return $this;
    }
    /**
     * field validation
     * @return type
     */
    public function rules( ) {
        // default or signup form rules 
        $rules["default"] = [
            [['email', 'password', 'username', 'password_repeat'], 'required'],
            ['email', 'email'],
            [['email', 'username'], 'unique', 'targetClass' => 'app\models\User'],
            ['username', 'string', 'min' => 3, 'max' => 24],
            [['password', 'password_repeat'], 'string', 'min' => 2, 'max' => 10],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
        //  rules for change password form 
        $rules["change_pass"] = [
            [['password','password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 2, 'max' => 10],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
     //  d($this);
        return $rules[$this->rules];
    }

    public function signup() {
        $user = new User();
        $user->email = $this->email;
        $user->password = $user->setPassword($this->password);
        $user->username = $this->username;
        return $user->save();
    }

    public function ChangePass($id) {

        $user = User::find()->select(["id", "password"])->where(["id" => $id])->all();
        if (isset($user[0]))
            $user = $user[0];
        else
            return false;
        $user->password = $user->setPassword($this->password);
        return $user->update();
    }

}
