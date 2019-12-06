<?php
/** 
 * /app/Model/Posts.php
 */
class Posts extends AppModel 
{
    /** 使用テーブル名 */
    public $useTable = 'posts';

    /** 主キー(省略時は「id」になるので省略も可) */
    public $primaryKey = 'id';

    //モデルが属する上位モデルTermsを関連付ける
    //Posts(多) => Terms(一)の関係
    public $belongsTo = array(
        'Terms' => array(
            'foreignKey' => 'term_id'    //外部キー
        )
    );

    //Postsに対して複数のレコードがある下位モデルCommentsを指定
    public $hasMany = array('Comments');
}