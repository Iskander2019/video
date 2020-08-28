

    <p id="p1"></p>
    <img id="image" />
    <script>
        i = 0;  
        var last_message_id = 0,
            load_in_process = false;
        function Load() {
            i++;
            if (!load_in_process) {
                load_in_process = true;
                $.post("Video/Server_Video1.php", {
                        p: "ajax",
                        last: last_message_id
                    },
                    function(result) {
  //                 console.log(result);
                        load_in_process = false;                
                        document.getElementById("countframe").innerText = i;
                   $("#p1").html("<img src=" + result + " />");
                    });
            }
        }

        var loadInterval = setInterval(Load, 300);
    </script>
    <p id="countframe"></p>
    <img src="data:image/gif;base64,R0lGODlhEAAOALMAAOazToeHh0tLS/7LZv/0jvb29t/f3//Ub//ge8WSLf/rhf/3kdbW1mxsbP//mf///yH5BAAAAAAALAAAAAAQAA4AAARe8L1Ekyky67QZ1hLnjM5UUde0ECwLJoExKcppV0aCcGCmTIHEIUEqjgaORCMxIC6e0CcguWw6aFjsVMkkIr7g77ZKPJjPZqIyd7sJAgVGoEGv2xsBxqNgYPj/gAwXEQA7"
        width="16" height="14" alt="внедренная иконка папки" />




