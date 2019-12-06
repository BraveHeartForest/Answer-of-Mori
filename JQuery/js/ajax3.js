/*エラーメッセージの生成*/
function errorHandler(args) {
	var error;
	//errorThrownはHTTP通信に成功したときだけ空文字列以外の値が定義される。
	if (args[2]) {
		try {
			//JSONとしてパースが成功かつ{"error":"..."}という構造であった時
			//(undefinedが代入されるのを防ぐためにtoStringメソッドを使用)
			error = JSON.parse(args[0].responseText).error.toString();
		} catch (e) {
			//パースに失敗した、若しくは期待する構造でなかったとき
			//(PHP側にエラーがあったときにもデバッグしやすいようにレスポンスをテキストとして返す)
			error = 'ParseError(' + args[2] + '):' + args[0].responseText;
		}
	} else {
		//通信そのものに失敗したとき
		error = args[1] + '(HTTP request failed)';
	}
	return error;
}


//DOMを全て読み込んだあとに実行される。
$(function () {
	//[#execute]をクリックした時に発動。
	$('#execute').click(function () {
		//Ajax通信を開始する。
		$.ajax({
			url: 'api.php',
			type: 'POST',	//getかpostを指定（デフォルトではget)
			dataType: 'json',	//[json]を指定するとresponseがJSONとしてパースされたオブジェクト
			data: {	//送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
				age: $('#age').val(),
				job: $('#job').val(),
			},	//ここまでがpostで送信するデータのnameとvalue。
		})	//ここまでが$.ajaxでまとめられた部分
			//+ステータスコードは正常で、dataTypeで定義したようにパースできたとき
			.done(function (response) {
				$('#result').val('成功');
				$('#detail').val(response.data);
			})
			//+サーバからステータスコード400以上が返ってきたとき。
			//+ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
			//+通信に失敗したとき
			.fail(function () {
				$('#result').val('失敗');
				$('#detail').val(errorHandler(arguments));
			});
	});
});