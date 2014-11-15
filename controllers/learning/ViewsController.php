<?php

namespace app\controllers\learning;

class ViewsController
    extends \yii\web\Controller
{
    public $message;
    public function init()
    {
        parent::init();
        $this->defaultAction = "view-tutorial";
        $this->message = "Controller message.";
    }

    public function actionViewTutorial()
    {
        // именнованный вид - обыкновенный с выводом шаблона (layout)
        return $this->render("view_tutorial");
        
        // именновынный вид, производит рендеринг, но без layout-а 
        return $this->renderPartial($view); // 
        
        // рендерит именнованный вид, без шаблона, добавляет вложенный 
        // css и javascript. Применяется для обработки запросов AJAX-а
        return $this->renderAjax($view);
        
        // рендеринг вида заданного как путь к файлу.
        return $this->renderFile($file);
    }
}