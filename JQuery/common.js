/*********************************************/
var INX;   //tdの先頭からの相対  今回未使用
var rINX = 0;  //行カレント 一覧用
var rhinmokuINX = 0;   //品目のカレント行
var rdaiINX = 1;       //大のクリック行
var rchuINX = 1;       //中のクリック行
var rsyoINX = 1;       //小のクリック行
var rMAX = 0;  //行数
var cMAX = 0;  //列数
var $cur_tr = "";  //前のカレント行
var $edit_obj = ""; //ダイアログ編集対象カレント行
var $jyuchu_table = -1; // 0:物件  1:立替  -1:その他
var $disply_type = "jyuchu";  // 'jyuchu':初期  jyuchu:受注  gaichu:外注  all:すべて
var data_exe_sw = 0;  //  1:入力  0:close、キャンセル
var NAME_SUU = 23;     //name配列一行の定数  更新は5つで28に変更
var $insert_update_sw = 0;  //0:新規登録  1:更新
var IKKATU_NAME_SUU = 19;  //一括のname配列一行の定数(請求書印刷の取り消しのため)
var IKKATU_NAME_GAICHU_SUU = 9;  //一括外注のname配列一行の定数
var TATEKAENAME_SUU = 22;  //物件情報 立替金 name配列項目数 更新は27
var JYUCHUNAME_GAICHUID = 10; //明細 受注 外注先ID 配列番号
var TATEKAENAME_GAICHUID = 9; //明細 立替金 外注先ID 配列番号
var tokuisaki_url = "";  //得意先コードと支店のajaxへのURL
var $baseUrl = "yetus";  //行追加での品目、外注のurl（yetus)をTPLで設定する
var gaichugidx;    //外注のajax呼び出しの引数のための変数
var gaichuflg;     //同様
var bukken_br_selectValue;	//	物件情報 受注元記憶用
/**********************************************/
/******************/
/**初期処理部分****/
/******************/
function history_none() {
	window.location.hash = "no-back";
	window.location.hash = "no-back-button";
	window.onhashchange = function () {
		window.location.hash = "no-back";
	}
	history.pushState(null, null, null);
}
function menu_animate(navi) {
	var ul_navi = "ul." + navi + " li";
	$("ul.navi li:not(.disable)").hover(function () {
		$(">ul:not(:animated)", this).slideDown("fast");
	},
		function () {
			$(">ul", this).slideUp("fast");
		});
}
function jyuchu_itiran(item1, item2) {
	$("#" + item1 + " ,#" + item2).on("click", "tr", function () {
		/* $(this).siblings().removeClass('active'); */
		$("#" + item1 + " ,#" + item2).find('.active').removeClass('active');
		$(this).addClass('active');
	});
}
function comment_show() {
	$('.comment button').on('click', function () {
		$(this).blur();
		$('.comment_over').fadeIn(200);
	});
	$('.comment_over').on('click mouseleave', function () {
		$(this).fadeOut(100);
	});
}
function comment_show_update() {
	$('.comment button').on('click', function () {
		$(this).blur();
		var offset = $(this).offset();
		var coH = $('.comment_over').height();
		$('.comment_over').css({ top: (offset.top - coH), left: offset.left - 30 }).fadeIn(200);
	});
	$('.comment_over').on('click mouseleave', function () {
		$(this).fadeOut(100);
	});
}
/* 一括テーブル上部のチェックボックス */
function setbox_position(table, num) {
	var td = $('#' + table + ' th:nth-child(' + num + ')');
	var setbox = $('.set_box');
	var td_offset = td.offset();
	var td_w = td.outerWidth();
	var setbox_w = setbox.outerWidth();
	setbox.css({ left: td_offset.left + (td_w / 2) - setbox_w / 2 });
	//console.log(td_offset.left+(td_w/2) - setbox_w/2);
}

function initial_hide(item) {
	$("." + item).hide();
	width_T("jyuchu");
}
function bukken_table(item) {
	$('#' + item).on("click", "tr", function () {
		rINX = $('#' + item + " tr").index(this);  //要素の番号を求める
		$edit_obj = $(this);
		$cur_tr = this;
		if (item == "jyuchu") {
			$jyuchu_table = 0;   //jyuchu  物件
		} else $jyuchu_table = 1;
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		if ($(this).children().eq(9).text() != "東京") {
			$('#ikanButton').addClass('ikan_disabled');
		}
		else {
			//	東京の物件ですでに大阪移管の番号発行済ならボタンを押させない仕様。
			if ($(this).children().eq(20).text() != 0) {
				$('#ikanButton').addClass('ikan_disabled');
			}
			else if ($(this).children().eq(20).text() == -1) {//	移管フラグたってないならボタンを押させない仕様
				$('#ikanButton').addClass('ikan_disabled');
			}
			else {
				$('#ikanButton').removeClass('ikan_disabled');
			}
		}
		//移管Noが発行されている東京の物件は削除できない仕様。
		if ($(this).children().eq(9).text() == "東京" && $(this).children().eq(4).text() != "") {
			$('.delete').addClass('ikan_disabled');
		}
		else {
			$('.delete').removeClass('ikan_disabled');
		}
	});
}
/*
*	品目ダイアログactive制御  共通（受注、立替）
*/
function hinmoku_table(item, url1, url2, url3) {
	$('#' + item).on("click", "tr", function () {
		rhinmokuINX = $('#' + item + " tr").index(this);  //要素の番号を求める
		if (rhinmokuINX != 0) {
			//受注用の表示
			if (item == "hinmoku_itiran_1") {
				rdaiINX = rhinmokuINX;
				ajax_hinmoku_jyuchu(2, 2, url1, url2, url3);
			}
			if (item == "hinmoku_itiran_2") {
				rchuINX = rhinmokuINX;
				ajax_hinmoku_jyuchu(2, 3, url1, url2, url3);
			}
			if (item == "hinmoku_itiran_3") {
				rsyoINX = rhinmokuINX;
			}
			//立替金用の表示
			if (item == "tatekae_hinmoku_itiran_1") {
				rdaiINX = rhinmokuINX;
				ajax_hinmoku_tatekae(2, 2, url1, url2, url3);
			}
			if (item == "tatekae_hinmoku_itiran_2") {
				rchuINX = rhinmokuINX;
				ajax_hinmoku_tatekae(2, 3, url1, url2, url3);
			}
			if (item == "tatekae_hinmoku_itiran_3") {
				rsyoINX = rhinmokuINX;
			}

			$("#" + item).find('.active').removeClass('active');
			//$(this).siblings().removeClass('active');
			var tbl = document.getElementById(item);

			tbl.rows[rhinmokuINX].cells[1].className = 'active';

			//$(this).addClass('active');
			//$(this).setAttribute("class","active");
		}
	});
}
/******************/
/**初期終了部分****/
/******************/
/*
*品目設定  品目の受注テーブルのコードと品目に設定
*
*/
function set_hinmoku_jyuchu() {
	var idx = 0;
	if ($jyuchu_table == 0) {
		idx = (rINX - 1) * NAME_SUU;
	} else {
		idx = (rINX - 1) * TATEKAENAME_SUU;
	}
	var t = document.getElementById("hinmoku_itiran_1");
	tmp = t.rows[rdaiINX].cells[0];
	document.form1.elements['jyuchuname[]'][idx].value = tmp.innerHTML;

	t = document.getElementById("hinmoku_itiran_2");
	tmp = t.rows[rchuINX].cells[0];
	document.form1.elements['jyuchuname[]'][idx + 1].value = tmp.innerHTML;

	t = document.getElementById("hinmoku_itiran_3");
	tmp = t.rows[rsyoINX].cells[0];
	document.form1.elements['jyuchuname[]'][idx + 2].value = tmp.innerHTML;

	tmp = t.rows[rsyoINX].cells[1];

	document.form1.elements['jyuchuname[]'][idx + 3].value = tmp.innerHTML;
	$('#select_list').dialog("close");
}
/*
*品目設定  品目の立替金テーブルのコードと品目に設定
*
*/
function set_hinmoku_tatekae() {
	var idx = 0;
	if ($jyuchu_table == 0) {
		idx = (rINX - 1) * NAME_SUU;
	} else {
		idx = (rINX - 1) * TATEKAENAME_SUU;
	}
	var t = document.getElementById("tatekae_hinmoku_itiran_1");
	tmp = t.rows[rdaiINX].cells[0];
	document.form1.elements['tatekaename[]'][idx].value = tmp.innerHTML;

	t = document.getElementById("tatekae_hinmoku_itiran_2");
	tmp = t.rows[rchuINX].cells[0];
	document.form1.elements['tatekaename[]'][idx + 1].value = tmp.innerHTML;

	t = document.getElementById("tatekae_hinmoku_itiran_3");
	tmp = t.rows[rsyoINX].cells[0];
	document.form1.elements['tatekaename[]'][idx + 2].value = tmp.innerHTML;

	tmp = t.rows[rsyoINX].cells[1];

	document.form1.elements['tatekaename[]'][idx + 3].value = tmp.innerHTML;
	$('#tatekae_select_list').dialog("close");
}
/*
*  受注の消費税の取得
*/
function get_jyuchu_zei() {

	zei_ritu = $('select[name="jyuchu_zei"]').val();
	zeiritu = 1 + (zei_ritu / 100);

	return zeiritu;
}
/*
*  外注の消費税の取得
*/
function get_gaichu_zei() {

	zei_ritu = $('select[name="gaichu_zei"]').val();
	zeiritu = 1 + (zei_ritu / 100);
	return zeiritu;

}
/*
* 受注金額設定
*   type : 1  受注
*          2  外注
*/
function set_kingaku(type) {

	if (type == 1) {
		set_jyuchu_kingaku();
		set_jyuchu_syokei();
	} else {
		set_gaichu_kingaku();
		set_gaichu_syokei();
	}
}
/*
* 受注の個数と単価で金額を設定
*/
function set_jyuchu_kingaku() {

	if ($jyuchu_table == 0) {
		idx = (rINX - 1) * NAME_SUU;
	} else {
		idx = (rINX - 1) * TATEKAENAME_SUU;
	}
	suu = parseInt(document.form1.elements['jyuchuname[]'][idx + 5].value);
	suuval = document.form1.elements['jyuchuname[]'][idx + 5].value;
	//カンマを消す
	suu = parseInt(suuval.replace(/,/g, ""));
	tankaval = document.form1.elements['jyuchuname[]'][idx + 7].value;
	tanka = parseInt(document.form1.elements['jyuchuname[]'][idx + 7].value);
	//カンマを消す
	tanka = parseInt(tankaval.replace(/,/g, ""));
	kekka = suu * tanka;
	//カンマ付ける
	kekkatmp = kekka.toLocaleString();
	if (!isNaN(suu)) {
		document.form1.elements['jyuchuname[]'][idx + 5].value = suu.toLocaleString();
	}
	if (!isNaN(tanka)) {
		document.form1.elements['jyuchuname[]'][idx + 7].value = tanka.toLocaleString();
	}
	if (!isNaN(kekka)) {
		document.form1.elements['jyuchuname[]'][idx + 8].value = kekkatmp;
	} else {
		document.form1.elements['jyuchuname[]'][idx + 8].value = "";
	}
}
/*
*受注の小計を計算
*
*/
function set_jyuchu_syokei() {
	rw = getRowNum("jyuchu");

	//先頭は1からrw-1までを計算する

	var sum = 0;
	var idx = 0;
	var tmp = 0;
	rw -= 3;

	for (i = 0; i <= rw; i++) {

		tmp = parseInt(document.form1.elements['jyuchuname[]'][idx + 8].value.replace(/,/g, ""));
		if (!isNaN(tmp) && (tmp != null)) {
			sum += tmp;
		} else {
			sum += 0;
			//alert("NaN  だよ？");
		}
		idx += NAME_SUU;
	}

	$('input[name="jyuchu_syokei"]').val(sum.toLocaleString());
	set_jyuchu_kingaku_2();  //下部の受注金額の設定
	set_jyuchu_kingaku_1();  //上部の受注金額の設定
}
/*
*  上部の受注金額の設定
*  下部のデータを設定する
*/
function set_jyuchu_kingaku_1() {
	$('#dialog_item18').val($('#dialog_item27').val()); //受注金額
	$('#dialog_item19').val($('#dialog_item28').val()); //消費税
	$('#dialog_item20').val($('#dialog_item29').val()); //立替金
	$('#dialog_item21').val($('#dialog_item30').val()); //合計
}

/*
*  下部の受注金額の設定
*/
function set_jyuchu_kingaku_2() {
	jyu_kin = parseInt($('input[name="jyuchu_syokei"]').val().replace(/,/g, ""));
	$('#dialog_item27').val(jyu_kin.toLocaleString()); //受注金額

	zei = get_jyuchu_zei();
	zei -= 1;
	zei_value = Math.round(parseFloat(jyu_kin * zei));
	$('#dialog_item28').val(zei_value.toLocaleString()); //消費税

	tmp = parseInt($('input[name="tatekae_jyuchu_syokei"]').val().replace(/,/g, ""));

	if (!isNaN(tmp) && (tmp != null)) {
		tatekae_jyu_kin = parseInt(tmp);
	} else {
		tatekae_jyu_kin = 0;
	}
	$('#dialog_item29').val(tatekae_jyu_kin.toLocaleString()); //立替金

	goukei = Math.round(parseFloat(jyu_kin + zei_value + tatekae_jyu_kin));

	$('#dialog_item30').val(goukei.toLocaleString()); //合計

}
/*
* 外注の個数と単価で金額を設定
*/
function set_gaichu_kingaku() {

	idx = (rINX - 1) * NAME_SUU;
	suuval = document.form1.elements['jyuchuname[]'][idx + 13].value;
	suu = parseInt(document.form1.elements['jyuchuname[]'][idx + 13].value);
	//カンマを消す
	suu = parseInt(suuval.replace(/,/g, ""));

	tankaval = document.form1.elements['jyuchuname[]'][idx + 15].value;
	tanka = parseInt(document.form1.elements['jyuchuname[]'][idx + 15].value);
	//カンマを消す
	tanka = parseInt(tankaval.replace(/,/g, ""));

	kekka = Math.round(parseFloat(suu * tanka));
	//カンマ付ける
	kekkatmp = kekka.toLocaleString();
	kekkatmp = kekka;
	if (!isNaN(suu)) {
		document.form1.elements['jyuchuname[]'][idx + 13].value = suu.toLocaleString();
	}
	if (!isNaN(tanka)) {
		document.form1.elements['jyuchuname[]'][idx + 15].value = tanka.toLocaleString();
	}
	if (!isNaN(kekka)) {
		document.form1.elements['jyuchuname[]'][idx + 16].value = kekka.toLocaleString();
	} else {
		document.form1.elements['jyuchuname[]'][idx + 16].value = "";
	}
}
/*
*外注の小計を計算
*
*/
function set_gaichu_syokei() {
	rw = getRowNum("jyuchu");

	//先頭は1からrw-1までを計算する

	var tmp = 0;
	var sum = 0;
	var idx = 0;
	rw -= 3;

	for (i = 0; i <= rw; i++) {
		tmp = parseInt(document.form1.elements['jyuchuname[]'][idx + 16].value.replace(/,/g, ""));
		if (!isNaN(tmp) && (tmp != null)) {
			sum += tmp;
		} else {
			sum += 0;
			sum.toLocaleString();
			//alert("NaN  だよ？");
		}
		idx += NAME_SUU;
	}

	$('input[name="gaichu_syokei"]').val(sum.toLocaleString());
	set_gaichu_kingaku_2();  //下部の外注金額の設定
	set_gaichu_kingaku_1();  //上部の外注金額の設定
}
/*
*  上部の外注金額の設定
*/
function set_gaichu_kingaku_1() {
	$('#dialog_item23').val($('#dialog_item31').val()); //外注金額
	$('#dialog_item24').val($('#dialog_item32').val()); //消費税
	$('#dialog_item25').val($('#dialog_item33').val()); //立替金
	$('#dialog_item26').val($('#dialog_item34').val()); //合計
}
/*
*  下部の外注金額の設定
*/
function set_gaichu_kingaku_2() {
	gai_kin = parseInt($('input[name="gaichu_syokei"]').val().replace(/,/g, ""));
	$('#dialog_item31').val(gai_kin.toLocaleString()); //外注金額

	zei = get_gaichu_zei();
	zei -= 1;
	zei_value = Math.round(parseFloat(gai_kin * zei));
	$('#dialog_item32').val(zei_value.toLocaleString()); //消費税

	tmp = parseInt($('input[name="tatekae_gaichu_syokei"]').val().replace(/,/g, ""));
	if (!isNaN(tmp) && (tmp != null)) {
		tatekae_gai_kin = parseInt(tmp);
	} else {
		tatekae_gai_kin = 0;
	}

	$('#dialog_item33').val(tatekae_gai_kin.toLocaleString()); //立替金
	goukei = Math.round(parseFloat(gai_kin + zei_value + tatekae_gai_kin));

	$('#dialog_item34').val(goukei.toLocaleString()); //合計

}

/*
* 立替金金額設定
*   type : 1  受注
*          2  外注
*/
function set_tatekae_kingaku(type) {

	if (type == 1) {
		set_tatekae_jyuchu_kingaku();
		set_tatekae_jyuchu_syokei();
	} else {
		set_tatekae_gaichu_kingaku();
		set_tatekae_gaichu_syokei();
	}

}
/*
* 立替金の受注の個数と単価で金額を設定
*/
function set_tatekae_jyuchu_kingaku() {
	//zei = get_jyuchu_zei();

	idx = (rINX - 1) * (TATEKAENAME_SUU);

	suuval = document.form1.elements['tatekaename[]'][idx + 5].value;
	suu = parseInt(document.form1.elements['tatekaename[]'][idx + 5].value);
	suu = parseInt(suuval.replace(/,/g, ""));

	tankaval = document.form1.elements['tatekaename[]'][idx + 7].value;
	tanka = parseInt(document.form1.elements['tatekaename[]'][idx + 7].value);
	tanka = parseInt(tankaval.replace(/,/g, ""));

	kekka = Math.round(parseFloat(suu * tanka));
	kekkatmp = kekka.toLocaleString();

	if (!isNaN(suu)) {
		document.form1.elements['tatekaename[]'][idx + 5].value = suu.toLocaleString();
	}
	if (!isNaN(tanka)) {
		document.form1.elements['tatekaename[]'][idx + 7].value = tanka.toLocaleString();
	}
	if (!isNaN(kekka)) {
		document.form1.elements['tatekaename[]'][idx + 8].value = kekka.toLocaleString();
	} else {
		document.form1.elements['tatekaename[]'][idx + 8].value = "";
	}
}
/*
*立替金の受注の小計を計算
*
*/
function set_tatekae_jyuchu_syokei() {
	rw = getRowNum("tatekae");

	//先頭は1からrw-1までを計算する

	var tmp = 0;
	var sum = 0;
	var idx = 0;
	rw -= 3;

	for (i = 0; i <= rw; i++) {
		tmp = parseInt(document.form1.elements['tatekaename[]'][idx + 8].value.replace(/,/g, ""));
		if (!isNaN(tmp) && (tmp != null)) {
			sum += tmp;
		} else {
			sum += 0;
			//alert("NaN  だよ？");
		}
		idx += (TATEKAENAME_SUU);
	}

	$('input[name="tatekae_jyuchu_syokei"]').val(sum.toLocaleString());
	set_jyuchu_kingaku_2();  //下部の受注金額の設定
	set_jyuchu_kingaku_1();  //上部の受注金額の設定
}
/*
* 立替金の外注の個数と単価で金額を設定
*/
function set_tatekae_gaichu_kingaku() {

	//zei = get_gaichu_zei();
	idx = (rINX - 1) * (TATEKAENAME_SUU);   //立替金は棟の入力がないのがname配列のためにdisabledのinput設定

	suuval = document.form1.elements['tatekaename[]'][idx + 12].value;
	suu = parseInt(document.form1.elements['tatekaename[]'][idx + 12].value);
	suu = parseInt(suuval.replace(/,/g, ""));

	tankaval = document.form1.elements['tatekaename[]'][idx + 14].value;
	tanka = parseInt(document.form1.elements['tatekaename[]'][idx + 14].value);
	tanka = parseInt(tankaval.replace(/,/g, ""));

	kekka = Math.round(parseFloat(suu * tanka));
	if (!isNaN(suu)) {
		document.form1.elements['tatekaename[]'][idx + 12].value = suu.toLocaleString();
	}
	if (!isNaN(tanka)) {
		document.form1.elements['tatekaename[]'][idx + 14].value = tanka.toLocaleString();
	}
	if (!isNaN(kekka)) {
		document.form1.elements['tatekaename[]'][idx + 15].value = kekka.toLocaleString();
	} else {
		document.form1.elements['tatekaename[]'][idx + 15].value = "";
	}
}
/*
*立替金の外注の小計を計算
*
*/
function set_tatekae_gaichu_syokei() {
	rw = getRowNum("tatekae");

	//先頭は1からrw-1までを計算する

	var tmp = 0;
	var sum = 0;
	var idx = 0;
	rw -= 3;

	for (i = 0; i <= rw; i++) {
		tmp = parseInt(document.form1.elements['tatekaename[]'][idx + 15].value.replace(/,/g, ""));

		if (!isNaN(tmp) && (tmp != null)) {
			sum += tmp;
		} else {
			sum += 0;
			//alert("NaN  だよ？");
		}
		idx = idx + TATEKAENAME_SUU;
	}

	$('input[name="tatekae_gaichu_syokei"]').val(sum.toLocaleString());
	set_gaichu_kingaku_2();  //下部の外注金額の設定
	set_gaichu_kingaku_1();  //上部の外注金額の設定
}
/*
*消費税の率と額を設定
*   type  :  1  受注金額の消費税
*            2  外注金額の消費税
*/
function set_syouhizei(type) {
	rINXtmp = rINX;
	rINX = 0;
	tmpjyuchu = $jyuchu_table;

	if (type == 1) {
		zei_ritu = $('select[name="jyuchu_zei"]').val();
		zei_value = $('#dialog_item27').val() * (zei_ritu / 100);
		//受注金額の消費税率
		$('#dialog_item17').val(zei_ritu);
		//金額の消費税
		$('#dialog_item28').val(zei_value);
		//再計算
		rw = getRowNum("tatekae");
		rw -= 3;
		/***/
		for (i = 0; i <= rw; i++) {

			rINX++;

			set_tatekae_jyuchu_kingaku();
		}

		set_tatekae_jyuchu_syokei();
	} else {
		zei_ritu = $('select[name="gaichu_zei"]').val();
		zei_value = $('#dialog_item31').val() * (zei_ritu / 100);

		//外注金額の消費税率
		$('#dialog_item22').val(zei_ritu);
		//金額の消費税
		$('#dialog_item32').val(zei_value);
		//再計算
		rw = getRowNum("tatekae");
		rw -= 3;
		/***/
		for (i = 0; i <= rw; i++) {
			rINX++;
			set_tatekae_gaichu_kingaku();
		}
		set_tatekae_gaichu_syokei();
	}
	rINX = rINXtmp;
	$jyuchu_table = tmpjyuchu;
}

