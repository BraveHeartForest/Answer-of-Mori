<?php

class Hangman {
    protected $word;
    private $right;
    private $wrong = [];
    private $show = '';
    private $guess;
    private $letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o',
    'p','q','r','s','t','u','v','w','x','y','z');
    private $wordletters;

    public function __construct($word)
    {
        $this->word = $word;
        $this->right = array_fill_keys($this->letters, '.');
        //array_...keys($keys,$value)はvalueで指定した値で配列を埋めます。キーとして$keyで指定した配列を用います。
        //今回の場合は$right: Array([a]=>'.' ,..., [z]=>'.')となる。
        $this->wordletters = str_split($word);   //文字列を配列に変換。第二引数が無記入ならば一文字ずつ格納する。
    }

    public function setGuess($guess)
    {
        if(strlen($guess)==1) {
            $this->guess = $guess;
            print "[$guess]で推測します。<br>";
        }else{
            $this->guess = null;
            print "推測する文字は一文字だけを入力してください。<br>";
        }
    }

    public function compareGuess()
    {
            //リスト18
        if (stristr($this->word, $this->guess)) {
        //stristr(string $haystack, mixed $needle [,bool $before_needle = FALSE]) : string :大文字小文字を区別しない。
        //haystackにおいてneedleが最初に見つかった位置を含めてそこから最後までを返します。
        // $email = 'USER@EXAMPLE.com';
        // echo stristr($email, 'e'); // 出力は ER@EXAMPLE.com となります
        // echo stristr($email, 'e', true); // PHP 5.3.0 以降では、出力は US となります

        //hangmanというゲームの仕様上、$wordは単語、$guessは一文字であるべき。

        $this->right[$this->guess] = $this->guess;    //$guessがeならば$right[e]=eとなり、$right : Array([a]=>'.', ..., [e]=>'e', ...,[z]=>'.')
        foreach ($this->wordletters as $letter) {
            $this->show .= $this->right[$letter];
        }
        return print $this->show.'<br>';

        } else {
            //stristrは$word内部で$guessが見つからないとfalseとなるのだろうか？
            $this->wrong[$this->guess] = $this->guess;
            if (count($this->wrong) == 6) {
                //間違った回数が6になったらゲームオーバー
                $this->show = $this->word;
                return $this->show.'<br>';
            } else {
                foreach ($this->wordletters as $letter) {
                    $this->show .= $this->right[$letter];
                }
                return print $this->show.'<br>';
            }
        }
    }
}

$hang = new Hangman("princess");

$hang->setGuess("p");

$hang->compareGuess();

$hang->setGuess("r");

$hang->compareGuess();

$hang->setGuess("in");

$hang->compareGuess();

$hang->setGuess("x");

$hang->compareGuess();
