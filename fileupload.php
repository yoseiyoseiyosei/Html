<html>
<head>
		<meta charset"=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>fileuppoad</title>
	<style>
    .uploadButton {
    display:inline-block;
    position:relative;
    overflow:hidden;
    border-radius:3px;
    background:#099;
    color:#fff;
    text-align:center;
    padding:10px;
    line-height:30px;
    width:100%;
    height:100%;
    cursor:pointer;
}
.uploadButton:hover {
    background:#0aa;
}
.uploadButton input[type=file] {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;    
    cursor:pointer;
    opacity:0;
}
.uploadValue {
    display:none;
    background:rgba(255,255,255,0.2);
    border-radius:3px;
    padding:3px;
    color:#ffffff;
}
    </style>
</head>
<body>
												<div class="uploadButton">
                                                    <p>写真を選択</p><br>
                                                <input type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" />
                                                <input type="text" id="uv" class="uploadValue" />
                                                </div>
                                                
 												<div class="uploadButton">
                                                    <p>youtube動画のID</p><br>
                                                <input type="text" name="do_movie_0" />
                                                </div>

	
</body>
</html>