/*****
得意先
******/
function tokuisaki_itiran(item) {
	$("#" + item).on(
		"dblclick", "tr", function () {
			//Kimura Add START 2016.01.25
			gyonum = $edit_obj.children("td").eq(0).text();
			if (gyonum != "") {
				$('#client_item_01').val($edit_obj.children("td").eq(7).text());	//得意先ID:id
				//$('#client_item_02').val($edit_obj.children( "td" ).eq(0).text());	//得意先ID(ホントはCODEだが、今値が無いのでIDを入れておく)
				$('#client_item_02').val($edit_obj.children("td").eq(0).text());	//得意先CODE(CODEの値が入ったら、こっちが有効):code
				$('#client_item_03').val($edit_obj.children("td").eq(1).text());	//得意先名:corp_name
				$('#client_item_04').val($edit_obj.children("td").eq(10).text());	//支店コード:br_code
				//支店設定のときで物件情報の時に設定
				//本来は区別を引数で制御すべき
				if (tokuisaki_url != "") {
					sitensw = document.getElementById('client_item_04_0').value;

					if (sitensw == 1) {  //inputタイプ
						$('#client_item_05').val($edit_obj.children("td").eq(3).text());	//支店名:br_name
					} else {   //selectタイプ
						//select部分の設定の変更
						setHTML = null;
						setHTML = '<input id="client_item_04_0" type="hidden" size="10" value="1" name="bk_tbl_br_code_kubetu">';
						siten_cd = $edit_obj.children("td").eq(10).text();
						siten_name = $edit_obj.children("td").eq(3).text()
						setHTML += '<input id="client_item_04" type="hidden" size="10" value="' + siten_cd + '" name="bk_tbl_br_code">';
						setHTML += '<input id="client_item_05" type="text" size="10" value="' + siten_name + '" name="bk_tbl_br_code">';
						document.getElementById('client_item_04_kari').innerHTML = setHTML;
					}
				}
				//
				$('#client_item_06').val($edit_obj.children("td").eq(8).text());	//郵便番号:post_disp
				$('#client_item_07').val($edit_obj.children("td").eq(4).text());	//住所:addr_disp
				$('#client_item_08').val($edit_obj.children("td").eq(5).text());	//TEL:corp_tel
				//請求先gyousya2_item_02がnullだと設定
				seikyu = $('#gyousya2_item_02').val();
				if (seikyu == "") {
					$('#torihiki_item_01').val('得意先');									//取引
					$('#torihiki_item_02').val($edit_obj.children("td").eq(12).text());	//請求締日:tj_s1
					$('#torihiki_item_03').val($edit_obj.children("td").eq(9).text());	//部署:name
					$('#torihiki_item_04').val($edit_obj.children("td").eq(13).text());	//請求書(月):bill_month
					$('#torihiki_item_05').val($edit_obj.children("td").eq(14).text());	//請求書(日):bill_date
					$('#torihiki_item_06').val($edit_obj.children("td").eq(11).text());	//担当者:furikana
					$('#torihiki_item_07').val($edit_obj.children("td").eq(15).text());	//条件:tj_p1
					$('#torihiki_item_08').val($edit_obj.children("td").eq(16).text());	//条件:tj_p2
					$('#torihiki_item_09').val($edit_obj.children("td").eq(17).text());	//備考1:biko1
					$('#torihiki_item_10').val($edit_obj.children("td").eq(18).text());	//備考2:biko2
				}
				//Kimura Add END 2016.01.25

				d1 = $('input[name="den_date2"]').val();
				if (d1 != "" && d1 !== void 0) {
					kekka = separateDate(d1);
					tmp = get_torihiki(d1);
					if (tmp == "") {
						$('input[name="dt_nyy"]').val("");
					} else {
						$('input[name="dt_nyy"]').val(tmp);
					}
				}

				//fujimori 2016/01/27 Add
				$('#export_select_item8').val($edit_obj.children("td").eq(1).text());

				$('#ikkatu_serch_item1').val($edit_obj.children("td").eq(0).text());
				$('#ikkatu_serch_item2').val($edit_obj.children("td").eq(1).text());

				$('#select_item6').val($edit_obj.children("td").eq(1).text());
				$('#ichiran_search_box_tokuisaki').val($edit_obj.children("td").eq(1).text());
				$('#export_select_2Month_item8').val($edit_obj.children("td").eq(1).text());

				//請求先で指定した書式にする
				if ($edit_obj.children("td").eq(19).text() == 0) {
					$('#select7').val(0);
				}
				else if ($edit_obj.children("td").eq(19).text() == 1) {
					$('#select7').val(2);
				}
				$('#select-tokui').dialog("close");
			}
		});
}
/*****
請求先
******/
function seikyusaki_itiran(item) {
	$("#" + item).on(
		"dblclick", "tr", function () {
			//Kimura Add START 2016.01.25

			gyonum = $edit_obj.children("td").eq(0).text();
			if (gyonum != "") {
				$('#gyousya2_item_01').val($edit_obj.children("td").eq(0).text());	//請求先ID:ID
				$('#gyousya2_item_02').val($edit_obj.children("td").eq(1).text());	//請求先名:name
				$('#torihiki_item_01').val('請求先');									//取引
				$('#torihiki_item_02').val($edit_obj.children("td").eq(7).text());	//請求締日:cut_date
				$('#torihiki_item_03').val($edit_obj.children("td").eq(5).text());	//部署:position
				$('#torihiki_item_04').val($edit_obj.children("td").eq(8).text());	//請求書(月):bill_month
				$('#torihiki_item_05').val($edit_obj.children("td").eq(9).text());	//請求書(日):bill_date
				$('#torihiki_item_06').val($edit_obj.children("td").eq(6).text());	//担当者:tanto_name
				$('#torihiki_item_07').val($edit_obj.children("td").eq(10).text());	//条件:pay_month
				$('#torihiki_item_08').val($edit_obj.children("td").eq(11).text());	//条件:pay_date
				$('#torihiki_item_09').val($edit_obj.children("td").eq(12).text());	//備考1:biko1
				$('#torihiki_item_10').val($edit_obj.children("td").eq(13).text());	//備考2:biko2
				//Kimura Add END 2016.01.25
				d1 = $('input[name="den_date2"]').val();
				if (d1 != "" && d1 !== void 0) {
					kekka = separateDate(d1);
					tmp = get_torihiki(d1);
					if (tmp == "") {
						$('input[name="dt_nyy"]').val("");
					} else {
						$('input[name="dt_nyy"]').val(tmp);
					}
				}

				//fujimori 2016/01/27 Add
				$('#export_select_item9').val($edit_obj.children("td").eq(1).text());
				$('#ikkatu_serch_item3').val($edit_obj.children("td").eq(1).text());
				$('#export_select_2Month_item9').val($edit_obj.children("td").eq(1).text());


				$('#select_item7').val($edit_obj.children("td").eq(1).text());

				//請求先で指定した書式にする
				if ($edit_obj.children("td").eq(14).text() == 0) {
					$('#select7').val(0);
				}
				else if ($edit_obj.children("td").eq(14).text() == 1) {
					$('#select7').val(2);
				}
				$('#select-seikyu').dialog("close");
			}
		});
}

/*****
外注先
******/
function gaichusaki_itiran_ikkatu(item) {

	$("#" + item).on(
		"dblclick", "tr", function () {

			gyonum = $edit_obj.children("td").eq(0).text();
			if (gyonum != "") {
				//fujimori 2016/03/31 Add
				$('#ikkatu_serch_item4').val($edit_obj.children("td").eq(1).text());
			}
			$('#select-gaichu').dialog("close");
		});
}

