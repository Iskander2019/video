<script type="text/javascript" src="jQuery/jquery-3.3.1.min.js"></script>
<video autoplay id="vid" style="display:none;"></video>
    <canvas id="canvas" width="640" height="480" style="border:5px solid #240655;"></canvas><br>
    <button onclick="startBroadcasting()">Передача  видео</button>
    <button onclick="stopBroadcasting()">Стоп передачи  видео</button>
    <script>
        var video = document.querySelector("#vid"),
            canvas = document.querySelector('#canvas'),
            ctx = canvas.getContext('2d'),
            localMediaStream = null,
            onCameraFail = function(e) {
                console.log('Camera did not work.', e); // Исключение на случай, если камера не работает
            };
        navigator.getUserMedia =( navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
        window.URL = window.URL || window.webkitURL;
        navigator.getUserMedia({
 //       navigator.mediaDevices.getUserMedia({
            video: true
        }, function(stream) {
            //           video.src = window.URL.createObjectURL(stream);
            video.srcObject = stream;
            localMediaStream = stream;
        }, onCameraFail);


        cameraInterval = setInterval(function() {
            snapshot();
        }, 1);

        function snapshot() {
            if (localMediaStream) {
                ctx.drawImage(video, 0, 0);
            }
        }
        // ******************************отправка на СЕРВЕР
        var isBroadcasting = false,
            broadcastingTimer;

        function sendSnapshot() {
            var quality = 0.4;
            if (localMediaStream && !isBroadcasting) {
                isBroadcasting = true;
                //               console.log("555")
                //               var dataURL = canvas.toDataURL();
                //               console.log(dataURL);
                $.post("/", {
                        p: "new",
                        text: ctx.canvas.toDataURL("image/webp", quality) // quality - качество изображения(float)

                    },
                    function(result) {
                        console.log("UUUUU=" + result); // На случай, если что-то пойдёт не так
                        isBroadcasting = false;
                    }
                );
            }
        }

        // И добавим обработчики кнопок начала и завершения вещания
        function startBroadcasting() {
            broadcastingTimer = setInterval(sendSnapshot, 1);
        }

        function stopBroadcasting() {
            clearInterval(broadcastingTimer);
        }
    </script>
<?php

//if(isset($_POST["p"])){
    if(isset($_POST['p'])&&($_POST['p']=="ajax")){
	    Header("Cache-Control: no-cache, must-revalidate");
	    Header("Pragma: no-cache");
	    Header("Content-Type: text/javascript; charset=windows-1251");
	    $file = file("monitor_id.txt");
	    $id = $file[0];
	    if($id > $_GET['last']){
		    $text_file = file("monitor_command.txt");
		    $count = count($text_file);
		    $last = $id;
		    echo "var main = $('#main'); \n";
		    for($i = 0; $i < 1; $i++){
			    $s = $text_file[$i];
			    while(strpos($s, chr(92)) !== false){
				    $s = str_replace(chr(92), "", $s);
			   }
			echo $s;
		    }
		    echo "\n";
    	    echo "last_message_id = $id;";
        }
    }
    elseif((isset($_POST['p']) && $_POST['p'] == "new") || (isset($_POST['p']))){		// Получение картинки
	    $file = file("monitor_id.txt");
	    $id = $file[0];
	    $fh = fopen("monitor_command.txt", "w+");
	    $get_text = $_POST['text'];
	    $gt = $get_text;
	    while(strpos($get_text, "\r\n") !== false){
		    $get_text = str_replace("\r\n", "<br>", $get_text);
	    }
//	    fwrite($fh, "document.body.innerHTML = <img src=".'"'.$get_text.'"'."/>;\n");
fwrite($fh, "document.body.innerHTML = ('<img src=".'"'.".$get_text".'"'."/>);\n");
fclose($fh);
      
	    $fhn = fopen("monitor_id.txt", "w+");
	    fwrite($fhn, $id + 1);
	    fclose($fhn);
	    echo $get_text;

    }
//}

?>

<script>
/*var last_message_id = 0, 
	load_in_process = false; 
function Load() {
    if(!load_in_process)
    {
	    load_in_process = true;
    	$.post("/", 
    	{
      	    p: "ajax", 
      	    last: last_message_id,
//			version: version
    	},
   	    function (result) {
		    eval(result);
//			console.log(result);
		    load_in_process = false; 
    	}
		);
    }
}
var loadInterval = setInterval(Load, 100);*/
</script>
