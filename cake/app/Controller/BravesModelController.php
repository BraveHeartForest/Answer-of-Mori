<?php
/**
 * /app/Controllers/HelloController.php
 */
class BravesModelController extends AppController {
    // public $autoRender = false;
    //Viewファイルの読み込みと自動レンダリングを無効にする。

    public function index() {
        $datas = $this->BravesModel->find('all');
        $this->set('datas'<$datas);
    }
}