/*****
外注先
******/
function gaichusaki_itiran(item) {
	var flg;
	var gidx = 0, gnidx = 0;

	$("#" + item).on(
		"dblclick", "tr", function () {

			//Kimura Add START 2016.01.27
			flg = $edit_obj.children("td").eq(5).text();
			gidx = $edit_obj.children("td").eq(6).text();
			gnidx = Number(gidx) + 1;
			ggnidx = Number(gnidx) + 1;
			hinmoku = Number(gidx) - 7;
			tatekaehinmoku = Number(gidx) - 6;

			if (flg == '1') {
				//受注・外注明細
				//外注先ID
				gyonum = $edit_obj.children("td").eq(0).text();
				if (gyonum != "") {
					document.form1.elements['jyuchuname[]'][gidx].value = $edit_obj.children("td").eq(0).text();
					//外注先名
					document.form1.elements['jyuchuname[]'][gnidx].value = $edit_obj.children("td").eq(1).text();
					//依頼先
					document.form1.elements['jyuchuname[]'][ggnidx].value =
						document.form1.elements['jyuchuname[]'][hinmoku].value;
					//外注使用の印
					t = document.getElementById("jyuchu");
					//このrINXは外注ダイアログのカレント行
					//明細 受注 外注先ID 配列番号 JYUCHUNAME_GAICHUID
					//明細 受注 外注の全項目数 NAME_SUU

					rjyuchuINX = ((gidx - JYUCHUNAME_GAICHUID) / NAME_SUU) + 1;

					t.rows[rjyuchuINX].cells[1].innerHTML = '<td class="j2 tc"><i class="fa fa-certificate"></i></td>';
					//t.rows[rjyuchuINX].cells[1].setAttribute("class","j2 tc");
					$('#select-gaichu').dialog("close");
				}
			} else if (flg == '2') {

				//受注・外注 立替金
				//外注先ID
				gyonum = $edit_obj.children("td").eq(0).text();
				if (gyonum != "") {
					document.form1.elements['tatekaename[]'][gidx].value = $edit_obj.children("td").eq(0).text();
					//外注先名
					document.form1.elements['tatekaename[]'][gnidx].value = $edit_obj.children("td").eq(1).text();
					//依頼先
					document.form1.elements['tatekaename[]'][ggnidx].value =
						document.form1.elements['tatekaename[]'][tatekaehinmoku].value;
					//外注使用の印
					t = document.getElementById("tatekae");
					//このrINXは外注ダイアログのカレント行
					//明細 立替金 外注先ID 配列番号 TATEKAENAME_GAICHUID
					//立替金の全項目数 TATEKAENAME_SUU

					rtatekaeINX = ((gidx - TATEKAENAME_GAICHUID) / TATEKAENAME_SUU) + 1;

					t.rows[rtatekaeINX].cells[1].innerHTML = '<td class="j2 tc"><i class="fa fa-certificate"></i></td>';
					//t.rows[rtatekaeINX].cells[1].setAttribute("class","j2 tc");
					$('#select-gaichu').dialog("close");
				}
			}
			//Kimura Add END 2016.01.27

			//$('#select_item7').val($edit_obj.children( "td" ).eq(1).text());
			//$('#select-gaichu').dialog( "close" );
		});
}
/****  end ********/
function getRowNum(id) {
	var myTbl = document.getElementById(id);
	var rw = myTbl.rows.length;
	return rw;
}
function getColNum(id) {
	var myTbl = document.getElementById(id);
	var cl = myTbl.rows[0].cells.length;
	return cl;
}
function erase(obj) {
	//仮にすべてを表示して未表示とする
	$('.hide_out').show();
	$('.hide_area').show();
	$(obj).hide();
}
/**
* 行追加
*/
function insertRow(flg) {
	// flg=1は行削除から呼ばれたという意味
	if ($jyuchu_table == 0) {
		id = "jyuchu";
	} else {
		id = "tatekae";
	}
	var table = document.getElementById(id);
	// カレント行の下に追加　カウントして上に追加
	var rw = rINX;
	rmax = getRowNum(id) - 2;

	if (!rINX || (rINX == '0') || (rINX > rmax)) {
		//window.confirm('追加する行を選択してください');
		errorConfirmDialog('0000', 3)
		return false;
	}

	if ($jyuchu_table != 0 && flg != 1) { // 立替が選ばれていたら
		errorConfirmDialog('4000', 6); // 行追加の禁止
		return;
	}

	// テーブル取得

	var row = table.insertRow(rw + 1);

	// セルの挿入
	var cell = [];
	for (i = 0; i < (getColNum(id) + 1); i++) {
		cell.push(row.insertCell(-1));
	}
	//単位のoptionを取得
	optionstr = ajax_func_unitSearch();

	// セルの内容入力
	if ($jyuchu_table == 0) {
		//受注の追加
		cell[0].innerHTML = '<td class="j1 tr"></td>';
		cell[0].setAttribute("class", "j1 tr");
		cell[1].innerHTML = '<td class="j2 tc"></td>';
		cell[1].setAttribute("class", "j2 tc");
		cell[2].innerHTML = '<td class="j3 tl"><input type="hidden" name="jyuchuname[]" value=""><input type="hidden" name="jyuchuname[]" value=""><input type="hidden" name="jyuchuname[]" value="">' +
			'<input type="text"  size="30"  name="jyuchuname[]" value="" ondblclick="javascript:referjyuchu_hinmokuButton(' +
			"'select_list','" + $baseUrl + "/ajax/jyuchuhinmokudai','" +
			$baseUrl + "/ajax/jyuchuhinmokuchu','" +
			$baseUrl + "/ajax/jyuchuhinmokusyo');" + '"></td>';
		cell[2].setAttribute("class", "j3 tl");
		cell[3].innerHTML = '<td class="j4 tl hide_out"><input type="text" size="30"  name="jyuchuname[]" value=""></td>';
		cell[3].setAttribute("class", "j4 tl hide_out");
		cell[4].innerHTML = '<td class="j5 tc hide_out"><input type="text" size="1"  name="jyuchuname[]" value="" onkeyup="javascript:set_kingaku(1)" class="znkk2"></td>';
		cell[4].setAttribute("class", "j5 tc hide_out");
		cell[5].innerHTML = '<td class="j6 tr hide_out">' +
			'<select class="selectbox1"  name="jyuchuname[]">' +
			optionstr +
			'</select>' +
			'</td>';
		cell[5].setAttribute("class", "j6 tr hide_out");
		cell[6].innerHTML = '<td class="j7 tr hide_out"><input type="text" size="10"  name="jyuchuname[]" value=""  onkeyup="javascript:set_kingaku(1);" class="znkk2"></td>';
		cell[6].setAttribute("class", "j7 tr hide_out");
		cell[7].innerHTML = '<td class="j8 tr hide_out"><input type="text" size="10"  name="jyuchuname[]" value="" disabled ></td>';
		cell[7].setAttribute("class", "j8 tr hide_out");
		cell[8].innerHTML = '<td class="j9 tr hide_out"><input type="text" size="1"  name="jyuchuname[]"value=""  class="znkk"></td>';
		cell[8].setAttribute("class", "j9 tr hide_out");
		cell[9].innerHTML = '<td class="g1 tl hide_area">' +
			'<input type="hidden"  name="jyuchuname[]" value="">' +
			'<input type="text" size="10"  name="jyuchuname[]" value="" ondblclick="javascript:refergaichusakiButton(' +
			"'select-gaichu','select-gaichu-form','" + $baseUrl + "/ajax/gaichu','1');" + '"></td>';

		cell[9].setAttribute("class", "g1 tl hide_area");
		cell[10].innerHTML = '<td class="g2 tl hide_area"><input type="text" size="30"  name="jyuchuname[]" value=""></td>';
		cell[10].setAttribute("class", "g2 tl hide_area");
		cell[11].innerHTML = '<td class="g3 tc hide_area"><input type="text" size="1"  name="jyuchuname[]" value="" onkeyup="javascript:set_kingaku(2);" class="znkk2"></td>';
		cell[11].setAttribute("class", "g3 tc hide_area");
		cell[12].innerHTML = '<td class="g4 tr hide_area">' +
			'<select class="selectbox1"  name="jyuchuname[]">' +
			optionstr +
			'</select>' +
			'</td>';
		cell[12].setAttribute("class", "g4 tr hide_area");
		cell[13].innerHTML = '<td class="g5 tr hide_area"><input type="text" size="10"  name="jyuchuname[]" value=""  onkeyup="javascript:set_kingaku(2);" class="znkk2"></td>';
		cell[13].setAttribute("class", "g5 tr hide_area");
		cell[14].innerHTML = '<td class="g6 tr hide_area"><input type="text" name="jyuchuname[]" size="10" value="" disabled></td>';
		cell[14].setAttribute("class", "g6 tr hide_area");
		cell[15].innerHTML = '<td class="g7 tc hide_area"><input type="text" size="10"  name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);"  value=""></td>';
		cell[15].setAttribute("class", "g7 tc hide_area");
		cell[16].innerHTML = '<td class="g8 tc hide_area">' +
			'<button type="button"><i class="fa fa-print"></i>印刷</button>&nbsp;' +
			'<select  class="selectbox1"  name="jyuchuname[]">' +
			'<option value="0" label="未発行" selected>未発行</option>' +
			'<option value="1" label="発行済">発行済</option>' +
			//'<option value="2" label="専用">専用</option>' +
			'</select>' +
			'</td>';
		cell[16].setAttribute("class", "g8 tc hide_area");
		cell[17].innerHTML = '<td class="g9 tc hide_area"><input type="text" size="10"   name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);" value=""></td>';
		cell[17].setAttribute("class", "g9 tc hide_area");
		cell[18].innerHTML = '<td class="g10 tc hide_area"><input type="text" size="10"   name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);" value=""></td>';
		cell[18].setAttribute("class", "g10 tc hide_area");
		if ($insert_update_sw == 1) {
			cell[19].innerHTML = '<td class="g11 tc hide_area"><input type="text" size="10"  name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);"  value="">' +
				' ～ <input type="text" size="10"   name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);" value="">' +
				'<input type="hidden" name="jyuchuname[]" value="" ><input type="hidden" name="jyuchuname[]" value="" ><input type="hidden" name="jyuchuname[]" value="" >' +
				'<input type="hidden" name="jyuchuname[]" value="" ><input type="hidden" name="jyuchuname[]" value="" >' +
				'</td>';
		} else {
			cell[19].innerHTML = '<td class="g11 tc hide_area"><input type="text" size="10"  name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);"  value="">' +
				' ～ <input type="text" size="10"   name="jyuchuname[]" onfocus="javascript:dateDialog(this,0);" value=""></td>';
		}
		cell[19].setAttribute("class", "g11 tc hide_area");


	} else {
		//立替金の追加
		cell[0].innerHTML = '<td class="j1 tr"></td>';
		cell[0].setAttribute("class", "j1 tr");
		cell[1].innerHTML = '<td class="j2 tc"></td>';
		cell[1].setAttribute("class", "j2 tc");
		cell[2].innerHTML = '<td class="j3 tl"><input type="hidden" name="tatekaename[]" value=""><input type="hidden" name="tatekaename[]" value=""><input type="hidden" name="tatekaename[]" value="">' +
			'<input type="text"  size="30"  name="tatekaename[]" value="" ondblclick="javascript:refertatekae_hinmokuButton(' +
			"'tatekae_select_list','" + $baseUrl + "/ajax/tatekaehinmokudai','" +
			$baseUrl + "/ajax/tatekaehinmokuchu','" +
			$baseUrl + "/ajax/tatekaehinmokusyo');" + '"></td>';
		cell[2].setAttribute("class", "j3 tl");
		cell[3].innerHTML = '<td class="j4 tl hide_out"><input type="text" size="30"  name="tatekaename[]" value=""></td>';
		cell[3].setAttribute("class", "j4 tl hide_out");
		cell[4].innerHTML = '<td class="j5 tc hide_out"><input type="text" size="1"  name="tatekaename[]" value="" onkeyup="javascript:set_tatekae_kingaku(1);" class="znkk2"></td>';
		cell[4].setAttribute("class", "j5 tc hide_out");
		cell[5].innerHTML = '<td class="j6 tr hide_out">' +
			'<select class="selectbox1"  name="tatekaename[]">' +
			optionstr +
			'</select>' +
			'</td>';
		cell[5].setAttribute("class", "j6 tr hide_out");
		cell[6].innerHTML = '<td class="j7 tr hide_out"><input type="text" size="10"  name="tatekaename[]" value=""  onkeyup="javascript:set_tatekae_kingaku(1);" class="znkk2"></td>';
		cell[6].setAttribute("class", "j7 tr hide_out");
		cell[7].innerHTML = '<td class="j8 tr hide_out"><input type="text" size="10"  name="tatekaename[]" value="" disabled ></td>';
		cell[7].setAttribute("class", "j8 tr hide_out");
		cell[8].innerHTML = '<td class="j9 tr hide_out"></td>';
		cell[8].setAttribute("class", "j9 tr hide_out");
		cell[9].innerHTML = '<td class="g1 tl hide_area">' +
			'<input type="hidden"  name="tatekaename[]" value="">' +
			'<input type="text" size="10"  name="tatekaename[]" value="" ondblclick="javascript:refergaichusakiButton(' +
			"'select-gaichu','select-gaichu-form','" + $baseUrl + "/ajax/gaichu','2');" + '"></td>';
		cell[9].setAttribute("class", "g1 tl hide_area");
		cell[10].innerHTML = '<td class="g2 tl hide_area"><input type="text" size="30"  name="tatekaename[]" value=""></td>';
		cell[10].setAttribute("class", "g2 tl hide_area");
		cell[11].innerHTML = '<td class="g3 tc hide_area"><input type="text" size="1"  name="tatekaename[]" value="" onkeyup="javascript:set_tatekae_kingaku(2);" class="znkk2"></td>';
		cell[11].setAttribute("class", "g3 tc hide_area");
		cell[12].innerHTML = '<td class="g4 tr hide_area">' +
			'<select class="selectbox1"  name="tatekaename[]">' +
			optionstr +
			'</select>' +
			'</td>';
		cell[12].setAttribute("class", "g4 tr hide_area");
		cell[13].innerHTML = '<td class="g5 tr hide_area"><input type="text" size="10"  name="tatekaename[]" value=""  onkeyup="javascript:set_tatekae_kingaku(2);" class="znkk2"></td>';
		cell[13].setAttribute("class", "g5 tr hide_area");
		cell[14].innerHTML = '<td class="g6 tr hide_area"><input type="text" name="tatekaename[]" size="10" value="" disabled></td>';
		cell[14].setAttribute("class", "g6 tr hide_area");
		cell[15].innerHTML = '<td class="g7 tc gray hide_area"><input type="text" size="10"  name="tatekaename[]" onfocus="javascript:dateDialog(this,0);"  value="" disabled="disabled"></td>';
		cell[15].setAttribute("class", "g7 tc gray hide_area");
		cell[16].innerHTML = '<td class="g8 tc gray hide_area">' +
			'<button type="button" disabled="disabled"><i class="fa fa-print"></i>印刷</button>&nbsp;' +
			'<select  class="selectbox1"  name="tatekaename[]" disabled="disabled">' +
			'<option value="0" label="未発行" selected>未発行</option>' +
			'<option value="1" label="発行済">発行済</option>' +
			'<option value="2" label="専用">専用</option>' +
			'</select>' +
			'</td>';
		cell[16].setAttribute("class", "g8 tc gray hide_area");
		cell[17].innerHTML = '<td class="g9 tc gray hide_area"><input type="text" size="10"   name="tatekaename[]" onfocus="javascript:dateDialog(this,0);" value="" disabled="disabled"></td>';
		cell[17].setAttribute("class", "g9 tc gray hide_area");
		cell[18].innerHTML = '<td class="g10 tc hide_area"><input type="text" size="10"   name="tatekaename[]" onfocus="javascript:dateDialog(this,0);" value=""></td>';
		cell[18].setAttribute("class", "g10 tc hide_area");
		//
		if ($insert_update_sw == 1) {
			cell[19].innerHTML = '<td class="g11 tc gray hide_area"><input type="text" size="10"  name="tatekaename[]" onfocus="javascript:dateDialog(this,0);"  value=""disabled="disabled">' +
				' ～ <input type="text" size="10"   name="tatekaename[]" onfocus="javascript:dateDialog(this,0);" value=""disabled="disabled">' +
				'<input type="hidden" name="tatekaename[]" value="" ><input type="hidden" name="tatekaename[]" value="" ><input type="hidden" name="tatekaename[]" value="" >' +
				'<input type="hidden" name="tatekaename[]" value="" ><input type="hidden" name="tatekaename[]" value="" >' +
				'</td>';
		} else {
			cell[19].innerHTML = '<td class="g11 tc gray hide_area"><input type="text" size="10"  name="tatekaename[]" onfocus="javascript:dateDialog(this,0);"  value=""disabled="disabled">' +
				' ～ <input type="text" size="10"   name="tatekaename[]" onfocus="javascript:dateDialog(this,0);" value=""disabled="disabled"></td>';
		}
		cell[19].setAttribute("class", "g11 tc gray  hide_area");
	}
	//カレント行の設定
	table.rows[rINX].className = '';
	table.rows[rINX + 1].className = 'active';
	rINX = rINX + 1;

	//物件がどちらの状態かで判断
	//$disply_typeで判定
	width_T($disply_type);
	$(function () {
		$('.znkk2')
			.on('keyup', zenkakuConvertWithOutComma);
	});
	$(function () {
		$('.znkk')
			.on('keyup', zenkakuConvert);
	});
}
function selectDialog(title) {
	$("#jyuchu-select").dialog({
		modal: true,
		title: '<i class="fa fa-search"></i>' + title,
		height: "auto",
		width: 600,
		close: function () {
		}
	});
}
/*
* パスワード変更
*/
function systemDialog() {
	$("#tab_dialog-form").dialog({
		modal: true,
		title: "パスワード変更",
		height: "auto",
		width: 500,
		close: function () {
		}
	});
}
/**
* 行削除 物件情報での行削除
*/
function delete_bukken_Row(type) {
	if (type == 0) {
		if ($jyuchu_table == 0) {
			id = "jyuchu";
		} else id = "tatekae";
	}
	rmax = getRowNum(id) - 2;

	if (!rINX || (rINX == '0') || (rINX > rmax)) {
		//window.confirm('削除する行を選択してください');
		errorConfirmDialog('0000', 1);
		return false;
	}

	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	justConfirmDialog('本当に削除しますか？', function () {
		var table = document.getElementById(id);
		var rw = rINX;
		if (rINX != 1) {
			//削除後に追加する
			table.deleteRow(rw);
			rINX = rINX - 1;
			insertRow(1);
		} else {
			//先頭のため追加後に削除する
			insertRow(1);
			table.deleteRow(rw);
		}
		rINXtmp = rINX;
		tmpjyuchu = $jyuchu_table;

		//削除後の再計算
		if ($jyuchu_table == 0) {
			//受注の小計設定
			set_jyuchu_syokei();

			//外注の小計設定
			set_gaichu_syokei();
		} else {
			//立替金の受注の小計設定
			set_tatekae_jyuchu_syokei();

			//立替金の外注の小計設定
			set_tatekae_gaichu_syokei();
		}
		rINX = rINXtmp;
		$jyuchu_table = tmpjyuchu;

		return true;
	})
}
/**
* 行削除 一覧での処理
*/
function deleteRow(id, type) {
	if (!rINX || rINX == '0') {
		//window.confirm('削除する行を選択してください');
		errorConfirmDialog('0000', 1);

		return false;
	}
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	justConfirmDialog('本当に削除しますか？', function () {
		var tbl = document.getElementById('tbody_ichiran');
		var delKeys = null;
		delKeys = tbl.rows[rINX - 1].cells[tbl.rows[rINX - 1].cells.length - 1].textContent;	//rINX行目の最終行のセルを取得
		document.forms['delete-form'].elements['delete-key'].value = delKeys;
		do_submit('delete-form'); // 更新処理 へジャンプ(tplのフォームのサブミット)
	})
}
function Toggle(id, mojiid) {
	div = document.getElementById(id);
	var sw = div.style.display;
	$('.hide_out').show();
	$('.hide_area').show();
	if (sw == "none") {
		div.style.display = "block";
		document.getElementById(mojiid).innerHTML = '<i class="fa fa-minus-square fa-lg"></i>';
		width_T("all");
		$('.hide_area').show();
	}
	if (sw == "block") {
		div.style.display = "none";
		document.getElementById(mojiid).innerHTML = '<i class="fa fa-plus-square fa-lg"></i>';
		width_T("jyuchu");
		$('.hide_area').hide();
	}
}
function width_T(type) {
	$('a', '#tab').removeClass('active').siblings('.' + type).addClass('active');
	$disply_type = type;
	if (type == "jyuchu") {
		document.getElementById("container").style.width = "800px";
		document.getElementById("jyuchu").style.width = "800px";
		document.getElementById("tatekae").style.width = "800px";
		erase('.hide_area');
	} else if (type == "gaichu") {
		document.getElementById("container").style.width = "1200px";
		document.getElementById("jyuchu").style.width = "1200px";
		document.getElementById("tatekae").style.width = "1200px";
		erase('.hide_out');
	} else if (type == "all") {
		document.getElementById("container").style.width = "2000px";
		document.getElementById("jyuchu").style.width = "2000px";
		document.getElementById("tatekae").style.width = "2000px";
	}
	goukei_reposition();
}
/***
*  date クリア
***/
function date_clr(obj) {
	$("#" + obj).val("");
}
/***
*  dateクラスで3か月カレンダ　　i18nの日本語を設定
***/
function date_picker() {
	// 2日本語を有効化
	$.datepicker.setDefaults($.datepicker.regional['ja']);
	// 3日付選択ボックスを生成
	$('.date').datepicker({
		/*****/
		numberOfMonths: 3,  //3か月表示
		onClose: function (date, obj) {
		},
		/***
		showButtonPanel: true,
		closeText: 'キャンセル',
		currentText: '今日',
		***/
		dateFormat: 'yy/mm/dd'
		/*****/
	});
	$('.date_button').datepicker({
		/*****/
		numberOfMonths: 3,  //3か月表示
		onClose: function (date, obj) {
		},
		showOn: 'both',
		buttonText: 'カレンダー表示',
		dateFormat: 'yy/mm/dd'
		/*****/
	});
}
function do_submit(obj) {
	document.forms[obj].submit();
}
function do_reset(obj) {
	document.forms[obj].reset();
}
/**
* 行複写
*/
function copyRow(id, type) {
	var sw = copyDisp();
	if (sw) {
		// テーブル取得
		//仮の設定で 今後他の共通で変更
		if (type == 0) {
			if ($edit_table == 0) {
				id = "edit1";
			} else id = "edit2";
		}
		var table = document.getElementById(id);
		var rw = rINX;
	}
}
function copyDisp() {
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	//window.confirm(rINX);
	if (!rINX || rINX == '0') {
		//window.confirm('複写する行を選択してください');
		errorConfirmDialog('0000', 2);

		return false;
	}
	justConfirmDialog('複写しますか？', function () {
		var tbl = document.getElementById('tbody_ichiran');
		var copyKey = null;
		copyKey = tbl.rows[rINX - 1].cells[tbl.rows[rINX - 1].cells.length - 1].textContent;	//rINX行目の最終行のセルを取得
		document.forms['copy-form'].elements['copy-key'].value = copyKey;
		do_submit('copy-form'); // 更新処理 へジャンプ(tplのフォームのサブミット)
	})
}

/**
* 移管複写
*/
function ikanRow(id, type) {
	var sw = ikanDisp();
	if (sw) {
		// テーブル取得
		//仮の設定で 今後他の共通で変更
		if (type == 0) {
			if ($edit_table == 0) {
				id = "edit1";
			} else id = "edit2";
		}
		var table = document.getElementById(id);
		var rw = rINX;
	}
}

function ikanDisp() {
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	//window.confirm(rINX);
	if (!rINX || rINX == '0') {
		errorConfirmDialog('0000', 8);

		return false;
	}
	justConfirmDialog('移管しますか？', function () {
		var tbl = document.getElementById('tbody_ichiran');
		var ikanKey = null;
		ikanKey = tbl.rows[rINX - 1].cells[tbl.rows[rINX - 1].cells.length - 1].textContent;	//rINX行目の最終行のセルを取得
		document.forms['ikan-form'].elements['ikan-key'].value = ikanKey;
		do_submit('ikan-form'); // 更新処理 へジャンプ(tplのフォームのサブミット)
	})
}


/***
*  得意先ダイアログ
***/

function refertokuisakiButton(obj, formname, url) {
	referTokuisakiDialog(obj, formname, 1, url);
}
function referTokuisakiDialog(obj, formname, type, url) {
	var kiten = '#pos';
	var itiran = '#tokuisaki_itiran_1';

	$("#" + obj).dialog({
		autoOpen: true,
		width: 1500,
		height: "auto",
		title: '<i class="fa fa-search"></i>得意先一覧',
		position: {
			of: '#header',              //基点
			at: 'center bottom',    //基点要素の位置
			my: 'center'        //自分自身の位置
		},
		modal: true,
		open: function (event) {
			$('#tokuisaki_item0').val($('#select_item6').val());
			ajax_func(type, url);
		},
		close: function () {
		}

	});
}
/***
*  請求先ダイアログ
***/
function referseikyusakiButton(obj, formname, url) {
	referSeikyusakiDialog(obj, formname, 1, url);
}
function referSeikyusakiDialog(obj, formname, type, url) {
	var kiten = '#pos';
	var itiran = '#seikyusaki_itiran_1';

	$("#" + obj).dialog({
		autoOpen: true,
		width: 1500,
		height: "auto",
		title: '<i class="fa fa-search"></i>請求先一覧',
		position: {
			of: '#header',              //基点
			at: 'center bottom',    //基点要素の位置
			my: 'center'        //自分自身の位置
		},
		modal: true,
		open: function (event) {
			$('#seikyusaki_item0').val($('#select_item7').val());
			ajax_func_seikyu(type, url);	// Ajaxでサーバからデータを取得し、TABLEに追加していきます。ここではサンプルを表示するのみですので省略します。
		},
		close: function () {
		}
	});
}
/***
*  外注先ダイアログ
*  flg=1:受注・外注明細 外注
*  flg=2:受注・外注 立替金 外注
***/
function refergaichusakiButton(obj, formname, url, flg) {
	referGaichusakiDialog(obj, formname, 1, url, flg);
}
function referGaichusakiDialog(obj, formname, type, url, flg) {
	var kiten = '#pos';
	var itiran = '#gaichusaki_itiran_1';
	tmpjyuchu = $jyuchu_table;
	tmprINX = rINX;
	//Kimura Add START
	var gidx = 0;
	var gn_idx = 0;
	var item_num = 0;
	gaichuflg = flg;
	if (flg == '1') {					//明細 受注 外注
		gn_idx = JYUCHUNAME_GAICHUID;	//明細 受注 外注先ID 配列番号
		item_num = NAME_SUU;			//明細 受注 外注の全項目数

	} else {								//明細 立替金 外注
		gn_idx = TATEKAENAME_GAICHUID;	//明細 立替金 外注先ID 配列番号
		item_num = TATEKAENAME_SUU;		//立替金の全項目数
	}
	gidx = gn_idx + ((rINX - 1) * item_num);
	//Kimura Add END
	gaichugidx = gidx;
	$("#" + obj).dialog({
		autoOpen: true,
		width: 1500,
		height: "auto",
		title: '<i class="fa fa-search"></i>外注先一覧',
		position: {
			of: '#header',              //基点
			at: 'center bottom',    //基点要素の位置
			my: 'center'        //自分自身の位置
		},
		modal: true,
		open: function (event) {
			//Kimura Add START
			$('#gaichusaki_item0').val($('#Bk_DenG_0_gyo_name[0]').val());
			ajax_func_gaichu(type, url);	// Ajaxでサーバからデータを取得し、TABLEに追加していきます。ここではサンプルを表示するのみですので省略します。
			//Kimura Add END
		},
		close: function () {
			$jyuchu_table = tmpjyuchu;
			rINX = tmprINX;
		}

	});
}

