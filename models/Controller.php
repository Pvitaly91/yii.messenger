<?

namespace app\models;
use yii;
/**
 * base controller trait, for using in other controllers
 */
trait Controller {

    public function setPage404() {
        Yii::$app->response->statusCode = 404;
        throw new \yii\web\NotFoundHttpException(Yii::t("app","Page not found."), 404);
    }

}
