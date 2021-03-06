<?php
namespace backend\controllers;

use common\components\AppleRepository;
use common\models\Apple;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
//                        'actions' => ['logout'],
                        'actions' => ['logout', 'index', 'generate', 'fall', 'eat', 'throw'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /** @var AppleRepository $appleRepository */
        $appleRepository = Yii::$app->appleRepository;

        $apples = $appleRepository->getAll();

        return $this->render('index', [
            'apples' => $apples
        ]);
    }

    public function actionGenerate(int $count)
    {
        Yii::$app->appleRepository->generateRandom($count);
        return $this->redirect(['index']);
    }

    public function actionEat(int $count, int $id)
    {
        Yii::$app->appleRepository->getById($id)->eat($count);

        return $this->redirect(['index']);
    }

    public function actionFall(int $id)
    {
        Yii::$app->appleRepository->getById($id)->fall();

        return $this->redirect(['index']);
    }

    public function actionThrow(int $id)
    {
        Yii::$app->appleRepository->getById($id)->throw();

        return $this->redirect(['index']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