/** 売上エクスポート用ダイアログここから **/
/** 単月指定するほう */
function selectExportDialog(title) {
	$("#export-select").dialog({
		modal: true,
		title: '<i class="fa fa-print"></i>' + title,
		height: "auto",
		width: 600,
		close: function () {
		}
	});
}
/**複数月指定するほう ここから*/
function selectExport2MonthDialog(title, action) {
	$("#export-select-2Month").dialog({
		modal: true,
		title: '<i class="fa fa-print"></i>' + title,
		height: "auto",
		width: 600,
		open: function (event) {
			//ダイアログを開くタイミングでアクションの書き換え
			//document.getElementById("export_dialog_form").setAttribute("action",action);
			$("#export_2Month_dialog_form").attr('action', action);
		},
		close: function () {
		}
	});
}
function today_2Month() {
	var date = new Date();
	var format = 'YYYY/MM';
	format = format.replace(/YYYY/g, date.getFullYear());
	format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
	$("#export_select_2Month_item0").val(format);
	$("#export_select_2Month_item13").val(format);

}
function exportSubmit_2month() {
	//0埋め
	var count = $("#export_select_2Month_item0").val().length;
	if (count == 9) {
		$("#export_select_2Month_item0").val($("#export_select_2Month_item0").val() + '1');

	} else if (count == 7) {
		$("#export_select_2Month_item0").val($("#export_select_2Month_item0").val() + '/01')
	}

	var count2 = $("#export_select_2Month_item13").val().length;
	if (count2 == 9) {
		$("#export_select_2Month_item13").val($("#export_select_2Month_item13").val() + '1');

	} else if (count2 == 7) {
		$("#export_select_2Month_item13").val($("#export_select_2Month_item13").val() + '/01')
	}

	do_submit('export_2Month_dialog');

}
/**複数月指定するほう ここまで*/
/**
*	日付ダイアログのキャンセル処理
*/
function cancel_date() {
	data_exe_sw = 0;
	$("#date-select-dialog").dialog("close");
}
/**
*	日付ダイアログの入力処理
*/
function input_date() {
	data_exe_sw = 1;
	yyyy = $('select[name="select_yyyy"]').val();
	mm = $('select[name="select_mm"]').val();
	dd = $('select[name="select_dd"]').val();
	$('#hidden_date').val(yyyy + '/' + mm + '/' + dd);
	$("#date-select-dialog").dialog("close");
}
/**
*	日付ダイアログのカレンダー処理
*/
function change_date() {
	data_exe_sw = 0;
	ymd = $('#hidden_date').val();

	setSelectDate(ymd);
}
/*
*  設定された請求日からの取引条件の取得
*  ymd  :  設定された年月日（請求日）
*/
function get_torihiki(ymd) {
	kekka = separateDate(ymd);
	mm = $('input[name="torihiki_pay_month"]').val();
	dd = $('input[name="torihiki_pay_date"]').val();
	if ($('input[name="torihiki_cut_date"]').val() < Number(kekka[2]) && $('input[name="torihiki_cut_date"]').val() != "") {
		ymd = set_nextMonth_yyyymmdd(Number(kekka[0]), Number(kekka[1]), Number(kekka[2]), 1);
		kekka = separateDate(ymd);
		mm = $('input[name="torihiki_pay_month"]').val();
		dd = $('input[name="torihiki_pay_date"]').val();
	}

	switch (mm) {
		case '当月':
			date = ymd;
			break;
		case '翌月':
			date = set_nextMonth_yyyymmdd(Number(kekka[0]), Number(kekka[1]), Number(kekka[2]), 1);
			break;
		case '翌々月':
			date = set_nextMonth_yyyymmdd(Number(kekka[0]), Number(kekka[1]), Number(kekka[2]), 2);
			break;
		default:
			date = "";
			return date;
			break;
	}
	kekka = separateDate(date);
	ddtmp = 0;
	switch (dd) {
		case "末":
			ddtmp = getMonthEndDay(Number(kekka[0]), Number(kekka[1]));
			break;
		case "":
			ddtmp = Number(kekka[2]);
			break;
		default:
			ddtmp = (getMonthEndDay(Number(kekka[0]), Number(kekka[1])) >= Number(dd)) ? Number(dd) : getMonthEndDay(Number(kekka[0]), Number(kekka[1]));
			break;
	}
	//00でパディング
	m = ("00" + kekka[1]).substr(-2);
	d = ("00" + ddtmp).substr(-2);

	date = kekka[0] + '/' + m + '/' + d;
	return date;
}
/**
*  	inputによる日付入力ダイアログ
*      target : フィールド名　this
*      type   : 対象種別
*               0  yyyy/mm/dd
*               1  yyyy/mm
*/
function dateDialog(target, type) {
	data_exe_sw = 0;
	var to = $(target).offset();
	//var pos = [to.left,to.top];
	var pos = [to.center, to.top];
	setSelectDate($(target).val());
	$("#date-select-dialog").dialog({
		modal: true,
		title: "日付入力",
		height: "auto",
		position: pos,
		width: 'auto',
		open: function () {
			$(target).find('input').blur();
		},
		close: function () {
			//入力ボタンのときに設定
			if (data_exe_sw == 1) {
				d1 = $('#hidden_date').val();
				kekka = separateDate(d1);
				clrsw = 0;
				if (kekka[0] == '0') {
					//クリアの時
					clrsw = 1;  //クリアの場合
					$('#hidden_date').val("");
				} else {
					if (type == 1) {
						$('#hidden_date').val(kekka[0] + "/" + kekka[1]);
					}
				}
				$(target).val($('#hidden_date').val());
				switch (type) {
					case 31:  //納品予定日から請求集計月
						//納品日があればそちらを優先
						tmp = $('input[name="den_date1"]').val();
						if (tmp != "") {
							kekka = separateDate(tmp);
							$('input[name="dt_sy"]').val(kekka[0] + "/" + kekka[1]);
						} else {
							if (clrsw == 1) {
								$('input[name="dt_sy"]').val("");
							} else {
								$('input[name="dt_sy"]').val(kekka[0] + "/" + kekka[1]);
							}
						}
						break;
					case 32:  //納品日から請求集計月
						if (clrsw == 0) {
							$('input[name="dt_sy"]').val(kekka[0] + "/" + kekka[1]);
							//ajaxで売上noを取得
							var urino = ajax_func_uriage();
							$('input[name="sales_no"]').val(urino);  //ajaxで売上noを取得
						} else {
							tmp = $('input[name="den_noy"]').val();
							if (tmp != "") {
								kekka = separateDate(tmp);
								$('input[name="dt_sy"]').val(kekka[0] + "/" + kekka[1]);
							} else {
								$('input[name="dt_sy"]').val("");
							}
							$('input[name="sales_no"]').val("");
						}
						break;
					case 4:  //請求から入金予定日　条件を加味する
						//d1の値からの取引条件で設定する
						tmp = get_torihiki(d1);
						if (tmp == "") {
							//$('input[name="dt_nyy"]').val(d1) ;
						} else {
							$('input[name="dt_nyy"]').val(tmp);
						}
						break;
					case 5:
						setCheckboxMinyukin();
						break;
				}
			}
		}
	});
}
/**
*  	buttonによる日付入力ダイアログ
*      target : フィールド名　this
*      type   : 対象種別
*               0  yyyy/mm/dd
*               1  yyyy/mm
*      kubetu: 1 受注
*              2 外注
*      id     : 設定するinputタグのid名
*/
function datebuttonDialog(target, type, kubetu, id) {
	data_exe_sw = 0;
	var to = $(target).offset();
	var pos = [to.center, to.top];

	var yymmdd = $('#' + id).val() == null ? "" : $('#' + id).val();

	setSelectDate(yymmdd);

	$("#date-select-dialog").dialog({
		modal: true,
		title: "日付入力",
		height: "auto",
		position: pos,
		width: 'auto',
		open: function () {
			$("#" + id).find('input').blur();
		},
		close: function () {
			//入力ボタンのときに設定
			if (data_exe_sw == 1) {
				d1 = $('#hidden_date').val();
				kekka = separateDate(d1);

				if (kekka[0] == '0') {
					$('#hidden_date').val("");
				} else {
					if (type == 1) {
						$('#hidden_date').val(kekka[0] + "/" + kekka[1]);
					}
				}
				$('#' + id).val($('#hidden_date').val());
				//日の設定
				if (kubetu == 1) {
					set_ikkatu_jyuchu(id);
				} else {
					set_ikkatu_gaichu(id);
				}
			}
		}
	});
}
/**
* 日付の妥当性チェック
* year 年
* month 月
* day 日
*/
function checkDate(year, month, day) {
	var dt = new Date(year, month - 1, day);
	if (dt == null || dt.getFullYear() != year || dt.getMonth() + 1 != month || dt.getDate() != day) {
		return false;
	}
	return true;
}
/*
* セレクトに設定
*/
function setSelectDate(date) {
	//カレンダー用に設定
	$('#hidden_date').val(date);
	kekka = separateDate(date);

	$('select[name="select_yyyy"]').val(kekka[0]);
	$('select[name="select_mm"]').val(kekka[1]);
	$('select[name="select_dd"]').val(kekka[2]);

}
/******************************
*	一括受注　関数
******************************/
/*
*一括検索条件のすべてのときの設定
*/
function setCheckbox() {
	$('.td_type_check input[type="checkbox"]').each(function () {
		if ($('#checkbox07').attr("checked") == "checked") {
			$(this).prop("checked", true);
		}
		else {
			$(this).prop("checked", false);
		}
	});
}
/*
入金予定日を設定すると未入金チェックボックスが消える処理
*/
function setCheckboxMinyukin() {
	if ($('input[name=search_name21').val() != "") {
		$('#checkbox10').prop("checked", false);
	}

}
/*
未入金チェックボックスを操作すると入金予定日が消える処理
*/
function setClearedNyy() {
	$('input[name=search_name21').val("");
}
/*
*実行に渡すパラメータ
*/
function setHiddenValue(kubetu) {
	if (kubetu == 1) {  //受注一括
		$('input,select').each(function () {
			var dom = $(this)[0];
			if (dom.name == "jyuchuikkatuname2[]") {
				dom.form.removeChild(dom);
			}
		});
		$('input,select').each(function () {
			var dom = $(this)[0];
			if (dom.name == "jyuchuikkatuname[]") {
				var q = document.createElement('input');
				q.type = 'hidden';
				q.name = 'jyuchuikkatuname2[]';
				q.value = dom.value
				dom.form.appendChild(q);
			}
		});
	} else {  //外注一括
		$('input,select').each(function () {
			var dom = $(this)[0];
			if (dom.name == "gaichuikkatuname2[]") {
				dom.form.removeChild(dom);
			}
		});

		$('input,select').each(function () {
			var dom = $(this)[0];
			if (dom.name == "gaichuikkatuname[]") {
				var q = document.createElement('input');
				q.type = 'hidden';
				q.name = 'gaichuikkatuname2[]';
				q.value = dom.value
				dom.form.appendChild(q);
			}
		});
	}
}
/*
*一括の更新の実行
*/
function ikkatu_submit(kubetu, name, action) {
	$("#" + name).attr('action', action);
	setHiddenValue(kubetu);
	if (kubetu == 1) {
		jyuchu_ikkatu_select(name);
	} else if (kubetu == 2) {
		gaichu_ikkatu_select(name);
	}
}
/*
*一括での検索の実行
*/
function ikkatu_submit_search(kubetu, name, action) {
	$("#" + name).attr('action', action);
	if (kubetu == 1) {
		jyuchu_ikkatu_select(name);
	} else {
		gaichu_ikkatu_select(name);
	}
}
/*
*一括受注で最初に呼び出す
*/
function removeDownload() {
	$('form,iframe').each(function () {
		var dom = $(this)[0];
		if (String(dom.name).indexOf("download") != -1 || String(dom.name).indexOf("target") != -1) {
			//dom.parentNode.removeChild(dom);
			dom.style.display = "none";
		}
	});
}
/*
*  一括受注でのすべての項目をチェック
*/
function set_ikkatu_jyuchu_checkon() {
	//checkbox_asの項目をon
	//checkbox_adの項目はoff
	$('#checkbox_as').prop("checked", true);
	$('#checkbox_ad').prop("checked", false);
	set_ikkatu_jyuchu_check(true);
}
/*
*  一括受注でのすべての項目をチェック解除
*/
function set_ikkatu_jyuchu_checkoff() {
	//checkbox_asの項目をoff
	//checkbox_adの項目はon
	$('#checkbox_as').prop("checked", false);
	$('#checkbox_ad').prop("checked", true);
	set_ikkatu_jyuchu_check(false);
}/*
*テーブルのcheckedをON、OFFに設定
*/
function set_ikkatu_jyuchu_check(sw) {
	rw = getRowNum("jyuchuikkatu");
	idx = 0;
	for (i = 3; i <= rw; i++) {
		document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 3].checked = sw;
		idx += IKKATU_NAME_SUU;
	}

}
/*
* 	一括のヒットによる日の設定（一括受注一覧から操作）
*/
function set_ikkatu_jyuchu(id) {
	rw = getRowNum("jyuchuikkatu");
	idx = 0;
	switch (id) {
		case "nouhinyotei":
			idx2 = 0;
			break;
		case "nouhin":
			idx2 = 2;
			break;
		case "seikyu":
			idx2 = 4;
			break;
		case "seikyuhasou":
			idx2 = 6;
			break;
		case "seikyuprint":
			idx2 = 9;
			break;
		case "nyukin":
			idx2 = 12;
			break;
	}

	for (i = 3; i <= rw; i++) {
		checksw = document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 3].checked;
		//seikyusw = document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx+13].value;
		seikyusw = document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 14].value;
		yyyymmdd = document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx2 + 5].value;

		if (id != "seikyuprint") {
			//if(checksw && (seikyusw == 0) && (yyyymmdd == "")) {
			//if(checksw && (yyyymmdd == "")) {   //請求書印刷の状態は無視してセットできるようにしてほしいとの要望
			if (checksw) {   //入力済みでも上書きで日付をセットできるようにしてほしいとの要望
				document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx2 + 4].value =
					document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx2 + 5].value;
				document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx2 + 5].value =
					$('#' + id).val();
			}

			idx += IKKATU_NAME_SUU;
			idx2 += IKKATU_NAME_SUU;
		}
	}
}

/*
*取消ボタンの日の取消（一括受注一覧から操作）
*すべてを取り消す
*/
function reset_ikkatu_jyuchu(id) {
	switch (id) {
		case "nouhinyotei":
			idx = 0;
			break;
		case "nouhin":
			idx = 2;
			break;
		case "seikyu":
			idx = 4;
			break;
		case "seikyuhasou":
			idx = 6;
			break;
		case "seikyuprint":
			idx = 9;
			break;
		case "nyukin":
			idx = 12;
			break;
	}
	if (id != "seikyuprint") {
		rw = getRowNum("jyuchuikkatu");

		for (i = 3; i <= rw; i++) {
			document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 5].value =
				document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 4].value;
			idx += IKKATU_NAME_SUU;
		}
	}
}
/*
* 一括のenter制御
*/
function jyuchu_ikkatu_select(formname) {
	do_submit(formname);
}
/*
* 一括のenter制御
*/
function gaichu_ikkatu_select(formname) {
	do_submit(formname);
}
/*
*  	請求書印刷
*      kubetu : 1  ヒット（未発行）
*               2  取消（基の値）
*/
function set_seikyuprint(kubetu) {
	rw = getRowNum("jyuchuikkatu");
	idx = 0;

	for (i = 3; i <= rw; i++) {
		checksw = document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 3].checked;
		if (checksw) {
			if (kubetu == 1 && document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 14].value != 2) {   //未発行
				document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 13].value =
					document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 14].value;
				document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 14].value = 0;
			} else {  //取消で基に戻す
				document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 14].value =
					document.ikkatu_jyuchu_update_form.elements['jyuchuikkatuname[]'][idx + 13].value;
			}
		}
		idx += IKKATU_NAME_SUU;
	}
}
/******************************
*	一括外注　関数
*******************************/
/*
* 	一括のヒットによる日の設定（一括外注一覧から操作）
*/
function set_ikkatu_gaichu(id) {
	rw = getRowNum("gaichuikkatu");
	checksw = false;
	yyyymmdd = "";

	idx = 0;
	switch (id) {
		case "seikyuhensou":
			idx2 = 0;
			break;
		case "siharai":
			idx2 = 2;
			break;
	}

	for (i = 2; i <= rw; i++) {
		checksw = document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx + 4].checked;
		yyyymmdd = document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx2 + 6].value;
		if ($('#gaichuikkatu')[0].rows[i - 1].cells[4].innerHTML == "立替金" && id == "seikyuhensou") {// 外注の立替金のときは請書返送日はセットできないため飛ばす
			idx += IKKATU_NAME_GAICHU_SUU;
			idx2 += IKKATU_NAME_GAICHU_SUU;
			continue;
		}
		//		if(checksw && (yyyymmdd == "")) {
		if (checksw) {

			document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx2 + 5].value =
				document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx2 + 6].value;
			document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx2 + 6].value =
				$('#' + id).val();
		}
		idx += IKKATU_NAME_GAICHU_SUU;
		idx2 += IKKATU_NAME_GAICHU_SUU;
	}
}
/*
*取消ボタンの日の取消（一括外注一覧から操作）
*すべてを取り消す
*/
function reset_ikkatu_gaichu(id) {
	switch (id) {
		case "seikyuhensou":
			idx = 0;
			break;
		case "siharai":
			idx = 2;
			break;
	}
	rw = getRowNum("gaichuikkatu");
	for (i = 2; i <= rw; i++) {
		document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx + 6].value =
			document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx + 5].value;
		idx += IKKATU_NAME_GAICHU_SUU;
	}
}
/*
*  一括外注でのすべての項目をチェック
*/
function set_ikkatu_gaichu_checkon() {
	//checkbox_asの項目をon
	//checkbox_adの項目はoff
	$('#checkbox_as').prop("checked", true);
	$('#checkbox_ad').prop("checked", false);
	set_ikkatu_gaichu_check(true);
}
/*
*  一括外注でのすべての項目をチェック解除
*/
function set_ikkatu_gaichu_checkoff() {
	//checkbox_asの項目をoff
	//checkbox_adの項目はon
	$('#checkbox_as').prop("checked", false);
	$('#checkbox_ad').prop("checked", true);
	set_ikkatu_gaichu_check(false);
}
/*
*テーブルのcheckedをON、OFFに設定
*/
function set_ikkatu_gaichu_check(sw) {
	rw = getRowNum("gaichuikkatu");
	idx = 0;
	for (i = 2; i <= rw; i++) {
		dissw = document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx + 3].value;

		//if ( dissw != 1 ) { サーバーから帰ってくるチェック可否の条件は無視するように改修
		document.ikkatu_gaichu_update_form.elements['gaichuikkatuname[]'][idx + 4].checked = sw;
		//}
		idx += IKKATU_NAME_GAICHU_SUU;
	}

}
/*********************/
/*
*  今日処理
*/
function setDay() {
	d = getDay();
	$('#hidden_date').val(d);
	setSelectDate(d);
}
/**
* 今日を求める関数
*/
function getDay() {
	var now = new Date();
	var y = now.getFullYear();
	var m = now.getMonth() + 1;
	var d = now.getDate();
	//00でパディング
	m = ("00" + m).substr(-2);
	d = ("00" + d).substr(-2);

	date = y + '/' + m + '/' + d;

	return date;
}
/*
* 月末処理
*/
function set_finalDay_yyyymmdd(y, m) {
	var d = getMonthEndDay(y, m);

	//00でパディング
	m = ("00" + m).substr(-2);
	d = ("00" + d).substr(-2);

	date = y + '/' + m + '/' + d;

	return date;
}
/*
* 翌月,翌々月など処理
*   addmm :  加算月数
*/
function set_nextMonth_yyyymmdd(yy, mm, dd, addmm) {
	var ymd = computeMonth(yy, mm, dd, addmm);

	y = ymd.getFullYear();
	m = ymd.getMonth() + 1;
	d = ymd.getDate();

	//00でパディング
	m = ("00" + m).substr(-2);
	d = ("00" + d).substr(-2);

	date = y + '/' + m + '/' + d;

	return date;
}
/*
* 月末処理 (ダイアログ内ボタンでの処理)
*/
function set_finalDay() {
	var now = new Date();
	var y = now.getFullYear();
	var m = now.getMonth() + 1;

	date = set_finalDay_yyyymmdd(y, m);
	$('#hidden_date').val(date);
	setSelectDate(date);
}
/*
* 翌月処理 (ダイアログ内ボタンでの処理)
*/

function set_nextMonth() {
	var now = new Date();
	var y = now.getFullYear();
	var m = now.getMonth() + 1;
	var d = now.getDate();

	date = set_nextMonth_yyyymmdd(y, m, d, 1);
	$('#hidden_date').val(date);
	setSelectDate(date);
}
/**
* 年月を指定して月末日を求める関数
* year 年
* month 月
*/
function getMonthEndDay(year, month) {
	//日付を0にすると前月の末日を指定したことになります
	//指定月の翌月の0日を取得して末日を求めます
	//そのため、ここでは month - 1 は行いません
	var dt = new Date(year, month, 0);
	return dt.getDate();
}
/**
* 年月日と加算月からnヶ月後、nヶ月前の日付を求める
* year 年
* month 月
* day 日
* addMonths 加算月。マイナス指定でnヶ月前も設定可能
*/
function computeMonth(year, month, day, addMonths) {
	month += addMonths;
	var endDay = getMonthEndDay(year, month);//ここで、前述した月末日を求める関数を使用します
	if (day > endDay) day = endDay;
	var dt = new Date(year, month - 1, day);
	return dt;
}
/*
*	yyyy/mm/ddに分離する
*/
function separateDate(date) {
	separete = date.split("/");
	return separete;
}
/*
*和暦変換（今後のために）
*/
function setJapaneseDate(idval) {
	source = $(idval).val();
	kekka = source.split("/");
	if (kekka[0] > 1988) {
		s = "平成" + (kekka[0] - 1988) + "年";
	} else if (kekka[0] > 1925) {
		s = "昭和" + (kekka[0] - 1925) + "年";
	} else if (kekka[0] > 1911) {
		s = "大正" + (kekka[0] - 1911) + "年";
	} else if (kekka[0] > 1867) {
		s = "明治" + (kekka[0] - 1867) + "年";
	}
	//document.getElementById(idval).value= s+kekka[1]+"月"+kekka[2]+"日";
	$(idval).val(s + kekka[1] + "月" + kekka[2] + "日");
}
/**********************************/
/*
*
*/
function set_hinmoku_url(baseurl) {
	$baseUrl = baseurl;
}
/**
* 	受注品目ダイアログ
*
*/
function referjyuchu_hinmokuButton(obj, url1, url2, url3) {
	jyuchu_hinmokuDialog(obj, url1, url2, url3);
}
function jyuchu_hinmokuDialog(obj, url1, url2, url3) {
	//先頭が０からでname設定の数から計算
	//定数で設定する NAME_SUU = 4 仮
	var idx = 0;
	idx = (rINX - 1) * NAME_SUU;
	var dai = document.form1.elements['jyuchuname[]'][idx].value;
	var kubetu = 1;
	if ((dai == "") || (dai == null)) {
		kubetu = 0;
	}
	$("#" + obj).dialog({
		modal: true,
		title: "受注品目検索",
		height: "auto",
		width: 'auto',
		open: function (event) {
			ajax_func_hinmoku_jyuchu(kubetu, url1, url2, url3);
		},
		close: function () {
		},
	});
}
/**
* 	立替品目ダイアログ
*
*/
function refertatekae_hinmokuButton(obj, url1, url2, url3) {
	tatekae_hinmokuDialog(obj, url1, url2, url3);
}
function tatekae_hinmokuDialog(obj, url1, url2, url3) {
	//先頭が０からでname設定の数から計算
	//定数で設定する NAME_SUU
	var idx = 0;
	idx = (rINX - 1) * (TATEKAENAME_SUU);
	var dai = document.form1.elements['tatekaename[]'][idx].value;
	var kubetu = 1;
	if ((dai == "") || (dai == null)) {
		kubetu = 0;
	}
	$("#" + obj).dialog({
		modal: true,
		title: "立替金品目検索",
		height: "auto",
		width: 'auto',
		open: function (event) {
			ajax_func_hinmoku_tatekae(kubetu, url1, url2, url3);
		},
		close: function () {
		},
	});
}
/* 登録画面（body#update) 合計テーブル配置 */
function goukei_reposition() {
	var j7_offset = $('th.j7').offset();
	var g5_offset = $('th.g5').offset();
	$('#jyuchu_goukei').css({ left: j7_offset.left - 30 });
	$('#gaichu_goukei').css({ left: g5_offset.left - 30 });
}
/**
*  	バージョン表示
*/
function versionDialog() {
	$("#version_dialog-form").dialog({
		modal: true,
		title: "バージョン表示",
		height: "auto",
		width: "auto",
		close: function () {
		}
	});
}
/*
*  月次更新
*/
function getujiUpdateDialog() {
	$("#getuji_dialog-form").dialog({
		modal: true,
		title: "月次更新",
		height: "auto",
		width: 300,
		close: function () {
		}
	});
}
function ajax_getuji(type, url) {
	var data = { value1: $('a').val(), value2: $('#getujidate').val(), value3: $('a'), value4: $('a') };
	var param1 = $('a').val();
	var param2 = $("#getujidate").val();
	var param3 = $('a').val();
	var param4 = $('a').val();
	var url_val = url;
	// var paramitiran = '#getuji_dialog-form';
	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": param1, "value2": param2, "value3": param3, "value4": param4 },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);

			//返ってきたデータの表示
			/**  jsonのケース   tdで表示****/
			if (type == 1) {
				document.getuji.getujidate.value = data['monthly_date'];
				getujiUpdateDialog();
			}
			/*******************************/
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
		}
	});
}


