jQuery(document).ready(function($) {

  var prefix_do_text = 'do_text_'; // 品目入力欄のname属性の接頭辞
  var prefix_do_pic = 'do_pic_';
  var prefix_do_movie = 'do_movie_';
  var inline='inline-block';
	// "品目の追加"ボタンを押した場合の処理
	$('#btn_add2').click(function(){
		// 品目入力欄を追加
		var len_list = $('#report_list > li').length;
		var new_list = '<li><div id="single-project"><div id="slidingDiv" class="row-fluid single-project"><div class="span4"><div class="uploadButton"><p>写真を選択</p><br><input type="file" onchange="uv'+len_list+'.style.display='+inline+'; uv'+len_list+'.value = this.value;" name="'+prefix_do_pic+len_list+'" /><input type="text" id="uv'+len_list+'" class="uploadValue" disabled /></div><div class="uploadButton"><p>youtube動画のID</p><br><input type="text" name="'+prefix_do_movie+len_list+'" /></div></div><div class="span8"><div class="project-description"><div class="project-title clearfix"><h3>DO:ページ<?php echo "1"; ?></h3></div><div class="project-info"><div><textarea name="'+prefix_do_text+len_list+'" id="" cols="30" rows="10"></textarea></div></div></div></div></div></div></li>';
		$('#report_list').append(new_list);

		// 削除ボタンの一旦全消去し、配置し直す
		$('#report_list input[type="button"]').remove();
		len_list++;
		for (var i = 0; i < len_list; i++) {
			var new_btn = '<input type="button" value="削除">';
			$('#report_list > li').eq(i).append(new_btn);
		}
			
	});

		// 削除ボタンを押した場合の処理
	$(document).on('click', '#report_list input[type="button"]', function(ev) {
		// 品目入力欄を削除
		var idx = $(ev.target).parent().index();
		$('#report_list > li').eq(idx).remove();

		var len_list = $('#report_list > li').length;

		// 入力欄がひとつになるなら、削除ボタンは不要なので消去
		if (len_list == 1) $('#report_list input[type="button"]').remove();

		// 入力欄の番号を振り直す
		for (var i=0; i<len_list; i++) {
			$('#report_list > li').eq(i).children('input[type="text"]').attr('name', prefix_do_text + i);
		}
	});
});
						

