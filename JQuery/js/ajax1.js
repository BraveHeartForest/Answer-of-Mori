<script>
	$(function () {
		$('#jquery-sample-button').toggle(
			function () {
				jQuery.ajax({   //JQuery.ajaxは$.ajaxに出来ない？
					url: 'jquery-sample-ajax-html.html',
					success: function (data) {  //dataって何？
						$('#jquery-sample-ajax').html(data);
						$('#jquery-sample-textStatus').text('読み込み成功');
					},
					error: function (data) {
						$('#jquery-sample-textStatus').text('読み込み失敗');
					}
				});
			},
			function () {
				$('#jquery-sample-ajax').html('');
				$('#jquery-sample-textStatus').text('');
			}
		)
	});
</script>