/* --------------------------------------------------
  moment.js ... 日付、時間関係の操作ライブラリ。フォーマットがダルかったのでズルしました
  参考 http://momentjs.com/guides/
  参考 https://forum.vuejs.org/t/how-to-format-date-for-display/3586/21
-------------------------------------------------- */

/* --------------------------------------------------
  定数定義
-------------------------------------------------- */

const CONFMSG_DELETE = "選択したメモを削除してもよろしいですか？";

/* --------------------------------------------------
  Vue.js
---------------------------------------------------- */

// var filters = {
// 	disp: function (memos) {
//   	return memos.filter(function (memo) {
//     	return memo.isDeleted === false // isDeleted が true のみ抽出
//     })
//   }
// }

new Vue({
    el: '.wrapper', // .wrapper 内で扱う
    data: {
        memos: [
            { id: 1, text: 'テンプレートを元にメモ生成に成功。なお jQuery では Vue.js で生成した DOM に対してイベントトリガーが発火しない模様。', datetime: '2018/05/19 00:00:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 2, text: 'Vue.js って、文末にセミコロンいらないんですね', datetime: '2018/05/19 12:00:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 3, text: 'メモ追加ができるようになった。', datetime: '2018/05/19 19:00:00', isMemoMenuActive: false, isFav: false },
            { id: 4, text: '.reverse() // 最新のメモが上に来るように配列の順番を逆にしたいんだけど追加更新がうまくいかない', datetime: '2018/05/19 19:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 5, text: '条件付きレンダリング...と書くとわかりにくいが、いわゆる if 文でメモ投稿ボタンのアイコンを切り替えられるようになった。あと投稿ボタンを押したら窓が閉じるようになった。ユーザビリティ！', datetime: '2018/05/20 23:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 6, text: 'mouseoverでメモ編集ボタンを表示させたいが、コンポーネント内のテンプレートに v-on 系イベントハンドラを書いてもダメみたい。使い方がイマイチわからないので今日はおしまい。', datetime: '2018/05/21 01:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 7, text: 'mouseover, mouseout でメモ編集モード切り替えができるようになった。コンポーネント自体に method を持たせて、method に memo オブジェクトを渡してあげたら実装できた。なるほど。。正直、オブジェクトじゃなくてフラグ(isMemoMenuActive)を直接なげてしまってよかった気がする', datetime: '2018/05/21 23:20:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 8, text: 'memo の削除ができるようになった。あと地味なガバを修正。メモ編集モード切り替えでちゃんと true, false を指定するようにした。まだ削除ボタンを押すと突然 memo が消えるから、確認ダイアログを出すなりしなくてはいけない。', datetime: '2018/05/22 01:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 9, text: '編集モード切り替えがマシになった。transition(enter/leave)を使うようにした。.{transition名}-enter-avtive といったクラスの指定ができるとは...', datetime: '2018/05/22 22:50:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 10, text: 'メモ投稿モード切替ボタンをホバー時、メモ投稿モード切り替え時のアニメーションがマシになった。ホバー時に transform:scale(1) を指定すると要素の中央を基準に拡大・縮小ができる(1=100%, 1.2=120%)。気持ちがいい！', datetime: '2018/05/23 23:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 11, text: '古　戦　場　か　ら　逃　げ　る　な', datetime: '2018/05/23 23:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 12, text: 'スマホだと :hover 系の疑似要素がうまく動いてくれなかったんだけれど、全体を囲うタグ(body , .wrapper など)の中で ontouchstart="" と書くことによってスマホでも :hover 系の疑似要素が動作するようになった。なんだこの指定。', datetime: '2018/05/23 23:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 13, text: 'user-select: none; でテキスト選択を不可に。これでスマホでボタンをタップした際にテキストが選択されてウザい！とならなくなった。ちゃんとメモ部分は選択できるように user-select: text; を指定。', datetime: '2018/05/23 23:50:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 14, text: '削除時のアニメーションを追加したものの、削除してからメモを追加しようとすると消したメモがもう一度現れて消えていく。バグですね！', datetime: '2018/05/23 23:50:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 15, text: '配列...というか、コレはオブジェクトか。オブジェクトの削除がうまくいかない。そもそも key やら index やらを渡せていない。難しい', datetime: '2018/05/27 23:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 16, text: '1ヶ月ぶりに手を付けた。データを物理削除することができるようになった。小要素から親要素へアクセスするには this.$parent でいいようで。また、dataの一部を削除すると id が連番になるように再度振り分けられるようだ。', datetime: '2018/06/23 14:00:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 17, text: '削除がガバってたので微修正。出力時に配列の並びを反転させてる関係で、削除時にも同様の処理が必要だった。', datetime: '2018/06/23 14:00:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 18, text: 'メモ一覧の表示には transition ではなく、transition-group を使うべきだった。知らなかったせいで大幅改修が入った。compornentなんて必要なかったんや！！あ　ほ　く　さ', datetime: '2018/07/16 02:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 19, text: '追加・削除時のアニメーションがなめらかになった。scale() 使いにくいでスゥゥゥ。padding, margin, border の指定を0にしないと scale(0) 時になんだか余白が残る。', datetime: '2018/07/16 03:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 20, text: 'パトラちゃんさま すこすこのすこ https://www.youtube.com/watch?v=vpxfyHw6Kv8', datetime: '2018/07/16 03:30:00', isMemoMenuActive: false, isDeleted: false, isFav: true },
            { id: 21, text: 'ソートに関する公式ドキュメントが無さすぎてつらい。sort(a, b) 的ななにかを使うらしいけれど...もうダメだ Bookmarkリスト切り替えは次の機会に回す', datetime: '2018/07/16 05:20:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 22, text: '「やらなければ、はじまらない...」「あしたっていまさッ！」てことで作業しま', datetime: '2018/07/16 14:20:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 23, text: 'data(配列)の上書き・削除には splice()を使うんですって。Bookmark機能がそれなりに動くようになった。', datetime: '2018/07/16 15:20:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 24, text: '降順ソートのために data に id を追加しました。これで reverse() を頭悪い用途で使わなくてよくなった。', datetime: '2018/07/16 16:10:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 25, text: 'あとは残すところ「編集」機能のみ。とはいえコレどうやって実装しようか すごく悩むやつで。メモ自体を編集モードにするか、投稿枠から編集させるか...', datetime: '2018/07/16 16:30:00', isMemoMenuActive: false, isDeleted: false, isFav: false },
            { id: 26, text: '「メモは編集できなくてよくね？？」という結論に至りました。とはいえコレで終わりってのもなんだろう', datetime: '2018/07/16 18:00:00', isMemoMenuActive: false, isDeleted: false, isFav: false }
        ],
        newMemoText: '', // メモ追加用。
        editText: "", // 文字列更新用。選択したメモの Text を引き継がせる
        editTarget: "", // memos の index 格納用
        newMemoDatetime: "", // 投稿日
        isAddWrapperActive: false,
        isFavActive: false,
        listCount: 100, // リストソートに使うid用に適当に指定。インクリメントさせていく
    },
    computed: { // 値・配列の変更を検知して実行
        outputMemos: function () {
            memoList = this.memos

            // Bookmark絞り込み
            if (this.isFavActive) {
                memoList = this.memos.filter(function (memo) {
                    return memo.isFav  // true のみ返却
                })
            }

            // idを元に降順ソート
            // ※今後なにか追加するかもなので、あえてここでreturnしない
            memoList.sort((a, b) => {
                a = a.id
                b = b.id
                return (a === b ? 0 : a > b ? -1 : 1) // ココよくわからない。なにこの数字？※1と-1を入れ替えると昇順ソート
            })

            return memoList // 表示直前に並べ替え(降順)
        }
    },
    methods: { // data(memos) 操作用メソッド
        addMemo: function () {
            this.newMemoDatetime = moment().format('YYYY/MM/DD HH:mm:ss') // 投稿時点の datetime を取得
            this.memos.push({ id: this.listCount, text: this.newMemoText, datetime: this.newMemoDatetime, isMemoMenuActive: false, isDeleted: false, isFav: false })
            this.newMemoText = '' // 入力されたテキストを空にする
            this.isAddWrapperActive = false // 投稿窓を閉じる
            this.listCount++ // インクリメント
        },
        toggleAddWrapperActive: function () {
            this.isAddWrapperActive = !this.isAddWrapperActive // [true/false] を反転。この書き方を思いついた人、天才かよって思った
        }
        , toggleMemoMenuActive: function (memo) {
            memo.isMemoMenuActive = true // 編集モード ON (開く)
        },
        toggleMemoMenuNotActive: function (memo) {
            memo.isMemoMenuActive = false  // 編集モード Off (閉じる)
        },
        toggleFavActive: function () {
            this.isFavActive = true  // Bookmarkリスト切り替え
        },
        toggleFavNotActive: function () {
            this.isFavActive = false  // Bookmarkリスト切り替え
        },
        deleteMemo: function (memo) {
            if (!confirm(CONFMSG_DELETE)) return false;
            this.memos.splice(this.memos.indexOf(memo), 1);
        },
        editMemo: function (index, memo, newText) {
            memo.text = newText
            this.memos.splice(index, 1, memo);
        },
        favMemo: function (memo) {
            memo.isFav = !memo.isFav; // 選択したメモの isFav の値 true/falseを逆転
            this.memos.splice(this.memos.indexOf(memo), 1, memo); // メモ一覧の指定したindexに対して まるごと配列を上書き
        }
    }
})
