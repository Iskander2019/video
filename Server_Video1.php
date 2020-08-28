<?php
session_start();

//$img="";
	if(isset($_POST['p']) && ($_POST['p']=="ajax")){          // Запрос для отображения на странице  
	if(isset($_SESSION["img"]))	echo $_SESSION["img"];

/*        $file = file("monitor_id.txt");
	    $id = $file[0];
	    if($id > $_POST['last']){
		    $text_file = file("monitor_command.txt");
		    $count = count($text_file);
		    $last = $id;
//		    echo "var main = $('#main'); \n";
		    for($i = 0; $i < 1; $i++){
			    $s = $text_file[$i];
			    while(strpos($s, chr(92)) !== false){
				    $s = str_replace(chr(92), "", $s);
			   }	
		    }	
        }*/
 	
    }
//**************************************************************** */
    elseif((isset($_POST['p']) && $_POST['p'] == "new") || (isset($_POST['p']))){		// Получение картинки с WEB камеры

	    $_SESSION["img"]= $_POST['text'];																	// Получил картинку

$img1='"data:image/gif;base64,R0lGODlhEAAOALMAAOazToeHh0tLS/7LZv/0jvb29t/f3//Ub//ge8WSLf/rhf/3kdbW1mxsbP//mf///yH5BAAAAAAALAAAAAAQAA4AAARe8L1Ekyky67QZ1hLnjM5UUde0ECwLJoExKcppV0aCcGCmTIHEIUEqjgaORCMxIC6e0CcguWw6aFjsVMkkIr7g77ZKPJjPZqIyd7sJAgVGoEGv2xsBxqNgYPj/gAwXEQA7" width="16" height="14" alt="внедренная РИСУНОК"';
$img2='"data:image/gif;base64,R0lGODlhEAAOALMAAOazToeHh0tLS/7LZv/0jvb29t/f3//Ub//ge8WSLf/rhf/3kdbW1mxsbP//mf///yH5BAAAAAAALAAAAAAQAA4AAARe8L1Ekyky67QZ1hLnjM5UUde0ECwLJoExKcppV0aCcGCmTIHEIUEqjgaORCMxIC6e0CcguWw6aFjsVMkkIr7g77ZKPJjPZqIyd7sJAgVGoEGv2xsBxqNgYPj/gAwXEQA7"
        width="16" height="14" alt="внедренная иконка папки"';

	}
//	echo "FFF=".$_SESSION["img"];
?>
    <p id="vid">11111vvv22</p>
  <script type="text/javascript" src="../jQuery/jquery-3.3.1.min.js"></script>
<script>
	function Show(){
//		$("#vid").html('<img src=' + <?php //echo $im"g2; ?> + '/>');
//console.log(<?php // if(isset($_SESSION["img"]))	echo "66666666"; ?>);
	}
	var aa=setInterval(Show,200);

        i = 0;
        var im = "708.png";
        var last_message_id = 0,
            load_in_process = false;

        function Load() {

            i++;
            if (!load_in_process) {
                load_in_process = true;
                $.post("Server_Video1.php", {
                        p: "ajax",
                        last: last_message_id
                    },
                    function(result) {
                        //                      var aa = '<img src=' + result + ' />';
                        //                      eval(aa);
                        console.log("FF="+result);
                        load_in_process = false;
                        document.getElementById("countframe").innerText = i;
                        $("#p").html("<img src=" + result + " />");
                    });
            }
        }
        var loadInterval = setInterval(Load, 1000);
    </script>

<p id="p"></p>
    <p id="countframe"></p>



