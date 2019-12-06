<?php
App::uses('AppController','Controller');
App::uses('Sanitize','Utility');
/**
 * /app/Controllers/SampleController.php
 */
class SampleController extends AppController {
    //CakePHPではindexがデフォルトのアクションに設定されており、アクション名が省略されると自動的にindexアクションにアクセスしたものとみなされる
    public function index() {
        //自動レイアウト機能をOFFにします。
        // $this -> autoLayout = false;
        $this->set("title_for_layout","Index Page");
        $this->set("msg","hello!");
        $this->set("datas",array("One","Two"));

        $this->modelClass = null;


        $this->layout = "Sample";   //LayoutフォルダのSample.ctlを使用します。
        $this->set("header_for_layout","Sample Application");
        $this->set("footer_for_layout","copyright by SYODA-Tuyano. 2011.");
        $this->set("msg", "Welcome to my layout!");


        if ($this->request->data){
            $result = "[result]";
            $result .= "<br>text1: " . Sanitize::stripAll($this->request->data['text1']);
            $result .= "<br>check1: " . 
                @$this->request->data['check1'];
            $result .= "<br>radio1: " . 
                @$this->request->data['radio1'];
            $result .= "<br>select1: " . 
                @$this->request->data['select1'];
          } else {
            $result = "no data.";
          }
        $this->set("result",$result);
    }

    public function form() {
        $text1 = $this -> data["text1"];
        $check1 = isset($this -> data["check1"]) ? "On" : "Off";
        //三項演算子。data["check1"]が存在する、がTrueならば「ON」Falseならば「Off」
        $radio1 = $this -> data["radio1"];
        $this -> set("text1", Sanitize::stripAll($text1));
        $this -> set("check1", $check1);
        $this -> set("radio1", $radio1);
    }
    public function index2() {
        $this -> autoRender = false;
        //$thisはこのクラスのインスタンス。
        //それのautoRenderプロパティをfalseにします。
        //効果はビューによる画面表示をOFFにする。
        //＝勝手にHTMLを生成しないようにする。

        // $this ->redirect("./other");
        //上の書き方だと/sample/otherと表示され、明らかに飛ばされたことがユーザーにバレるが、下の書き方だとURLは変化しないためユーザーはかも知れない。
        // $this -> setAction("other");
        // $this -> setAction("other2");
        //上記のように複数を重ねることで一ページに複数アクションを表示できる。

        $date = new DateTime();
        //Datetimeインスタンスを。
        $date -> setTimezone(new DateTimeZone('Asia/Tokyo'));
        //DateTimeZoneとしてAsia/Tokyoを取得して$dateに設定する。
        $str = $date->format("H&#58;i&#58;s");
        // $str = $date->format("A&#58;g&#58;i&#58;s");
        //$strに$dateからH:i:s(24時間単位:先頭に0を付けた分:先頭に0を付けた秒)の形式で
        $this ->redirect("./other/".urlencode($str));
        //SampleControllerのotherメソッドにURLエンコードした$strを付けてリダイレクト
        //Actionとはメソッドのこと
    }

    public function other($param) {
        //アクションでは、アドレスの後に/で受け渡したい値を記述すれば、それがそのままアクションメソッドの引数に渡されるようになっています。
        $this -> autoRender = false;
        $str = urldecode($param);
        //URLエンコードされた文字列をデコードする。
        echo "<html><head></head><body>";
        echo "<h1>サンプルページ</h1>";
        echo "<p>これはもう１つのページです。</p>";
        echo "<p>送られた値: " . $str . "</p>";
        print "<form action='http://localhost/mori_folder/Answer-of-mori/cake/sample/index2' method='GET'>
        <input type='submit' value='ページ更新'>
        </form>";
        echo "</body></html>";
    }

    public function other2() {
        // $this ->autoRender = true;
        print "<html><head></head><body>";
        print "<h1>other2です。</h1>";
        print "<pre>
        public function other2() {
            <h2>        (省略)</h2>
        }
        </pre>";
        print "</body></html>";
    }

}
