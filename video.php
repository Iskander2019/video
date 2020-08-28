<?php
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="jQuery/jquery-3.3.1.min.js"></script>
    <title>VIDEO</title>

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
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
        window.URL = window.URL || window.webkitURL;
        navigator.getUserMedia({
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
            var quality = 0.5;
            if (localMediaStream && !isBroadcasting) {
                isBroadcasting = true;
                //               console.log("555")
                //               var dataURL = canvas.toDataURL();
                //               console.log(dataURL);
                $.post("Server_Video1.php", {
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
            broadcastingTimer = setInterval(sendSnapshot, 1000);
        }

        function stopBroadcasting() {
            clearInterval(broadcastingTimer);
        }
    </script>

<!-- https://habr.com/ru/post/172419/
    https://stackoverflow.com/questions/27120757/failed-to-execute-createobjecturl-on-url
-->