/*
*  ajax_func  Ajax通信を今後共通化する 現状得意先に特化　　typeで振り分けるか
*
*/
function ajax_func(type, url) {
	var data = { value1: $('#tokuisaki_item0').val(), value2: $('#tokuisaki_item1').val(), value3: $('#tokuisaki_item2'), value4: $('#tokuisaki_item3') };
	var param1 = $("#tokuisaki_item0").val();
	var param2 = $("#tokuisaki_item1").val();
	var param3 = $("#tokuisaki_item2").val();
	var param4 = $("#tokuisaki_item3").val();

	var url_val = url;
	var paramitiran = '#tokuisaki_itiran_1';
	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": param1, "value2": param2, "value3": param3, "value4": param4 },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);

			//返ってきたデータの表示
			/**  jsonのケース   tdで表示****/
			if (type == 1) {
				var $content = $(paramitiran);

				$(paramitiran).find("tr:gt(0)").remove();
				for (var i = 0; i < data.length; i++) {
					//Kimura Add START 2016.01.25
					$content.append("<tr><td class='w30'>" + data[i].code + "</td><td class='w170'>" +
						data[i].corp_name + "</td><td class='w100'>" +
						data[i].corp_kana + "</td><td class='w100'>" +
						data[i].br_name + "</td><td class='w100'>" +
						data[i].addr_disp + data[i].addr_kana + "</td><td class='w70'>" +
						data[i].corp_tel + "</td><td class='w100'>" +
						data[i].biko + "</td>" +
						"<td style='display: none;'>" + data[i].id + "</td>" +
						"<td style='display: none;'>" + data[i].post_disp + "</td>" +
						"<td style='display: none;'>" + data[i].name + "</td>" +
						"<td style='display: none;'>" + data[i].br_code + "</td>" +
						"<td style='display: none;'>" + data[i].furikana + "</td>" +
						"<td style='display: none;'>" + data[i].tj_s1 + "</td>" +
						"<td style='display: none;'>" + data[i].bill_month + "</td>" +
						"<td style='display: none;'>" + data[i].bill_date + "</td>" +
						"<td style='display: none;'>" + data[i].tj_p1 + "</td>" +
						"<td style='display: none;'>" + data[i].tj_p2 + "</td>" +
						"<td style='display: none;'>" + data[i].biko1 + "</td>" +
						"<td style='display: none;'>" + data[i].biko2 + "</td>" +
						"<td style='display: none;'>" + data[i].seikyusho + "</td>" +
						"</tr>");
					// "<td style='display: none;'>" + data[i].br_name + "</td>" +
					//Kimura Add END 2016.01.25

				}
			}
			/*******************************/
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
		}
	});
}
/*
*  品目にactive設定   静的HTMLのための関数
*   kubetu : 1 受注
*            2 立替
*   type   : 1 大
*            2 中
*            3 小
*/
function set_hinmoku_active(kubetu, type) {
	idx = (rINX - 1) * NAME_SUU;
	if (kubetu == 1) {   //受注品目
		if (type == 1) {
			tbl = document.getElementById('hinmoku_itiran_1');
			code = document.form1.elements['jyuchuname[]'][idx].value;

		}
		if (type == 2) {
			tbl = document.getElementById('hinmoku_itiran_2');
			code = document.form1.elements['jyuchuname[]'][idx + 1].value;
		}
		if (type == 3) {
			tbl = document.getElementById('hinmoku_itiran_3');
			code = document.form1.elements['jyuchuname[]'][idx + 2].value;
		}

	} else {
		if (type == 1) {
			var tbl = document.getElementById('tatekae_hinmoku_itiran_1');
			code = document.form1.elements['tatekaename[]'][idx].value;
		}
		if (type == 2) {
			var tbl = document.getElementById('tatekae_hinmoku_itiran_2');
			code = document.form1.elements['tatekaename[]'][idx + 1].value;
		}
		if (type == 3) {
			var tbl = document.getElementById('tatekae_hinmoku_itiran_3');
			code = document.form1.elements['tatekaename[]'][idx + 2].value;
		}
	}
	//品目コードのactive
	tbl.rows[code].cells[1].className = 'active';
}
/*
*  受注品目の各コードでのajax通信
*      kubun: 1 コードの判定の時
*             2  ダイアログでクリックのとき
*      type : 1 大分類の表示
*             2 中分類の表示
*             3 小分類の表示
*/
function ajax_hinmoku_jyuchu(kubun, type, url1, url2, url3) {
	//typeによりurlやパラメータ設定
	var $content;

	idx = (rINX - 1) * NAME_SUU;

	if (type == 1) {
		$('#hinmoku_itiran_1').find("tr:gt(0)").remove();
		$('#hinmoku_itiran_2').find("tr:gt(0)").remove();
		$('#hinmoku_itiran_3').find("tr:gt(0)").remove();

		$content = $('#hinmoku_itiran_1');

		/***/
		var param1 = document.form1.elements['jyuchuname[]'][idx].value;
		//var data = {value1:param1};

		$.ajax({
			type: "POST",
			url: url1,
			dataType: "json",
			async: false,
			//data: {"value1":param1},
			//  Ajax通信が成功した場合に呼び出されるメソッド
			success: function (data, dataType) {
				//結果が0件の場合
				if ((data.length == 0) || (data == null)) //alert('データが0件でした');
					errorConfirmDialog('0000', 4);
				//返ってきたデータの表示
				//  jsonのケース   tdで表示
				//$(content).find("tr:gt(0)").remove();

				for (var i = 0; i < data.length; i++) {
					if (data[i].l_bunrui_code == param1) {
						$content.append("<tr><td class='disnone'>" + data[i].l_bunrui_code + "</td>" +
							"<td class='active'>" + data[i].l_bunrui_name + "</td></tr>");
						rdaiINX = i + 1;
					} else {
						$content.append("<tr><td class='disnone'>" + data[i].l_bunrui_code + "</td>" +
							"<td>" + data[i].l_bunrui_name + "</td></tr>");
					}
				}
				//
			},
			// Ajax通信が失敗場合に呼び出されるメソッド
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

				//this;
				//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

				//エラーメッセージの表示
				//alert('Error : ' + errorThrown);
				errorConfirmDialog('0000', 5);
				//仮データ
				$content.append("<tr><td class='disnone'>1</td><td>性能評価</td></tr>");
				$content.append("<tr><td class='disnone'>2</td><td>非木造</td></tr>");
				$content.append("<tr><td class='disnone'>3</td><td>設計</td></tr>");
				$content.append("<tr><td class='disnone'>4</td><td>構造</td></tr>");
				$content.append("<tr><td class='disnone'>5</td><td>その他</td></tr>");

				set_hinmoku_active(1, 1);
				//
			}
		});
	}
	if (type == 2) {
		$('#hinmoku_itiran_2').find("tr:gt(0)").remove();
		$('#hinmoku_itiran_3').find("tr:gt(0)").remove();

		$content = $('#hinmoku_itiran_2');

		if (kubun == 1) {
			param1 = document.form1.elements['jyuchuname[]'][idx].value;
		} else {
			t = document.getElementById("hinmoku_itiran_1");
			param1 = t.rows[rdaiINX].cells[0].innerHTML;
		}
		param2 = document.form1.elements['jyuchuname[]'][idx + 1].value;
		data = { value1: param1 };

		$.ajax({
			type: "POST",
			url: url2,
			dataType: "json",
			async: false,
			data: { "value1": param1 },
			//  Ajax通信が成功した場合に呼び出されるメソッド
			success: function (data, dataType) {
				//結果が0件の場合
				if ((data.length == 0) || (data == null)) //alert('データが0件でした');
					errorConfirmDialog('0000', 4);
				//返ってきたデータの表示
				//  jsonのケース   tdで表示

				for (var i = 0; i < data.length; i++) {

					if (data[i].m_bunrui_code == param2) {
						$content.append("<tr><td class='disnone'>" + data[i].m_bunrui_code + "</td>" +
							"<td class='active'>" + data[i].m_bunrui_name + "</td></tr>");
						rchuINX = i + 1;
					} else {
						$content.append("<tr><td class='disnone'>" + data[i].m_bunrui_code + "</td>" +
							"<td>" + data[i].m_bunrui_name + "</td></tr>");
					}
				}
				//
			},
			// Ajax通信が失敗場合に呼び出されるメソッド
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

				//this;
				//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

				//エラーメッセージの表示
				//alert('Error : ' + errorThrown);
				errorConfirmDialog('0000', 5);
				//仮データ
				$content.append("<tr><td class='disnone'>1</td><td>性能評価</td></tr>");
				$content.append("<tr><td class='disnone'>2</td><td>省エネ措置の届出</td></tr>");
				$content.append("<tr><td class='disnone'>3</td><td>低炭素建物</td></tr>");
				$content.append("<tr><td class='disnone'>4</td><td>長期優良住宅</td></tr>");
				$content.append("<tr><td class='disnone'>5</td><td>ＣＡＳＢＥＥ</td></tr>");
				$content.append("<tr><td class='disnone'>6</td><td>エネルギーバス</td></tr>");
				$content.append("<tr><td class='disnone'>7</td><td>ＢＥＬＳ</td></tr>");
				$content.append("<tr><td class='disnone'>8</td><td>省エネ計算</td></tr>");
				$content.append("<tr><td class='disnone'>9</td><td>変更</td></tr>");
				$content.append("<tr><td class='disnone'>10</td><td>その他</td></tr>");

				set_hinmoku_active(1, 2);
			}
		});
	}
	if (type == 3) {

		$('#hinmoku_itiran_3').find("tr:gt(0)").remove();

		$content = $('#hinmoku_itiran_3');

		if (kubun == 1) {
			param1 = document.form1.elements['jyuchuname[]'][idx].value;
			param2 = document.form1.elements['jyuchuname[]'][idx + 1].value;
			param3 = document.form1.elements['jyuchuname[]'][idx + 2].value;
		} else {
			t = document.getElementById("hinmoku_itiran_1");
			param1 = t.rows[rdaiINX].cells[0].innerHTML;
			t = document.getElementById("hinmoku_itiran_2");
			param2 = t.rows[rchuINX].cells[0].innerHTML;
		}
		var param3 = document.form1.elements['jyuchuname[]'][idx + 2].value;
		var data = { value1: param1, value2: param2 };

		$.ajax({
			type: "POST",
			url: url3,
			dataType: "json",
			async: false,
			data: { "value1": param1, "value2": param2 },
			//  Ajax通信が成功した場合に呼び出されるメソッド
			success: function (data, dataType) {
				//結果が0件の場合
				if ((data.length == 0) || (data == null)) //alert('データが0件でした');
					errorConfirmDialog('0000', 4);
				//返ってきたデータの表示
				//  jsonのケース   tdで表示


				for (var i = 0; i < data.length; i++) {
					if (data[i].product_code == param3) {
						$content.append("<tr><td class='disnone'>" + data[i].product_code + "</td>" +
							"<td ondblclick='javascript:set_hinmoku_jyuchu();' class='active'>" + data[i].product_name + "</td></tr>");
					} else {
						$content.append("<tr><td class='disnone'>" + data[i].product_code + "</td>" +
							"<td ondblclick='javascript:set_hinmoku_jyuchu();'>" + data[i].product_name + "</td></tr>");
					}
				}
			},
			// Ajax通信が失敗場合に呼び出されるメソッド
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

				//this;
				//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

				//エラーメッセージの表示
				//alert('Error : ' + errorThrown);
				errorConfirmDialog('0000', 5);
				//仮データ
				$content.append("<tr><td class='disnone'>1</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>性能評価申請サポート（設計）</td></tr>");
				$content.append("<tr><td class='disnone'>2</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>性能評価申請サポート（建設）</td></tr>");
				$content.append("<tr><td class='disnone'>3</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>性能評価申請サポート（設計・建設）</td></tr>");
				$content.append("<tr><td class='disnone'>4</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>長期優良住宅サポート</td></tr>");
				$content.append("<tr><td class='disnone'>5</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>性能評価（設計）・長期優良住宅サポート</td></tr>");
				$content.append("<tr><td class='disnone'>6</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>性能評価（設計・建設）・長期優良住宅サポート</td></tr>");
				$content.append("<tr><td class='disnone'>7</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>低炭素建築物申請サポート</td></tr>");
				$content.append("<tr><td class='disnone'>8</td><td ondblclick='javascript:set_hinmoku_jyuchu();'>変更設計</td></tr>");

				set_hinmoku_active(1, 3);
			}
		});
	}
}
/*
*  立替金品目の各コードでのajax通信
*      kubun: 1 コードの判定の時
*             2  ダイアログでクリックのとき
*      type : 1 大分類の表示
*             2 中分類の表示
*             3 小分類の表示
*/

