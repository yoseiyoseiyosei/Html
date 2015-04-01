$(function(){

//モーダルウィンドウを出現させるクリックイベント
$("#modal-open").click(function(){

	//オーバーレイを出現させる
	$("body").append('<div id="modal-overlay"></div>');
	$("#modal-overlay").fadeIn("slow");

	//コンテンツをセンタリングする
	centeringModalSyncer();

	//コンテンツをフェードインする
	$("#modal-content").fadeIn("slow");

	//[#modal-overlay]、または[#modal-close]をクリックしたら…
	$("#modal-overlay,#modal-close").unbind().click(function(){

		//[#modal-content]と[#modal-overlay]をフェードアウトした後に…
		$("#modal-content,#modal-overlay").fadeOut("slow",function(){

			//[#modal-overlay]を削除する
			$('#modal-overlay').remove();

		});

	});

});

//リサイズされたら、センタリングをする関数[centeringModalSyncer()]を実行する
$(window).resize(centeringModalSyncer);

	//センタリングを実行する関数
	function centeringModalSyncer(){

		//画面(ウィンドウ)の幅、高さを取得
		var w = $(window).width();
		var h = $(window).height();

		//コンテンツ(#modal-content)の幅、高さを取得
		var cw = $("#modal-content").outerWidth({margin:true});
		var ch = $("#modal-content").outerHeight({margin:true});

		//コンテンツ(#modal-content)を真ん中に配置するのに、左端から何ピクセル離せばいいか？を計算して、変数[pxleft]に格納
	var pxleft = ((w - cw)/2);

	//コンテンツ(#modal-content)を真ん中に配置するのに、上部から何ピクセル離せばいいか？を計算して、変数[pxtop]に格納
	var pxtop = ((h - ch)/2);

	//[#modal-content]のCSSに[left]の値(pxleft)を設定
	$("#modal-content").css({"left": pxleft + "px"});

	//[#modal-content]のCSSに[top]の値(pxtop)を設定
	$("#modal-content").css({"top": pxtop + "px"});


	}

});
