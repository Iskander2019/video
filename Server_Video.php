<?php
session_start();

//$img="";
	if(isset($_POST['p']) && ($_POST['p']=="ajax")){          // Запрос для отображения на странице  
	if(isset($_SESSION["img"])){	echo $_SESSION["img"];
//$_SESSION["img"]="";
	}
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
 //	session_write_close();
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