function ajax_hinmoku_tatekae(kubun, type, url1, url2, url3) {
	//typeによりurlやパラメータ設定
	var $content;

	idx = (rINX - 1) * (TATEKAENAME_SUU);

	if (type == 1) {
		$('#tatekae_hinmoku_itiran_1').find("tr:gt(0)").remove();
		$('#tatekae_hinmoku_itiran_2').find("tr:gt(0)").remove();
		$('#tatekae_hinmoku_itiran_3').find("tr:gt(0)").remove();

		$content = $('#tatekae_hinmoku_itiran_1');

		/***/
		var param1 = document.form1.elements['tatekaename[]'][idx].value;
		//var data = {value1:param1};

		$.ajax({
			type: "POST",
			url: url1,
			dataType: "json",
			//data: {"value1":param1},
			//  Ajax通信が成功した場合に呼び出されるメソッド
			success: function (data, dataType) {
				//結果が0件の場合
				if ((data.length == 0) || (data == null)) //alert('データが0件でした');
					errorConfirmDialog('0000', 4);
				//返ってきたデータの表示
				//  jsonのケース   tdで表示
				//$(content).find("tr:gt(0)").remove();

				for (var i = 0; i < data.length; i++) {
					if (data[i].l_bunrui_code == param1) {
						$content.append("<tr><td class='disnone'>" + data[i].l_bunrui_code + "</td>" +
							"<td class='active'>" + data[i].l_bunrui_name + "</td></tr>");
					} else {
						$content.append("<tr><td class='disnone'>" + data[i].l_bunrui_code + "</td>" +
							"<td>" + data[i].l_bunrui_name + "</td></tr>");
					}
				}
				//
			},
			// Ajax通信が失敗場合に呼び出されるメソッド
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

				//this;
				//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

				//エラーメッセージの表示
				//alert('Error : ' + errorThrown);
				errorConfirmDialog('0000', 5);
				//仮データ
				/* 静的HTMLでの表示 */
				$content.append("<tr><td class='disnone'>1</td><td>立替金</td></tr>");

				set_hinmoku_active(2, 1);

			}
		});
	}
	if (type == 2) {
		$('#tatekae_hinmoku_itiran_2').find("tr:gt(0)").remove();
		$('#tatekae_hinmoku_itiran_3').find("tr:gt(0)").remove();

		$content = $('#tatekae_hinmoku_itiran_2');

		if (kubun == 1) {
			param1 = document.form1.elements['tatekaename[]'][idx].value;
		} else {
			t = document.getElementById("tatekae_hinmoku_itiran_1");
			param1 = t.rows[rdaiINX].cells[0].innerHTML;
		}
		param2 = document.form1.elements['tatekaename[]'][idx + 1].value;
		data = { value1: param1 };

		$.ajax({
			type: "POST",
			url: url2,
			dataType: "json",
			data: { "value1": param1 },
			//  Ajax通信が成功した場合に呼び出されるメソッド
			success: function (data, dataType) {
				//結果が0件の場合
				if ((data.length == 0) || (data == null)) //alert('データが0件でした');
					errorConfirmDialog('0000', 4);
				//返ってきたデータの表示
				//  jsonのケース   tdで表示

				for (var i = 0; i < data.length; i++) {

					if (data[i].m_bunrui_code == param2) {
						$content.append("<tr><td class='disnone'>" + data[i].m_bunrui_code + "</td>" +
							"<td class='active'>" + data[i].m_bunrui_name + "</td></tr>");
					} else {
						$content.append("<tr><td class='disnone'>" + data[i].m_bunrui_code + "</td>" +
							"<td>" + data[i].m_bunrui_name + "</td></tr>");
					}
				}
				//
			},
			// Ajax通信が失敗場合に呼び出されるメソッド
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

				//this;
				//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

				//エラーメッセージの表示
				//alert('Error : ' + errorThrown);
				errorConfirmDialog('0000', 5);
				//仮データ
				/* 静的HTMLでの表示 */

				$content.append("<tr><td class='disnone'>1</td><td>性能評価</td></tr>");
				$content.append("<tr><td class='disnone'>2</td><td>設計</td></tr>");
				$content.append("<tr><td class='disnone'>3</td><td>その他</td></tr>");

				set_hinmoku_active(2, 2);
			}
		});
	}
	if (type == 3) {
		$('#tatekae_hinmoku_itiran_3').find("tr:gt(0)").remove();

		$content = $('#tatekae_hinmoku_itiran_3');

		if (kubun == 1) {
			param1 = document.form1.elements['tatekaename[]'][idx].value;
			param2 = document.form1.elements['tatekaename[]'][idx + 1].value;
		} else {
			t = document.getElementById("tatekae_hinmoku_itiran_1");
			param1 = t.rows[rdaiINX].cells[0].innerHTML;
			t = document.getElementById("tatekae_hinmoku_itiran_2");
			param2 = t.rows[rchuINX].cells[0].innerHTML;
		}
		var param3 = document.form1.elements['tatekaename[]'][idx + 2].value;
		var data = { value1: param1, value2: param2 };

		$.ajax({
			type: "POST",
			url: url3,
			dataType: "json",
			data: { "value1": param1, "value2": param2 },
			//  Ajax通信が成功した場合に呼び出されるメソッド
			success: function (data, dataType) {
				//結果が0件の場合
				if ((data.length == 0) || (data == null)) //alert('データが0件でした');
					errorConfirmDialog('0000', 4);
				//返ってきたデータの表示
				//  jsonのケース   tdで表示


				for (var i = 0; i < data.length; i++) {
					if (data[i].product_code == param3) {
						$content.append("<tr><td class='disnone'>" + data[i].product_code + "</td>" +
							"<td ondblclick='javascript:set_hinmoku_tatekae();' class='active'>" + data[i].product_name + "</td></tr>");
					} else {
						$content.append("<tr><td class='disnone'>" + data[i].product_code + "</td>" +
							"<td ondblclick='javascript:set_hinmoku_tatekae();'>" + data[i].product_name + "</td></tr>");
					}
				}
				//
			},
			// Ajax通信が失敗場合に呼び出されるメソッド
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

				//this;
				//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

				//エラーメッセージの表示
				//alert('Error : ' + errorThrown);
				errorConfirmDialog('0000', 5);
				//仮データ
				/* 静的HTMLでの表示 */

				$content.append("<tr><td class='disnone'>1</td><td ondblclick='javascript:set_hinmoku_tatekae();'>設計評価手数料</td></tr>");
				$content.append("<tr><td class='disnone'>2</td><td ondblclick='javascript:set_hinmoku_tatekae();'>建築評価手数料</td></tr>");
				$content.append("<tr><td class='disnone'>3</td><td ondblclick='javascript:set_hinmoku_tatekae();'>変更設計手数料</td></tr>");
				$content.append("<tr><td class='disnone'>4</td><td ondblclick='javascript:set_hinmoku_tatekae();'>確認申請納付金</td></tr>");
				$content.append("<tr><td class='disnone'>5</td><td ondblclick='javascript:set_hinmoku_tatekae();'>適合証明手数料</td></tr>");
				$content.append("<tr><td class='disnone'>6</td><td ondblclick='javascript:set_hinmoku_tatekae();'>中間検査納付金</td></tr>");
				$content.append("<tr><td class='disnone'>7</td><td ondblclick='javascript:set_hinmoku_tatekae();'>完了検査納付金</td></tr>");
				$content.append("<tr><td class='disnone'>8</td><td ondblclick='javascript:set_hinmoku_tatekae();'>フラット35申請納付金</td></tr>");
				$content.append("<tr><td class='disnone'>9</td><td ondblclick='javascript:set_hinmoku_tatekae();'>その他</td></tr>");

				set_hinmoku_active(2, 3);
			}
		});
	}
}
/*
*  ajax_func_hinmoku_jyuchu  受注品目の初回表示に一度呼ばれる
*          kubetu: 0  コード設定なし   大のみ（初期の場合）
*                  1  コード設定あり   大中小の設定
*          url1  :
*
*/
function ajax_func_hinmoku_jyuchu(kubetu, url1, url2, url3) {
	if (kubetu == 0) {
		ajax_hinmoku_jyuchu(1, 1, url1, url2, url3);
	} else {
		/***  コードありの場合   ****/
		ajax_hinmoku_jyuchu(1, 1, url1, url2, url3);
		ajax_hinmoku_jyuchu(1, 2, url1, url2, url3);
		ajax_hinmoku_jyuchu(1, 3, url1, url2, url3);
	}
}
/*
*  ajax_func_hinmoku_tatekae  受注品目の初回表示に一度呼ばれる
*          kubetu: 0  コード設定なし   大のみ（初期の場合）
*                  1  コード設定あり   大中小の設定
*          url1  :
*
*/
function ajax_func_hinmoku_tatekae(kubetu, url1, url2, url3) {
	if (kubetu == 0) {
		ajax_hinmoku_tatekae(1, 1, url1, url2, url3);
	} else {
		/***  コードありの場合   ****/
		ajax_hinmoku_tatekae(1, 1, url1, url2, url3);
		ajax_hinmoku_tatekae(1, 2, url1, url2, url3);
		ajax_hinmoku_tatekae(1, 3, url1, url2, url3);
	}
}
/*
*	物件情報の新規か更新かの設定と配列個数の設定
*/
function set_mode_insert_update() {
	//物件情報の更新のときによびだされるので更新のswと配列個数の設定を行う
	$insert_update_sw = 1;
	NAME_SUU = 28;
	TATEKAENAME_SUU = 27;
	//
}
/*
*	入力不可の初期処理
*/
function disable_init() {
	disable_init_select(0);

	disable_set("head_head", true);
	disable_set("head_content", true);

	disable_set("goukei_box", true);
	disable_set("container", true);
	//disable_set("goukei_box",true);
	/**
	obj_link1 = document.getElementById("jyuchu_tag");
	obj_link1.disabled = false;
	obj_link1.setAttribute("href","");
	obj_link2 = document.getElementById("gaichu_tag");
	obj_link2.disabled = false;
	obj_link2.setAttribute("href","");
	obj_link3 = document.getElementById("Toggle_sw");
	obj_link3.disabled = false;
	obj_link3.setAttribute("href","");
	**/
	disable_set_detail('plus_button', "button", false);

}
/*
*	入力可にする
*/
function disable_reset() {

	disable_init_select(1);

	disable_set("head_head", false);
	disable_set("head_content", false);
	disable_set("goukei_box", false);
	disable_set("container", false);
	$('.disabled_sw').attr('disabled', 'true');
	/**/
	obj_link1 = document.getElementById("jyuchu_tag");
	obj_link1.disabled = true;
	obj_link1.setAttribute("href", "javascript:width_T('jyuchu');");
	obj_link2 = document.getElementById("gaichu_tag");
	obj_link2.disabled = true;
	obj_link2.setAttribute("href", "javascript:width_T('gaichu');");
	obj_link3 = document.getElementById("Toggle_sw");
	obj_link3.disabled = true;
	obj_link3.setAttribute("href", "javascript:Toggle('y','x');");

	obj_kari = document.getElementById("header");
	obj_ikan = document.getElementById("select8");
	listValue = document.form1.elements['ikan_flg'].value;
	osaka_ikanNo = document.form1.elements['osaka_ikan'].value;
	var btn = document.getElementById("select8");
	//	移管物件設定できるのは現状の物件が東京のときのみ
	if (document.getElementById("select1").value == 1 && obj_kari.className != "kari") {
		//	大阪と紐づく移管物件がある場合は編集させたくないため
		if (osaka_ikanNo != 0) {
			obj_ikan.disabled = true;
			document.getElementById("select8").style.background = " rgb(235, 235, 228)  url(" + $baseUrl + "/img/select_arrow.png)  no-repeat 4px center";
		}
	}
	else {
		obj_ikan.disabled = true;
		document.getElementById("select8").style.background = " rgb(235, 235, 228)  url(" + $baseUrl + "/img/select_arrow.png)  no-repeat 4px center";
	}

	/**
	 * 仮登録時、「変更承認」「完了承認」を入力・編集不可にする
	 */
	// 「仮登録」関係の場合
	if (obj_kari.className == "kari") {
		// 編集
		accept_edit = document.getElementById("accept_edit_flg_select");
		accept_edit.style.background = "rgb(249, 249, 249) url(" + $baseUrl + "/img/select_arrow.png) no-repeat 4px center"; // #f9f9f9 = rgb(249, 249, 249)
		accept_edit.disabled = true;

		// 完了
		accept_done = document.getElementById("accept_done_flg_select");
		accept_done.style.background = "rgb(249, 249, 249) url(" + $baseUrl + "/img/select_arrow.png) no-repeat 4px center";
		accept_done.disabled = true;
	}
	// readonly な input タグの背景色をグレーに変更
	$("input[name='accept_new_name']").css("background-color", "#f9f9f9");
	$("input[name='accept_new_date']").css("background-color", "#f9f9f9");
	$("input[name='accept_edit_name']").css("background-color", "#f9f9f9");
	$("input[name='accept_edit_date']").css("background-color", "#f9f9f9");
	$("input[name='accept_done_name']").css("background-color", "#f9f9f9");
	$("input[name='accept_done_date']").css("background-color", "#f9f9f9");
}
/*
*
*/
function disable_set(id, sw) {
	disable_set_detail(id, "input", sw);
	disable_set_detail(id, "button", sw);
	disable_set_detail(id, "select", sw);
	disable_set_detail(id, "textarea", sw);
}
/*
*
*/
function disable_set_detail(id, tagname, sw) {
	var tags = document.getElementById(id).getElementsByTagName(tagname);

	for (var i = 0; i < tags.length; i++) {
		tags[i].disabled = sw;
	}
}
/*
* disable_init_select  選択のdisable制御
*    sw : 0 入力禁止
*         1 入力解除
*/
function disable_init_select(sw) {
	if (sw == 0) {
		rgbtmp = " rgb(235, 235, 228)  url(" + $baseUrl + "/img/select_arrow.png)  no-repeat 4px center";
	} else {
		rgbtmp = "#fff  url(" + $baseUrl + "/img/select_arrow.png)  no-repeat 4px center";
	}
	document.getElementById("select1").style.background = rgbtmp;
	document.getElementById("select2").style.background = rgbtmp;
	document.getElementById("select3").style.background = rgbtmp;
	document.getElementById("select4").style.background = rgbtmp;
	document.getElementById("select5").style.background = rgbtmp;
	document.getElementById("select6").style.background = rgbtmp;
	document.getElementById("select7").style.background = rgbtmp;
	document.getElementById("select8").style.background = rgbtmp;
	document.getElementById("select9").style.background = rgbtmp;
	document.getElementById("select10").style.background = rgbtmp;
	if (document.getElementById("select11") != null) {
		document.getElementById("select11").style.background = rgbtmp;
	}
	document.getElementById("dialog_item16").style.background = rgbtmp;

	document.getElementById("accept_new_flg_select").style.background = rgbtmp;
	document.getElementById("accept_edit_flg_select").style.background = rgbtmp;
	document.getElementById("accept_done_flg_select").style.background = rgbtmp;

}
/*
*
*/

// バックアップ
// function disable_submit_sw(sw) {
// 	var obj_link1 = document.getElementById('submit_dis');
//
// 	if($("#bknoa").val() =="" || $("#select1").val() =="") {
// 		obj_link1.disabled = true;
//         $('#submit_dis').addClass('disable04');
// 	} else if($("#bknoa").val() !="" && $("#select1").val() !=""){
// 		obj_link1.disabled = false;
//         $('#submit_dis').removeClass('disable04');
// 	}
// }

function disable_submit_sw(sw) {
	var obj_link1 = document.getElementById('submit_dis');
	if (sw == 0) {
		obj_link1.disabled = true;
		// $('#submit_dis').addClass('disable04');
	} else {
		obj_link1.disabled = false;
		// $('#submit_dis').removeClass('disable04');
	}
}

function kariCopyRow(id, type) {
	var sw = kariCopyDisp();
	if (sw) {
		// テーブル取得
		//仮の設定で 今後他の共通で変更
		if (type == 0) {
			if ($edit_table == 0) {
				id = "edit1";
			} else id = "edit2";
		}
		var table = document.getElementById(id);
		var rw = rINX;
	}
}
function kariCopyDisp() {
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if (!rINX || rINX == '0') {
		//window.confirm('複写する行を選択してください');
		errorConfirmDialog('0000', 2);
		return false;
	}
	justConfirmDialog('複写しますか？', function () {
		var tbl = document.getElementById('tbody_ichiran');
		var copyKey = null;
		copyKey = tbl.rows[rINX - 1].cells[tbl.rows[rINX - 1].cells.length - 1].textContent;	//rINX行目の最終行のセルを取得
		document.forms['karicopy-form'].elements['karicopy-key'].value = copyKey;
		do_submit('karicopy-form'); // 仮コピー処理 へジャンプ(tplのフォームのサブミット)
	})

}
/*
*  ajax_func  Ajax通信を今後共通化する
*/
function ajax_func_seikyu(type, url) {
	var data = { value1: $('#seikyusaki_item0').val(), value2: $('#seikyusaki_item1').val(), value3: $('#seikyusaki_item2') };
	var param1 = $("#seikyusaki_item0").val();
	var param2 = $("#seikyusaki_item1").val();
	var param3 = $("#seikyusaki_item2").val();

	var url_val = url;
	var paramitiran = '#seikyusaki_itiran_1';
	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": param1, "value2": param2, "value3": param3 },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);
			//返ってきたデータの表示
			/**  jsonのケース   tdで表示****/
			if (type == 1) {
				var $content = $(paramitiran);

				$(paramitiran).find("tr:gt(0)").remove();
				for (var i = 0; i < data.length; i++) {
					//Kimura Add START 2016.01.25
					$content.append("<tr><td class='w30'>" + data[i].id + "</td><td class='w170'>" +
						data[i].name + "</td><td class='w100'>" +
						data[i].addr_disp + "</td><td class='w70'>" +
						data[i].tel1 + "</td><td class='w100'>" +
						data[i].biko + "</td>" +
						"<td style='display: none;'>" + data[i].position + "</td>" +
						"<td style='display: none;'>" + data[i].tanto_name + "</td>" +
						"<td style='display: none;'>" + data[i].cut_date + "</td>" +
						"<td style='display: none;'>" + data[i].bill_month + "</td>" +
						"<td style='display: none;'>" + data[i].bill_date + "</td>" +
						"<td style='display: none;'>" + data[i].pay_month + "</td>" +
						"<td style='display: none;'>" + data[i].pay_date + "</td>" +
						"<td style='display: none;'>" + data[i].biko1 + "</td>" +
						"<td style='display: none;'>" + data[i].biko2 + "</td>" +
						"<td style='display: none;'>" + data[i].seikyusho + "</td>" +
						"</tr>");
					//Kimura Add END 2016.01.25
				}
			}
			/*******************************/
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
		}
	});
}
/******************
flg=1:受注・外注明細 外注
flg=2:受注・外注 立替金 外注
global 変数で制御する

******************/
function ajax_func_gaichu(type, url) {

	var data = { value1: $('#gaichusaki_item0').val(), value2: $('#gaichusaki_item2').val(), value3: $('#gaichusaki_item3') };
	var param1 = $("#gaichusaki_item0").val();
	var param2 = $("#gaichusaki_item2").val();
	var param3 = $("#gaichusaki_item3").val();

	var url_val = url;
	var paramitiran = '#gaichusaki_itiran_1';

	flg = gaichuflg;
	gidx = gaichugidx;

	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": param1, "value2": param2, "value3": param3 },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);
			//返ってきたデータの表示
			/**  jsonのケース   tdで表示****/
			if (type == '1') {
				var $content = $(paramitiran);

				$(paramitiran).find("tr:gt(0)").remove();

				for (var i = 0; i < data.length; i++) {
					$content.append("<tr><td class='w30'>" + data[i].id + "</td><td class='w170'>" +
						data[i].name + "</td><td class='w100'>" +
						data[i].addr_disp + "</td><td class='w70'>" +
						data[i].tel1 + "</td><td class='w100'>" +
						data[i].biko + "</td>" +
						"<td style='display: none;'>" + flg + "</td>" +
						"<td style='display: none;'>" + gidx + "</td>" +
						"</tr>");
				}
			}
			/*******************************/
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
			var $content = $(paramitiran);

			$(paramitiran).find("tr:gt(0)").remove();
			//仮に設定
			for (var i = 0; i < 8; i++) {
				$content.append("<tr><td class='w30'>" + (i + 1) + "</td><td class='w170'>" +
					'外注先名株式会社' + (i + 1) + "</td><td class='w100'>" +
					'東京都千代田区千代田1-1-1' + "</td><td class='w70'>" +
					'0120-441-222' + "</td><td class='w100'>" +
					'備考欄です。サンプルソースです。備考欄です。サンプルソースです。' + "</td>" +
					"<td style='display: none;'>" + flg + "</td>" +
					"<td style='display: none;'>" + gidx + "</td>" +
					"</tr>");
			}

		}
	});
}
/*
*得意先コード検索
*     str     :keyupでの文字　　5文字までは無処理
*     url_val :url
*     kebetu  : 1 物件
*               2 一括　受注
*               3 一括　外注
*/
function tokuisakicode(str, url, kubetu) {
	switch (kubetu) {
		case 1:
			code = $('#client_item_02').val();
			break;
		case 2:
			code = $('#ikkatu_serch_item1').val();
			break;
		case 3:
			code = $('#ikkatu_serch_item1').val();
			break;
	}

	if (str.length == 5) {
		ajax_func_clientSearch(url, code, kubetu);
	}
}
/*
*得意先コードによる検索
*     url_val :url
*     code    :得意先コード
*     kebetu  : 1 物件
*               2 一括　受注
*               3 一括　外注
*/
function ajax_func_clientSearch(url_val, code, kubetu) {
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": code },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);

			switch (kubetu) {
				case 1:
					rwcnt = data.length;
					setHTML = null;

					for (var i = 0; i < data.length; i++) {
						if (i == 0) {
							$('#client_item_01').val(data[i].id);	//得意先ID:id
							$('#client_item_02').val(data[i].code);	//得意先ID(ホントはCODEだが、今値が無いのでIDを入れておく)
							$('#client_item_03').val(data[i].corp_name);	//得意先名:corp_name
							//支店コード:br_code
							//支店名:br_name
							if (rwcnt == 1) {
								setHTML = '<input id="client_item_04_0" type="hidden" size="10" value="1" name="bk_tbl_br_code_kubetu">';
								setHTML += '<input id="client_item_04" type="hidden" size="10" value="' + data[i].br_code + '" name="bk_tbl_br_code">';
								setHTML += '<input id="client_item_05" type="text" size="10" value="' + data[i].br_name + '" name="bk_tbl_br_code">';
							} else {
								setHTML = '<input id="client_item_04_0" type="hidden" size="10" value="2" name="bk_tbl_br_code_kubetu">';
								setHTML += '<select  class="selectbox1" name="bk_tpl_br_name"  onChange="javascript:tokuisakicode_siten();">';
								setHTML += '<option value="' + data[i].br_code + '" label="' + data[i].br_name + '" >' + data[i].br_name + '</option>';
							}
							$('#client_item_06').val(data[i].post_disp);	//郵便番号:post_disp
							$('#client_item_07').val(data[i].addr_disp);	//住所:addr_disp
							$('#client_item_08').val(data[i].corp_tel);	//TEL:corp_tel

							//請求先gyousya2_item_02がnullだと設定
							seikyu = $('#gyousya2_item_02').val();
							if (seikyu == "") {
								$('#torihiki_item_01').val('得意先');//取引
								$('#torihiki_item_02').val(data[i].tj_s1);	//請求締日:tj_s1
								$('#torihiki_item_03').val(data[i].name);	//部署:post_position
								//  $('#torihiki_item_03').val(data[i].post_position);	//部署:post_position
								$('#torihiki_item_04').val(data[i].bill_month);	//請求書(月):bill_month
								$('#torihiki_item_05').val(data[i].bill_date);	//請求書(日):bill_date
								$('#torihiki_item_06').val(data[i].furikana);	//担当者:furikana
								$('#torihiki_item_07').val(data[i].tj_p1);	//条件:tj_p1
								$('#torihiki_item_08').val(data[i].tj_p2);	//条件:tj_p2
								$('#torihiki_item_09').val(data[i].biko1);	//備考1:biko1
								$('#torihiki_item_10').val(data[i].biko2);	//備考2:biko2
							}
							//Kimura Add END 2016.01.25
						} else {
							setHTML += '<option value="' + data[i].br_code + '" label="' + data[i].br_name + '" >' + data[i].br_name + '</option>';
						}

						//請求先で指定した書式にする
						if (data[i].seikyusho == 0) // イエタス書式
						{
							$('#select7').val(0);
						}
						else if (data[i].seikyusho == 1) // 専用
						{
							$('#select7').val(2);
						}
					}
					if (rwcnt != 1) {
						setHTML += '</select>';
					}
					document.getElementById('client_item_04_kari').innerHTML = setHTML;

					break;
				case 2:
					$('#ikkatu_serch_item2').val(data[0].corp_name);
					break;
				case 3:
					$('#ikkatu_serch_item2').val(data[0].corp_name);
					break;
			}

		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
			switch (kubetu) {
				case 1:

					$('#client_item_01').val('xxx');	//得意先ID:id
					$('#client_item_02').val('code');	//得意先ID(ホントはCODEだが、今値が無いのでIDを入れておく)
					$('#client_item_03').val('仮得意先名');	//得意先名:corp_name

					$('#client_item_04').val(1);	//支店コード:br_code
					$('#client_item_05').val("支店名１");	//支店名:br_name
					//支店の生成
					//仮で12345で1件の支店表示
					//    その他で複数件表示
					setHTML = null;
					if (code == 12345) {
						setHTML = '<input id="client_item_04_0" type="hidden" size="10" value="1" name="bk_tbl_br_code_kubetu">';
						setHTML += '<input id="client_item_04" type="hidden" size="10" value="1" name="bk_tbl_br_code">';
						setHTML += '<input id="client_item_05" type="text" size="10" value="支店１" name="bk_tbl_br_code">';
					} else {
						setHTML = '<input id="client_item_04_0" type="hidden" size="10" value="2" name="bk_tbl_br_code_kubetu">';
						setHTML += '<select  class="selectbox1" name="bk_tpl_br_name" onChange="javascript:tokuisakicode_siten();">';
						setHTML += '<option value="10" label="支店1" >支店１</option>';
						setHTML += '<option value="20" label="支店2" >支店２</option>';
						setHTML += '<option value="30" label="支店3" >支店３</option>';
						setHTML += '<option value="40" label="支店4" >支店４</option>';
						setHTML += '</select>';
					}
					document.getElementById('client_item_04_kari').innerHTML = setHTML;
					//
					break;
				case 2:
					$('#ikkatu_serch_item2').val('仮得意先名');
					break;
				case 3:
					$('#ikkatu_serch_item2').val('仮得意先名');
					break;
			}
		}
	});
}
/*
*
*/
function set_tokuisaki_url(url) {
	tokuisaki_url = url;
}
/*
*  得意先コードと支店が選択されたとき
*/
function tokuisakicode_siten() {
	//alert("tokuisakicode_siten");
	// 得意先コードid ="client_item_02"
	tokuisaki_cd = $('#client_item_02').val();
	//選択される支店コード name="bk_tpl_br_name"の支店コード
	siten_cd = $('select[name="bk_tpl_br_name"]').val();
	ajax_func_clientSearchsiten(tokuisaki_url, tokuisaki_cd, siten_cd);
}
/*
*得意先コードと支店コードによる検索
*     url_val :url
*     code    :得意先コード
*     siten   :支店コード
*/
function ajax_func_clientSearchsiten(url_val, code, siten) {
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": code, "value2": siten },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//  ここにデータ取得部をコーディングしてください。
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);
			//先頭のものを設定　　data.lengthは使用しない
			for (var i = 0; i < 1; i++) {
				$('#client_item_01').val(data[i].id);	//得意先ID:id
				$('#client_item_02').val(data[i].code);	//得意先ID(ホントはCODEだが、今値が無いのでIDを入れておく)
				$('#client_item_03').val(data[i].corp_name);	//得意先名:corp_name
				$('#client_item_06').val(data[i].post_disp);	//郵便番号:post_disp
				$('#client_item_07').val(data[i].addr_disp);	//住所:addr_disp
				$('#client_item_08').val(data[i].corp_tel);	//TEL:corp_tel
				seikyu = $('#gyousya2_item_02').val();
				if (seikyu == "") {
					$('#torihiki_item_01').val('得意先');//取引
					$('#torihiki_item_02').val(data[i].tj_s1);	//請求締日:tj_s1
					$('#torihiki_item_03').val(data[i].post_position);	//部署:post_position
					$('#torihiki_item_04').val(data[i].bill_month);	//請求書(月):bill_month
					$('#torihiki_item_05').val(data[i].bill_date);	//請求書(日):bill_date
					$('#torihiki_item_06').val(data[i].furikana);	//担当者:furikana
					$('#torihiki_item_07').val(data[i].tj_p1);	//条件:tj_p1
					$('#torihiki_item_08').val(data[i].tj_p2);	//条件:tj_p2
					$('#torihiki_item_09').val(data[i].biko1);	//備考1:biko1
					$('#torihiki_item_10').val(data[i].biko2);	//備考2:biko2
				}
			}

		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);

			$('#client_item_01').val('xxx');	//得意先ID:id
			$('#client_item_02').val('code');	//得意先ID(ホントはCODEだが、今値が無いのでIDを入れておく)
			$('#client_item_03').val('仮得意先名');	//得意先名:corp_name
			seikyu = $('#gyousya2_item_02').val();
			if (seikyu == "") {
				$('#torihiki_item_01').val('得意先');//取引
				$('#torihiki_item_06').val("担当者");	//担当者:furikana
				$('#torihiki_item_07').val("翌月");	//条件:tj_p1
				$('#torihiki_item_08').val("末");	//条件:tj_p2
				$('#torihiki_item_09').val("備考１");	//備考1:biko1
				$('#torihiki_item_10').val("備考２");	//備考2:biko2
			}
		}
	});
}
/*
*  売上Noを取得
*/
function ajax_func_uriage() {
	url_val = $baseUrl + '/ajax/uriageno';
	var retva = 0;

	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		async: false,
		//data: {"value1":code},
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//  ここにデータ取得部をコーディングしてください。
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);
			retval = data[0].sales_no;
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);

		}
	});
	return retval;
}
/*
*  単位を取得
*/
function ajax_func_unitSearch() {
	url_val = $baseUrl + '/ajax/unitsearch';
	var retva = 0;

	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		async: false,
		//data: {"value1":code},
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//  ここにデータ取得部をコーディングしてください。
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);

			retval = "";
			for (var i = 1; i < data.length; i++) {
				if (i == 1) {
					//空を設定
					retval = retval + '<option value=" "';
					retval = retval + 'label=" "';
					retval = retval + ' selected> </option>';
					//
					retval = retval + '<option value="' + data[i].id;
					retval = retval + '" label="' + data[i].name + '"';
				} else {
					retval = retval + '<option value="' + data[i].id;
					retval = retval + '" label="' + data[i].name + '"';
				}

				retval = retval + '>' + data[i].name + '</option>';
			}
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);

			retval = '<option value="" label="" selected></option>' +
				'<option value="1" label="式">式</option>' +
				'<option value="2" label="棟">棟</option>' +
				'<option value="3" label="ケース">ケース</option>' +
				'<option value="4" label="㎡">㎡</option>';


		}
	});
	return retval;
}
/* ------------------------------
  月次更新の実行
------------------------------ */
function getujiSubmit() {
	var nowPath = location.pathname;                // value02(hidden) に 現在地のpathを挿入
	var ele = document.createElement('input');  // エレメントを作成
	ele.setAttribute('type', 'hidden');              // データを設定
	ele.setAttribute('name', 'path');
	ele.setAttribute('value', nowPath);
	document.getuji.appendChild(ele);               // 要素を追加
	document.forms.getuji.submit();                  // 実行
}
function passwordSubmit() {
	var nowPath = location.pathname;                // value02(hidden) に 現在地のpathを挿入
	var ele = document.createElement('input');  // エレメントを作成
	ele.setAttribute('type', 'hidden');              // データを設定
	ele.setAttribute('name', 'path');
	ele.setAttribute('value', nowPath);
	document.chpass.appendChild(ele);               // 要素を追加
	document.forms.chpass.submit();                  // 実行
}
/* ---------------------------------------------------------
  << 確認用ダイアログボックス表示 >>

  DBへアクセスする実行ボタンで
  確認窓のワンクッションを咬ませたい場合に使用。

  confirmDialog(関数名のカッコ抜き, 引数 , 登録削除etc );
  例：onclick="confirmDialog(do_submit,'form1',2);"
---------------------------------------------------------- */
function confirmDialog(runSubmit, hiki, flg) {

	// 本文「XXX しますか？」　の XXX に当てはめる文字を選択
	if (flg === 1) {
		var conText = "削除";
	} else if (flg === 2) {
		var conText = "登録";
	} else if (flg === 3) {
		var conText = "更新";
	}

	$("#errer_dialog-form").html('<p style=\"font-size:1.2em;\"> ' + conText + 'を実行しますか？</p>');

	$("#errer_dialog-form").dialog({
		modal: true,        // true だとボックス以外...ボックスの裏にある要素の操作を禁止します。
		title: "<p style='font-size:1.2rem;'><i class=\"fa fa-exclamation-circle\"></i>確認</p>",        // タイトルは「確認」固定になっています。
		height: "auto",      // ボックスの高さも横幅も文字数によって変化します。はみ出ません。
		width: "auto",
		buttons: [{
			text: 'OK',
			click: function () { // OKボタンを押すとボックスを閉じます
				runSubmit(hiki);
			}
		},
		{
			text: 'キャンセル',
			click: function () {
				$(this).dialog("close"); // 何も実行せずに窓を閉じます
			}
		}
		]
	});
}
/*
*  促進メッセージダイアログ
*/
function justConfirmDialog(text, callback) {

	$("#errer_dialog-form").html('<p style=\"font-size:1.2em;\">' + text + '</p>');

	$("#errer_dialog-form").dialog({
		modal: true,        // true だとボックス以外...ボックスの裏にある要素の操作を禁止します。
		title: "<p style='font-size:1.2rem;'><i class=\"fa fa-exclamation-circle\"></i>確認</p>",        // タイトルは「確認」固定になっています。
		height: "auto",      // ボックスの高さも横幅も文字数によって変化します。はみ出ません。
		width: "auto",
		buttons: [{
			text: 'OK',
			click: function () { // OKボタンを押すとボックスを閉じます
				$(this).dialog('close');
				callback();
			}
		},
		{
			text: 'キャンセル',
			click: function () {
				$(this).dialog("close"); // 何も実行せずに窓を閉じます
			}
		}
		]
	});
}
function ajax_bknoa(type, url) {
	var data = "\"$('#bknoa').val()\"";
	//var data = value1:$('#bknoa').val();

	var param1 = $('#bknoa').val();

	var url_val = url;
	// var paramitiran = '#getuji_dialog-form';
	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: "\"param1\"",
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */

		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);

			//返ってきたデータの表示
			/**  jsonのケース   tdで表示****/
			if (type == 1) {
				// alert();

				document.form1.bk_no_a.value = data;
				// alert(data['monthly_date']);
				disable_submit_sw(1);
			}
			/*******************************/
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
		}
	});
}

