<?php

/*
 * 3d10-simple-blackjack-dealer.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* First, we have the suits */

$suits = array (
    "Spades", "Hearts", "Clubs", "Diamonds"
    // "&#9824;", "&#9825;", "&#9827;", "&#9826;"
);

/* Next, we declare the faces*/

$faces = array (
    "Two"=>2, "Three"=>3, "Four"=>4, "Five"=>5, "Six"=>6, "Seven"=>7, "Eight"=>8,
    "Nine"=>9, "Ten"=>10, "Jack"=>10, "Queen"=>10, "King"=>10, "Ace"=>11
);
//ブラックジャックでの札の点数は上の通り。

function evaluateHand($hand) {
    //この関数自体を作り直すべきです。
    global $faces;
    //globalと付けることで関数外の変数を参照できます。
    $value = 0;
    //点数計算用の変数です。
    foreach ($hand as $card) {
        if ($value > 11 && $card['face'] == 'Ace') {
            //値が11を超えている場合はAceを1として扱う。
            // There's a bug here.  If you draw Ace-Five-Ace-Ten, it thinks you have 27.
            //後から11にしていたものを1に変換できないのが問題。
            //11を超えていたらAceを1として扱うのではなく、21を超えたらAceの枚数分-10する、の方が良いかも
            // Have a go at fixing that bug.  Email me if you have problems. - DPO
            $value = $value + 1;
        } else {
            $value = intval($value) + intval($faces[$card['face']]);
            //intval($var) : int 変数の整数としての値を取得する。
            //手札のカードのフェイスに対応する整数値を$valueに代入。
        }
    }
    return $value;
}

/* Now build the deck by combining the faces and suits. */

$deck = array();

foreach ($suits as $suit) {
    //全てのスートに対して
    $keys = array_keys($faces);
    //$facesのキー全てを配列として返します。
    //$keys : Array("0" => "Two",...,"12"=>"Ace")
    foreach ($keys as $face) {
        //すべてのフェイスを適用。
        $deck[] = array('face'=>$face,'suit'=>$suit);
    }
    /*処理的にはハート＝＞2,3,...,A。次にクラブ=>2,3,...,Aのように進む。*/
}

/* Next, you can shuffle up the deck and pull a random card. */

shuffle($deck);
//デッキをシャッフル

$hand = array();

if (empty($_POST)) {
    //$_POSTが空であるならば、

    for ($i = 0; $i < 2; $i++) {
        //初期手札が2枚にになるようにドロー
        $hand[] = array_shift($deck);
        $dealer[] = array_shift($deck);
    }

    $handstr = serialize($hand);
    // $handstr = base64_encode($handstr);
    //プレイヤーの手札を梱包
    $deckstr= serialize($deck);
    // $deckstr = base64_encode($deckstr);
    //デッキの残りを梱包
    $dealerstr= serialize($dealer);
    // $dealerstr = base64_encode($dealerstr);
    //ディーラーの手札を梱包
} elseif ($_POST['submit'] == '勝負') {
    //$_POSTが空でなく、$_POST['submit']の値が'勝負'であるならば、
    // $dealer = base64_decode($_POST['dealerstr']);
    // $dealer = unserialize($dealer);
    $dealer = unserialize($_POST['dealerstr']);
    //ディーラーの手札を開封
    // $hand = base64_decode($_POST['handstr']);
    // $hand = unserialize($hand);
    $hand = unserialize($_POST['handstr']);
    //プレイヤーの手札を開封
    // $deck = base64_decode($_POST['deckstr']);
    // $deck = unserialize($deck);
    $deck = unserialize($_POST['deckstr']);
    //デッキの残りを開封
    while(evaluateHand($dealer) < 17) {
        //ディーラーの点数が17を超えるまで、ディーラーはデッキからカードを引く
        $dealer[] = array_shift($deck);
    }
    echo "<h4>ディーラーの点数は" . evaluateHand($dealer) . "</h4>\n";
    echo "<h4>貴方の点数は" . evaluateHand($hand) . "</h4>\n";
    if(evaluateHand($dealer)>21 && evaluateHand($hand)>21) {
        print"<h5>両者バーストのため引き分けです。</h5>";
    }else{
        if(evaluateHand($dealer)>21) {
            print "<h5>ディーラーはバーストしました。</h5><h5>貴方の勝利です。</h5>";
        }elseif(evaluateHand($hand)<=21) {
            if(evaluateHand($dealer)>evaluateHand($hand)) {
                print "<h5>ディーラーの勝利です。</h5>";
            }elseif(evaluateHand($dealer)==evaluateHand($hand)) {
                print"<h5>両者同一の点数なので引き分けです。</h5>";
            }
        }
        if(evaluateHand($hand)>21) {
            print "<h5>貴方はバーストしました。</h5><h5>ディーラーの勝利です。</h5>";
        }elseif(evaluateHand($dealer)<=21) {
            if(evaluateHand($dealer)<evaluateHand($hand)) {
                print "<h5>貴方の勝利です。</h5>";
            }
        }
    }
    $handstr = $_POST['handstr'];
    //ディーラーはもう既に引き終わっているので梱包の必要がありません。
    $dealerstr = serialize($dealer);
    // $dealerstr = base64_encode($dealerstr);
    //梱包
    $deckstr= serialize($deck);
    // $deckstr = base64_encode($deckstr);
    //梱包
} elseif ($_POST['submit'] == '追加ドロー') {
    //$_POSTが空でなく、submitの値が「追加ドロー」である場合
    // $dealer = base64_decode($_POST['dealerstr']);
    // $dealer = unserialize($dealer);
    $dealer = unserialize($_POST['dealerstr']);
    //ディーラーの手札を開封
    // $hand = base64_decode($_POST['handstr']);
    // $hand = unserialize($hand);
    $hand = unserialize($_POST['handstr']);
    //プレイヤーの手札を開封
    // $deck = base64_decode($_POST['deckstr']);
    // $deck = unserialize($deck);
    $deck = unserialize($_POST['deckstr']);
    $hand[] = array_shift($deck);
    $dealerstr = $_POST['dealerstr'];
    //ディーラーはもう既に引き終わっているので梱包の必要がありません。
    $handstr = serialize($hand);
    $deckstr= serialize($deck);}
    ?>
<form method='post'>
<input type='hidden' name='handstr' value = '<?php echo $handstr ?>' />
<input type='hidden' name='deckstr' value = '<?php echo $deckstr ?>' />
<input type='hidden' name='dealerstr' value = '<?php echo $dealerstr ?>' />
<?php

foreach ($hand as $index =>$card) {
    echo $card['face'] . ' of ' . $card['suit'] . "<br />";
}

?>
<p>You have : <?php echo evaluateHand($hand); ?></p>
<p>Dealer is showing the <?php echo $dealer[0]['face'] ?> of <?php echo $dealer[0]['suit'] ?></p> 
<input type='submit' name='submit' value='追加ドロー' />
<input type='submit' name='submit' value='勝負' />
</form>
<a href='3d10-simple-blackjack-dealer.php'>再戦</a>