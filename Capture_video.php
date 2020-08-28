<?php
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../jQuery/jquery-3.3.1.min.js"></script>
    <title>Capture_VIDEO</title>
    <style>
        #button_Show_Image{
            
            height: 20px;
            background-color: #AADDEE;
        }
        button{
            border-radius: 10px;
            width: 150px; 
        }
    </style>
    <video autoplay id="vid" style="display:none;"></video>
    <canvas id="canvas" width="640" height="480" style="border:5px solid #240655;"></canvas><br><br>
    <button id="start" onclick="startBroadcasting()">Передача  видео</button>
    <button id="stop" onclick="stopBroadcasting()">Стоп передачи  видео</button>
    <br><br>
    <button id="button_Show_Image" onclick=ShowImage()>Выключено</button>
    <script>
        var ImageShow=true;
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
            video.srcObject = stream;
            localMediaStream = stream;
        }, onCameraFail);
        var enumeratorPromise = navigator.mediaDevices.enumerateDevices();
console.log(enumeratorPromise);
//*******************************                   ПЕРЕЧЕНЬ КАМЕР
navigator.mediaDevices.enumerateDevices().then(function(devices) {
  devices.forEach(function(device) {
    console.log(device.kind + ": " + device.label + " id = " + device.deviceId);
  });
})
.catch(function(err) {
  console.log(err.name + ": " + err.message);
});
        cameraInterval = setInterval(function() {
            snapshot();
        }, 150);

        function snapshot() {
            if (localMediaStream) {
                if(ImageShow)
                    ctx.drawImage(video, 0, 0);
            }
        }
        // ******************************                                                               отправка на СЕРВЕР
        var isBroadcasting = false,
            broadcastingTimer;

        function sendSnapshot() {
            var quality = 0.1;
            if (localMediaStream && !isBroadcasting) {
                isBroadcasting = true;
                $.post("Server_Video.php", {
                        p: "new",
                        text: ctx.canvas.toDataURL("image/webp", quality) // quality - качество изображения(float)
                    },
                    function(result) {
  //                      console.log(result); // На случай, если что-то пойдёт не так
                        isBroadcasting = false;
                    }
                );
            }
        }

        // И добавим обработчики кнопок начала и завершения вещания
        function startBroadcasting() {
            broadcastingTimer = setInterval(sendSnapshot, 200);
            document.getElementById("stop").style.backgroundColor='#AA3333';
            document.getElementById("start").style.backgroundColor='#11DD66';
        }

        function stopBroadcasting() {
            clearInterval(broadcastingTimer);
            document.getElementById("start").style.backgroundColor='#AA3333';
            document.getElementById("stop").style.backgroundColor='#11DD66';
            console.log("STOP");
        }
        function ShowImage(){                                   //Показывать/не показывать картинку
            var button_text=document.getElementById("button_Show_Image")
            if(ImageShow)   {
              ImageShow=false;
              button_text.innerText="Выключено";
              button_text.style.background="#AADDEE"
            }
            else  {
                ImageShow=true;
                button_text.innerText="Включено";
                button_text.style.background="#11DD00";
            }
        }
stopBroadcasting();
    </script>

<!-- https://habr.com/ru/post/172419/
    https://stackoverflow.com/questions/27120757/failed-to-execute-createobjecturl-on-url
    https://webo.in/articles/habrahabr/29-all-about-data-url-images/
https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/enumerateDevices?WT.mc_id=13558-DEV-codeproject-article35
-->