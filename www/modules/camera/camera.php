<!-- modules/camera/camera.php -->
<center>
	<img class="thumbnail" id="stream" src="modules/camera/snapshot.php" onError="this.onerror=null;this.src='noimage.png';">

	<div class="btn-group">
		<button type="button" onClick="camera_refresh()" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-repeat"></span></button>
		<button type="button" onClick="camera_play()" class="btn btn-default btn-lg"><span id="playstop" class="glyphicon glyphicon-play"></span></button>
		<button type="button" class="btn btn-default btn-lg"><span id="fullscreen" class="glyphicon glyphicon-fullscreen"></span></button>
	</div>

</center>
<br>