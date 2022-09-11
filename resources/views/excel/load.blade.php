<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download </title>
    @vite('resources/js/app.js')
    <style> 
    main{
        display: flex;
            justify-content: center;
            align-items: start;           
            height: 95vh;  
        }
    </style>
</head>
<body>
  <main>
    <section id="wrapper">

        <p> Seu arquivo está sendo convertido, aguarde um momento...</p>

    </section>
</main>

    <script type="module">

        var wrapper = document.getElementById("wrapper");
       
        window.Echo.channel('channel-import')
        .listen('ChannelExcelImport',(e)=>{

            if(e.status){
            wrapper.innerHTML = 
            '<div>'+
                '<p>Seu download está pronto!!!<p>'
                +
                '<a href="'+e.url+'">Download Json</a>'
                +'</div>';
            console.log(e.url);
            }
        });

    </script>
    
</body>
</html>