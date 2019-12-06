<?php
/**
 * /app/Controllers/HelloController.php
 */
class HelloController extends AppController {
    // public $autoRender = false;
    //Viewファイルの読み込みと自動レンダリングを無効にする。
    
    //使用するモデルを指定する
    //省略時はControllerと同名になるようです。
    public $uses = array('Posts','Comments','Terms'); 
    // public $uses = array('Posts'); 

    
    //自動レンダリング無効
    public $autoLayout = false; 


    //標準機能を利用する
    public $scaffold;    //これを宣言するだけでOK

    public function index() {
        // echo "Hello World!";
        //http://localhost/mori_folder/Answer-of-mori/cake/hello にアクセスすると表示されます。
        //HelloControllerの前半部分"hello"でどのコントローラを使うかを判別します。
        $this->render('other'); //other.ctpを表示
    }

    public function other() {
        // echo "Other!";

        //http://localhost/mori_folder/Answer-of-mori/cake/hello/other
        //上のecho部分のコメントアウトを外さずともother.ctpの内容が表示される。
    }

    public function redi() {
        //WebCakeにリダイレクト
        $this->redirect('https://webcake.stars.ne.jp/');
    }

    public function enter() {
        $this->render('enter');
    }

    public function export() {
        //リクエストがPOSTメソッドで送られてきた場合
        //is('post')=isPOST()
        // if($this->request->is('post')) {
        if($this->request->isPOST()) {
            //formのパラメータ取得
            $post = $this->request->data('txt');

            //リクエストパラメータが空じゃない場合
            if($post !=='') {
                $this->Session->setFlash("送信完了");
            }

            //Viewへの値のセット
            // $this->set('post',$post);

            //enterアクションにリダイレクト
            $this->redirect('/hello/enter');
            //$this->Session->setFlash()でセットしたメッセージを表示する記述をViewに書いてないのに表示されるのは自動レンタリングが関係しています。
            // 「/lib/Cake/View/default.ctp」を見てみると
            // <?php echo $this->Session->flash(); ? >
            // という記述があるのが分かります。
            // これがセットした値を表示する記述です:)
        }
        // $this->render('export');
    }

    public function posts() {
        //全件取得
        // $data = $this->Posts->find("all");

        //キーワード
        $value = "Cake";

        //絞り込み条件
        $conditions = [
            'conditions' => [
                'Posts.title LIKE' => '%'.$value.'%',
            ],
        ];

        //条件に一致するものを全件取得
        $data = $this->Posts->find('all',$conditions);

        //デバッグ表示
        debug($data);
    }

    public function terms() {
        //全件取得
        $data = $this->Posts->find("all");
    }

}