function ajax_useridcheck(type, url) {
	var data = { value1: $('#name0').val() };
	var param1 = $("#name0").val();
	var url_val = url;

	// var paramitiran = '#getuji_dialog-form';
	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": param1 },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if (data == null)
				$('#idbt').addClass('okicon');                // ＯＫアイコン
			$('#idbt').removeClass('cautionIcon');    // 警告アイコン

			//返ってきたデータの表示
			/**  jsonのケース   tdで表示****/
			if (type == 1) {
				if (data['userid'] !== undefined) {     // document.form1.name0.value = data['userid'];
					$('#idbt').removeClass('okicon');     // ＯＫアイコン
					$('#idbt').addClass('cautionIcon');     // 警告アイコン
				}
			}
			/*******************************/
		},
		/**
		 * Ajax通信が失敗場合に呼び出されるメソッド
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
			//this;
			//thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
			//エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			errorConfirmDialog('0000', 5);
		}
	});
}
/*
*	エラー表示ダイアログ
*/
function errorConfirmDialog(errbunrui, errcode) {
	//alert('errorConfirmDialog');
	//codeなどをajaxで取得する今後の予定
	err_message = 'メッセージ？？？？';
	/***/
	switch (errbunrui) {
		case '0000': //jsでのエラー種別
			switch (errcode) {
				case 1:
					err_message = '削除する行を選択してください。';
					break;
				case 2:
					err_message = '複写する行を選択してください。';
					break;
				case 3:
					err_message = '追加する行を選択してください。';
					break;
				case 4:
					err_message = 'データが0件です。';
					break;
				case 5:
					err_message = 'データの検索ができませんでした。';
					break;
				case 6:
					err_message = '権限1の人は修正する事はできません。';
					break;
				case 7:
					err_message = '半角数字のみを入力してください。';
					break;
				case 8:
					err_message = '移管する行を選択してください。';
					break;
			}
			break;
		case '1000':  //login
			switch (errcode) {
				case 1:
					err_message = '値を入力してください。';
					break;
				case 2:
					err_message = '半角英数字のみで入力してください。';
					break;
				case 3:
					err_message = '文字数エラーです(３から７文字までの文字数）。';
					break;
				case 100:
					err_message = 'サーバーが起動されていません。';
					break;
				case 101:
					err_message = '認証に失敗しました。';
					break;
				case 102:
					err_message = '指定されたユーザは削除されています。';
					break;
				case 103:
					err_message = '指定されたユーザは退職しています。';
					break;
				case 104:
					err_message = '既にログインしています。';
					break;
			}
			break;
		case '3400': //入金済
			switch (errcode) {
				case 2:
					err_message = '複写する行を選択してください。';
					break;
			}
			break;
		case '4000': //物件情報 明細入力
			switch (errcode) {
				case 1:
					err_message = '物件Noを入力してください。';
					break;
				case 2:
					err_message = '受注元を入力してください。';
					break;
				case 3:
					err_message = '受注先 消費税率を入力してください。';
					break;
				case 4:
					err_message = '立替金は最大３行までです。';
					break;
				case 5:
					err_message = '半角数字のみで入力してください。';
					break;
				case 6:
					err_message = '立替金は行追加できません。';
					break;
				case 100:
					err_message = '登録に失敗しました。';
					break;
				case 101:
					err_message = '既に付番されている物件Noです。再度、やり直してください。';
					break;
				case 201:
					err_message = '移管物件の受注元は変更できません';
					break;
			}
			break;
		case '8200': //単位マスタ
			switch (errcode) {
				case 1:
					err_message = '値を入力してください。';
					break;
				case 2:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8310': //支店区分
			switch (errcode) {
				case 1:
					err_message = '名前を入力してください。';
					break;
				case 2:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8320': //所属マスタ
			switch (errcode) {
				case 1:
					err_message = '名前を入力してください。';
					break;
				case 2:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8330': //社員マスタ
			switch (errcode) {
				case 1:
					err_message = 'ユーザーIDを入力してください。';
					break;
				case 2:
					err_message = 'ユーザーIDは半角英数字で入力してください。';
					break;
				case 3:
					err_message = '名前を入力してください。';
					break;
				case 4:
					err_message = 'カナは全角カタカナで入力してください。';
					break;
				case 5:
					err_message = 'パスワードを入力してください。';
					break;
				case 6:
					err_message = '確認パスワードが間違っています。\n同じパスワードを入力してください。';
					break;
				case 7:
					err_message = '権限を選択してください。';
					break;
				case 8:
					err_message = '実行権限がありません。';
					break;
				case 100:
					err_message = 'そのユーザーidは使用できません。入力しなおしてください';
					break;
			}
			break;
		case '8410': //受注区分・品名マスタ
			switch (errcode) {
				case 1:
					err_message = '大分類コードを入力してください。';
					break;
				case 2:
					err_message = '大分類名を入力してください。';
					break;
				case 3:
					err_message = '中分類コードを入力してください。';
					break;
				case 4:
					err_message = '中分類名を入力してください。';
					break;
				case 5:
					err_message = '品名コードを入力してください。';
					break;
				case 6:
					err_message = '物件受付表用コードを入力してください。';
					break;
				case 7:
					err_message = '物件受付表用コードを半角英数字で入力してください。';
					break;
				case 8:
					err_message = '印刷順を入力してください。';
					break;
				case 9:
					err_message = '印刷順は半角数字で入力してください。';
					break;
				case 10:
					err_message = 'コードは半角数字で入力してください。';
					break;
				case 11:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8420': //立替区分・品名マスタ
			switch (errcode) {
				case 1:
					err_message = '大分類コードを入力してください。';
					break;
				case 2:
					err_message = '大分類名を入力してください。';
					break;
				case 3:
					err_message = '中分類コードを入力してください。';
					break;
				case 4:
					err_message = '中分類名を入力してください。';
					break;
				case 5:
					err_message = '品名コードを入力してください。';
					break;
				case 6:
					err_message = '品名を入力してください。';
					break;
				case 7:
					err_message = 'コードは半角数字で入力してください。';
					break;
				case 8:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8510': //請求締日マスタ
			switch (errcode) {
				case 1:
					err_message = '値を入力してください。';
					break;
				case 2:
					err_message = '英字以外を入力してください。';
					break;
				case 3:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8520': //支払方法マスタ
			switch (errcode) {
				case 1:
					err_message = '値を入力してください。';
					break;
				case 2:
					err_message = '英字以外を入力してください。';
					break;
				case 3:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8620': //請求先マスタ
			switch (errcode) {
				case 1:
					err_message = '請求先会社名を入力してください。';
					break;
				case 2:
					err_message = '請求先会社名のカナを全角で入力してください。';
					break;
				case 3:
					err_message = 'TELは半角数字（‐含む）で入力してください。';
					break;
				case 4:
					err_message = 'FAXは半角数字（‐含む）で入力してください。';
					break;
				case 5:
					err_message = '郵便番号上3桁は半角数字で入力してください。';
					break;
				case 6:
					err_message = '郵便番号下4桁は半角数字で入力してください。';
					break;
				case 7:
					err_message = '郵便番号を入力してください。';
					break;
				case 8:
					err_message = '都道府県を選択してください。';
					break;
				case 9:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8630': //代理店マスタ
			switch (errcode) {
				case 1:
					err_message = '名前を入力してください。';
					break;
				case 2:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8610': //得意先マスタ
			switch (errcode) {
				case 1:
					err_message = '得意先コードを５桁で入力してください。';
					break;
				case 2:
					err_message = '会社名（正式名称）を入力してください。';
					break;
				case 3:
					err_message = '支店コードを２桁で入力してください。';
					break;
				case 4:
					err_message = '得意先コードを半角数字で入力してください。';
					break;
				case 5:
					err_message = '支店コードを半角数字で入力してください。';
					break;
				case 6:
					err_message = '電話番号を半角数字（ハイフン含む）で入力してください。';
					break;
				case 7:
					err_message = 'FAX番号を半角数字（ハイフン含む）で入力してください。';
					break;
				case 8:
					err_message = '郵便番号上３桁を半角数字で入力してください。';
					break;
				case 9:
					err_message = '郵便番号下４桁を半角数字で入力してください。';
					break;
				case 10:
					err_message = '郵便番号・都道府県を入力してください。';
					break;
				case 11:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8710': //外注先マスタ
			switch (errcode) {
				case 1:
					err_message = '会社名（正式名称）を入力してください。';
					break;
				case 2:
					err_message = '会社名（正式名称）のカナを全角で入力してください。';
					break;
				case 3:
					err_message = '会社名（略称）のカナを全角で入力してください。';
					break;
				case 4:
					err_message = 'TELは半角数字（‐含む）で入力してください。';
					break;
				case 5:
					err_message = 'FAXは半角数字（‐含む）で入力してください。';
					break;
				case 6:
					err_message = '郵便番号上3桁は半角数字で入力してください。';
					break;
				case 7:
					err_message = '郵便番号下4桁は半角数字で入力してください。';
					break;
				case 8:
					err_message = '郵便番号を入力してください。';
					break;
				case 9:
					err_message = '都道府県を選択してください。';
					break;
				case 10:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8720': //評価機関マスタ
			switch (errcode) {
				case 1:
					err_message = '機関名を入力してください。';
					break;
				case 2:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8810': //月次更新
			switch (errcode) {
				case 100:
					err_message = '登録に失敗しました。';
					break;
				case 1:
					err_message = '実行権限がありません。';
					break;
			}
			break;
		case '8820': //パスワード
			switch (errcode) {
				case 100:
					err_message = '現在のパスワードを再入力してください。';
					break;
			}
			break;
		case '9000': //パスワード
			switch (errcode) {
				case 1:
					err_message = '納品日が月次更新日時以前のため、更新できません。';
					break;
			}
			break;
	}
	/***/

	// $( "#error-message" ).html( "<p style='font-size:1.2em;'><i class='fa fa-exclamation-circle'></i>" +err_message +"</p>");
	$("#error-message").html("<p style='font-size:1.2rem;'>" + err_message + "</p>");

	$("#error-message").dialog({
		modal: true,        // true だとボックス以外...ボックスの裏にある要素の操作を禁止します。
		title: "<p style='font-size:1.2rem;'><i class='fa fa-exclamation-triangle' style='color:yellow; padding-right:4px;'></i>エラー</p>",
		height: "auto",      // ボックスの高さも横幅も文字数によって変化します。はみ出ません。
		width: "auto",
		buttons: [{
			text: '確認',
			click: function () { // OKボタンを押すとボックスを閉じます
				$(this).dialog('close');
			}
		},
		]
	});
}
function checkPassword() {
	var pw01 = document.form1.name8.value;
	var pw02 = document.form1.name9.value;

	if (pw01 !== pw02) {                          // if パスワード不一致
		$('#pw').removeClass('okiconPW');     // ＯＫアイコン
		$('#pw').addClass('cautionIconPW');   // 警告アイコン
		$('#pwok').remove();                    // 隠しパラメータ削除
	} else {                                            // if パスワードが一致
		$('#pw').addClass('okiconPW');
		$('#pw').removeClass('cautionIconPW');
		$('#form1').after("<input id='pwok' type='hidden' value='1234'>"); // 隠しパラメータ追加
	}
}

// function checkPrintflag(btn){
// document.form1.bk_info_print_flag3.options[1].selected= true;
// btn.disabled=true;
// }
function checkPrintflag(obj1, obj2) {
	var btn_id = obj1;
	var sel_name = obj2;
	document.form1.elements[sel_name].options[1].selected = true;
	var btn = document.getElementById(btn_id);
	btn.style.pointerEvents = "none";
	btn.style.opacity = "0.6";
	// btn.disabled=true;

}
function selectFlag(obj1, obj2) {
	var btn_id = obj1;
	var sel_name = obj2;
	listValue = document.form1.elements[sel_name].value;
	// alert(listValue);
	var btn = document.getElementById(btn_id);
	if (listValue == 1 || listValue == 2) {
		btn.style.pointerEvents = "none";
		btn.style.opacity = "0.6";
		// document.form1.seikyubtn.disabled=true;
	} else {
		// document.form1.seikyubtn.disabled=false;
		btn.style.pointerEvents = "auto";
		btn.style.opacity = "1";

	}
}
function flag() {
	var classCount = $(".cnt").length;
	var all_arr_num = 28;
	cnt = 18;

	print_flag1 = document.form1.bk_info_print_flag1.value;
	if (print_flag1 == 1) {
		var btn1 = document.getElementById('nouhinbtn');
		// btn.style.backgroundColor="red";
		btn1.style.pointerEvents = "none";
		btn1.style.opacity = "0.6";
	}
	print_flag2 = document.form1.bk_info_print_flag2.value;
	if (print_flag2 == 1 || print_flag2 == 2) {
		var btn2 = document.getElementById('seikyubtn');
		btn2.style.pointerEvents = "none";
		btn2.style.opacity = "0.6";
	}
	print_flag3 = document.form1.bk_info_print_flag3.value;
	if (print_flag3 == 1) {
		var btn3 = document.getElementById('bukkenbtn');
		btn3.style.pointerEvents = "none";
		btn3.style.opacity = "0.6";
	}

	for (i = 0; i <= classCount - 1; i++) {
		var list_num = all_arr_num * i;
		var list = document.form1.elements['jyuchuname[]'][cnt + list_num].value;
		if (list == 1) {
			document.form1.elements['chumonbtn[]'][i].style.pointerEvents = "none";
			document.form1.elements['chumonbtn[]'][i].style.opacity = "0.6";
		}
	}
}

function chumonflagbtn(obj1) {
	//+28で次の行のセレクトリストへ
	var all_arr_num = 28;
	var btn_num = obj1;
	var add_num = all_arr_num * (btn_num);
	// alert(btn_num);
	cnt = 18;
	// alert(btn_name);

	document.form1.elements['jyuchuname[]'][cnt + add_num].options[1].selected = true;
	document.form1.elements['chumonbtn[]'][btn_num].style.pointerEvents = "none";
	document.form1.elements['chumonbtn[]'][btn_num].style.opacity = "0.6";
	// var btn = document.getElementById(btn_name);
	// btn.style.pointerEvents = "none";
	// btn.style.opacity = "0.6";
}

function chumonflagselect(obj1) {
	var all_arr_num = 28;
	var btn_num = obj1;
	var add_num = all_arr_num * (btn_num);
	cnt = 18;

	listValue = document.form1.elements['jyuchuname[]'][cnt + add_num].value;
	if (listValue == 1) {
		document.form1.elements['chumonbtn[]'][btn_num].style.pointerEvents = "none";
		document.form1.elements['chumonbtn[]'][btn_num].style.opacity = "0.6";
	} else {
		document.form1.elements['chumonbtn[]'][btn_num].style.pointerEvents = "auto";
		document.form1.elements['chumonbtn[]'][btn_num].style.opacity = "1";
	}
}

//Kimura Add START
/*********************************************
物件情報関連入力チェック
w_flg:遷移元画面のフラグ
	 :1=新規登録、2=編集画面
**********************************************/
function i_data_ck(w_flg) {
	var bknoa = document.form1.bknoa.value;				//物件No
	var br_id = document.form1.bk_tbl_br_id.value;		//受注元
	var jyuchu_zei = document.form1.jyuchu_zei.value;	//受注消費税
	var t_num = document.getElementsByName('tatekaename[]').length;		//立替配列要素数
	var t_element = document.getElementsByName('tatekaename[]');		//立替配列データ

	var ret;

	var ret_flg = 0;	//チェック用フラグ:不要かもしれない

	//物件Noのチェックは、新規登録時にしか行わない  //  採番は登録時にすることになったためコメントアウトしました
	// if( w_flg == 1 ){
	// 	//物件No
	// 	ret = i_strlen_ck(bknoa);
	// 	if( !ret  ){
	// 		ret_flg++;
	// 		errorConfirmDialog('4000',1);
	// 		return false;
	// 	}
	// }

	//受注元
	ret = i_strlen_ck(br_id);
	if (!ret) {
		ret_flg++;
		errorConfirmDialog('4000', 2);
		return false;
	}
	//受注消費税
	ret = i_strlen_ck(jyuchu_zei);
	if (!ret) {
		ret_flg++;
		errorConfirmDialog('4000', 3);
		return false;
	}

	//立替の配列要素数チェック
	if (w_flg == 1) {
		//新規登録の場合、立替の配列は22項目
		t_row = element_num_ck(t_num, 22);
		if (t_row > 3) {//3行以上はエラー
			ret = element_data_ck(t_element, 22, t_row);
			if (!ret) {
				ret_flg++;
				errorConfirmDialog('4000', 4);
				return false;
			}
		}
	} else {
		//更新の場合、立替の配列は27項目
		t_row = element_num_ck(t_num, 27);
		if (t_row > 3) {//3行以上はエラー
			ret = element_data_ck(t_element, 27, t_row);
			if (!ret) {
				ret_flg++;
				errorConfirmDialog('4000', 4);
				return false;
			}
		}
	}

	if (ret_flg == 0) {
		return true;
	} else {
		return false;
	}
}

/*********************************************
入力文字数チェック
str_data:入力データ
**********************************************/
function i_strlen_ck(str_data) {

	var str_num;
	var ret;

	str_num = str_data.length;

	if (str_num == 0) {
		ret = false;
	} else {
		ret = true;
	}

	return ret;
}

/*********************************************
配列要素数チェック
array_data_num:配列要素数
element_num:1行に有る項目数
**********************************************/
function element_num_ck(array_data_num, element_num) {

	var e_row;

	//何行あるか、1行にある全項目数で割る
	e_row = array_data_num / element_num;

	return e_row;

}

/*********************************************
配列要素内データ有無チェック
element_data:配列データ
element_num:1行に有る項目数
t_row:配列行数(配列要素数/1行に有る項目数)
**********************************************/
function element_data_ck(element_data, element_num, t_row) {

	var id_flg = 0;
	var n = 0;

	for (i = 0; i < t_row; i++) {
		n = element_num * i;

		//大分類IDが入っているかチェック
		ret = i_strlen_ck(element_data[n].value);
		if (ret) {
			id_flg++;
		}
	}

	if (id_flg > 3) {	//3行以上
		ret = false;
	} else {				//3行以下
		ret = true;
	}

	return ret;

}

//Kimura Add END


/* -----------------------------------------------
  物件受注関係。
  画面上段の中央、[担当者]などを入力する欄の[請求先]の文字を消した時に
  画面左上[得意先No]の入力がなかった場合
  画面右上の取引先などを空にする
-----------------------------------------------  */
function tokuiDelete(baseurl) {

	var seikyuText = document.form1.staff5.value;
	var tokuiNo = document.form1.client_code.value;

	if (seikyuText == "" && tokuiNo == "") {
		// どちらも空なら[取引先]の値をリセット
		for (i = 1; i <= 9; i++) {
			document.getElementById("torihiki_item_0" + i).value = "";
		}
		document.getElementById("torihiki_item_10").value = "";
		document.getElementById("gyousya2_item_01").value = "";
	} else if (seikyuText == "" && tokuiNo !== "") {
		// 得意先だけ値がある場合[取引先]の値にAjaxで"得意先"関係を入力
		tokuisakicode(tokuiNo, baseurl, 1);
		document.getElementById("gyousya2_item_01").value = "";
	}
}


/* ---------------------------------------
  class="znkk" とついているモノ全てで
  全角数字→半角数字の変換を行う
  キーを上げる度イベントが走る
--------------------------------------- */
function zenkakuConvert() {
	var txt = $(this).val();
	if (txt.match(/[^0-9 ０-９]/)) { // 数字以外でエラーを吐く
		errorConfirmDialog("4000", 5);
		// $(this).addClass('errRed'); // テキストボックスの背景色を赤に
	} else {
		// $(this).removeClass('errRed');
	}
	var han = txt.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) { return String.fromCharCode(s.charCodeAt(0) - 0xFEE0) });
	$(this).val(han);
}

/* ---------------------------------------
  class="znkk" とついているモノ全てで
  全角数字→半角数字の変換を行う
  キーを上げる度イベントが走る
  こちらは、半角数字にCommaが含まれていもよしとする
--------------------------------------- */
function zenkakuConvertWithOutComma() {
	var txt = $(this).val();
	if (txt.match(/[^0-9- ０-９,]/)) { // 数字以外でエラーを吐く
		$(this).val("");
		errorConfirmDialog("4000", 5);
		return;
		// $(this).addClass('errRed'); // テキストボックスの背景色を赤に
	} else {
		// $(this).removeClass('errRed');
	}
	var han = txt.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) { return String.fromCharCode(s.charCodeAt(0) - 0xFEE0) });
	$(this).val(han);
}
/* ---------------------------------------
  【物件登録】更新ボタン
  数値関係のカンマを すべて外す
--------------------------------------- */

function commaExcept() {
	var rw = getRowNum("jyuchu"); // 立替は考えていない
	rw -= 3; // おそらく行の総数からヘッダー部分を抜いてる
	var idx = 0;

	for (i = 0; i <= rw; i++) {
		document.form1.elements['jyuchuname[]'][5 + idx].value = document.form1.elements['jyuchuname[]'][5 + idx].value.split(",").join(""); // 数量(受注)
		document.form1.elements['jyuchuname[]'][7 + idx].value = document.form1.elements['jyuchuname[]'][7 + idx].value.split(",").join(""); // 単価(受注)
		document.form1.elements['jyuchuname[]'][8 + idx].value = document.form1.elements['jyuchuname[]'][8 + idx].value.split(",").join(""); // 棟(受注)
		document.form1.elements['jyuchuname[]'][9 + idx].value = document.form1.elements['jyuchuname[]'][9 + idx].value.split(",").join(""); // 受注金額(税抜)

		document.form1.elements['jyuchuname[]'][5 + idx].value = document.form1.elements['jyuchuname[]'][5 + idx].value.split(",").join(""); // 数量(受注)
		document.form1.elements['jyuchuname[]'][7 + idx].value = document.form1.elements['jyuchuname[]'][7 + idx].value.split(",").join(""); // 単価(受注)
		document.form1.elements['jyuchuname[]'][8 + idx].value = document.form1.elements['jyuchuname[]'][8 + idx].value.split(",").join(""); // 棟(受注)
		document.form1.elements['jyuchuname[]'][9 + idx].value = document.form1.elements['jyuchuname[]'][9 + idx].value.split(",").join(""); // 受注金額(税抜)

		document.form1.elements['jyuchuname[]'][13 + idx].value = document.form1.elements['jyuchuname[]'][13 + idx].value.split(",").join(""); // 数量(外注)
		document.form1.elements['jyuchuname[]'][15 + idx].value = document.form1.elements['jyuchuname[]'][15 + idx].value.split(",").join(""); // 単価(外注)
		document.form1.elements['jyuchuname[]'][16 + idx].value = document.form1.elements['jyuchuname[]'][16 + idx].value.split(",").join(""); // 外注金額(税抜)

		idx += NAME_SUU;
	}

	idx = 0;
	for (i = 0; i < 3; i++) {
		document.form1.elements['tatekaename[]'][5 + idx].value = document.form1.elements['tatekaename[]'][5 + idx].value.split(",").join(""); // 数量(受注)
		document.form1.elements['tatekaename[]'][7 + idx].value = document.form1.elements['tatekaename[]'][7 + idx].value.split(",").join(""); // 単価(受注)
		document.form1.elements['tatekaename[]'][8 + idx].value = document.form1.elements['tatekaename[]'][8 + idx].value.split(",").join(""); // 立替金額(税込)(受注)

		document.form1.elements['tatekaename[]'][12 + idx].value = document.form1.elements['tatekaename[]'][12 + idx].value.split(",").join(""); // 数量(外注)
		document.form1.elements['tatekaename[]'][14 + idx].value = document.form1.elements['tatekaename[]'][14 + idx].value.split(",").join(""); // 単価(外注)
		document.form1.elements['tatekaename[]'][15 + idx].value = document.form1.elements['tatekaename[]'][15 + idx].value.split(",").join(""); // 立替金額(税込)(外注)

		document.form1.elements['jyuchu_syokei'].value = document.form1.elements['jyuchu_syokei'].value.split(",").join(""); // 受注小計
		document.form1.elements['gaichu_syokei'].value = document.form1.elements['gaichu_syokei'].value.split(",").join(""); // 外注小計
		document.form1.elements['tatekae_jyuchu_syokei'].value = document.form1.elements['tatekae_jyuchu_syokei'].value.split(",").join(""); // 立替受注小計
		document.form1.elements['tatekae_gaichu_syokei'].value = document.form1.elements['tatekae_gaichu_syokei'].value.split(",").join(""); // 立替外注小計

		idx += TATEKAENAME_SUU;
	}

	var youso = 0;
	for (i = 18; i < 35; i++) {
		if (i != 22) {
			youso = "dialog_item" + i;
			document.getElementById(youso).value = document.getElementById(youso).value.split(",").join("");
		}
	}

	do_submit('form1'); //フォームの送信




}
function showIkkatuConfirm(kubetu, name, action) {
	$k = kubetu;
	$n = name;
	$a = action;
	justConfirmDialog('更新してもよろしいですか？', function (k, n, a) {
		$("#" + name).attr('action', action);
		setHiddenValue(kubetu);
		if (kubetu == 1) {
			jyuchu_ikkatu_select(name);
		} else {
			gaichu_ikkatu_select(name);
		}
	})
}

function ajax_bukken_update(type, url, kengen) {
	var data = { value1: $('a').val(), value2: $('#getujidate').val(), value3: $('a'), value4: $('a') };
	var param1 = $('a').val();
	var param2 = $("#getujidate").val();
	var param3 = $('a').val();
	var param4 = $('a').val();
	var url_val = url;
	// var paramitiran = '#getuji_dialog-form';
	/**
	 * Ajax通信メソッド
	 * @param type      : HTTP通信の種類
	 * @param url       : リクエスト送信先のURL
	 * @param dataType  : データの種類
	 */
	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		data: { "value1": param1, "value2": param2, "value3": param3, "value4": param4 },
		/**
		 * Ajax通信が成功した場合に呼び出されるメソッド
		 */
		success: function (data, dataType) {
			//結果が0件の場合
			if ((data.length == 0) || (data == null)) //alert('データが0件でした');
				errorConfirmDialog('0000', 4);

			if (type == 1) {
				var nouhin = document.getElementsByName("den_date1");
				var nouhinDate = new Date(nouhin[0].value);
				var monthlyDate = new Date(data['monthly_date']);
				if (nouhinDate.getFullYear() + "/" + ("0" + (nouhinDate.getMonth() + 1)).slice(-2) < data['monthly_date'] && kengen < 4) {
					errorConfirmDialog('9000', 1);
				}
				else {
					javascript: disable_reset();
				}
			}
			/*******************************/
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			errorConfirmDialog('0000', 5);
		}
	});
}
function ichiran_search_box() { //  従来の検索フォームに物件名と得意先名を代入して、そのフォームからPOST
	document.getElementById("select_item9").value = document.getElementById("ichiran_search_box_bukken").value;
	document.getElementById("select_item6").value = document.getElementById("ichiran_search_box_tokuisaki").value;
	if (document.getElementById("ichiran_search_box_zensha").checked) {
		document.getElementsByName("ichiran-form6")[0][0].selected = true;
	}
	else if (document.getElementById("ichiran_search_box_tokyo").checked) {
		document.getElementsByName("ichiran-form6")[0][1].selected = true;
	}
	else if (document.getElementById("ichiran_search_box_osaka").checked) {
		document.getElementsByName("ichiran-form6")[0][2].selected = true;
	}
	else if (document.getElementById("ichiran_search_box_honsha").checked) {
		document.getElementsByName("ichiran-form6")[0][3].selected = true;
	}
	document.getElementById("select_item23").value = document.getElementById("ichiran_search_box_edit_name").value; // 最終更新者

	do_submit('ichiran-form'); // 更新処理 へジャンプ(tplのフォームのサブミット)
}
function reset_bukken_search() {
	for (i = 0; i < 20; i++) {
		var str = "select_item" + i;
		$("#" + str).val("");
	}
	$('[name=ichiran-form6]').val($("#userOfficeGetting").text());
	$('[name=ichiran-form7]').val("");
	$('[name=ichiran-form8]').val("");
	$('[name=ichiran-form11]').val("");
	$('[name=ichiran-form23]').val(""); // 最終更新者
	do_submit('ichiran-form');
}
function reset_ichiran_search() {
	reset_bukken_search();
	//  非連動させたい場合はこちら
	// $("#ichiran_search_box_tokuisaki").val("");
	// $("#ichiran_search_box_bukken").val("");
	// $("#ichiran_search_box_zensha:eq(0)").prop('checked', true);
	do_submit('ichiran-form');
}

function set_ikanValue() {
	$("#ikan_flg_val").val($("#select8").val());
}

//	移管設定時、受注元の変更をさせない
function check_ikanFlg() {
	if ($("#select8").val() != 0) {
		errorConfirmDialog('4000', 201);
		$("#select1").val(bukken_br_selectValue);
	}
}
$(document).on("click", ".ui-dialog .dialog_footer .prints", function () {
	$(this).closest(".ui-dialog-content").dialog("close");
});

function setCheckboxExport() {
	$('.tr_type_check_export input[type="checkbox"]').each(function () {
		$(this).prop("checked", true);
	});
}

function exportSubmit() {
	//0埋め
	var count = $("#export_select_item0").val().length;

	if (count == 9) {
		$("#export_select_item0").val($("#export_select_item0").val() + '1');
	} else if (count == 7) {
		$("#export_select_item0").val($("#export_select_item0").val() + '/01')
	}

	do_submit('export_dialog');

}

function today() {
	var date = new Date();
	//var format = 'YYYY/MM/DD';
	var format = 'YYYY/MM';
	format = format.replace(/YYYY/g, date.getFullYear());
	format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
	//format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));

	$("#export_select_item0").val(format);
}

function selectExportDialog(title, action) {
	$("#export-select").dialog({
		modal: true,
		title: '<i class="fa fa-print"></i>' + title,
		height: "auto",
		width: 600,
		open: function (event) {
			//ダイアログを開くタイミングでアクションの書き換え
			//document.getElementById("export_dialog_form").setAttribute("action",action);
			//JQueryでやった方がいい？
			$("#export_dialog_form").attr('action', action);
		},
		close: function () {
		}
	});
}

$(document).on("click", ".ui-dialog .dialog_footer .prints", function () {
	$(this).closest(".ui-dialog-content").dialog("close");
});

function setCheckboxExport() {
	$('.tr_type_check_export input[type="checkbox"]').each(function () {
		$(this).prop("checked", true);
	});
}


/**
* 新規「承認者」「承認日」を設定
*/
function setNewAccepter() {
	if ($("select[name='accept_new_flg_select']").val() == "1") {
		// ユーザー情報取得
		var userInfo = ajax_getuserinfo();
		if (userInfo != null) {
			$("input[name='accept_new_flg']").val("1");
			$("input[name='accept_new_name']").val(userInfo.name);
			$("input[name='accept_new_date']").val(getDay());
		}
		return;
	}
	$("input[name='accept_new_flg']").val("0");
	$("input[name='accept_new_name']").val("");
	$("input[name='accept_new_date']").val("");
}

/**
* 変更「承認者」「承認日」を設定
*/
function setEditAccepter() {
	if ($("select[name='accept_edit_flg_select']").val() == "1") {
		// ユーザー情報取得
		var userInfo = ajax_getuserinfo();
		if (userInfo != null) {
			$("input[name='accept_edit_flg']").val("1");
			$("input[name='accept_edit_name']").val(userInfo.name);
			$("input[name='accept_edit_date']").val(getDay());
		}
		return;
	}
	$("input[name='accept_edit_flg']").val("0");
	$("input[name='accept_edit_name']").val("");
	$("input[name='accept_edit_date']").val("");
}

/**
* 完了「承認者」「承認日」を設定
*/
function setDoneAccepter() {
	if ($("select[name='accept_done_flg_select']").val() == "1") {
		// ユーザー情報取得
		var userInfo = ajax_getuserinfo();
		if (userInfo != null) {
			$("input[name='accept_done_flg']").val("1");
			$("input[name='accept_done_name']").val(userInfo.name);
			$("input[name='accept_done_date']").val(getDay());
		}
		return;
	}
	$("input[name='accept_done_flg']").val("0");
	$("input[name='accept_done_name']").val("");
	$("input[name='accept_done_date']").val("");
}
/*
*  ログインユーザー情報を取得
*/
function ajax_getuserinfo() {
	var url_val = $baseUrl + '/ajax/loginuserinfoget';
	var result = null;

	$.ajax({
		type: "POST",
		url: url_val,
		dataType: "json",
		async: false,
		/**
		 * 通信：成功
		 */
		success: function (data, dataType) {
			// console.log(data.name);
			result = data;
		},
		/**
		 * 通信：失敗
		 */
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			//エラーメッセージの表示
			errorConfirmDialog('0000', 5);
		}
	});
	return result;
}

function check_checked_flg() {
	if ($("input[name='changed_flg_check']").attr("checked") == "checked") {
		$("#changed_flg").val("1");
	} else {
		$("#changed_flg").val("0");
	}
}