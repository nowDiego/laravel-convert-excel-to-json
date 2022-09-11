<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import</title>
    <style>
       
        main{
            display: flex;
            justify-content: center;
            align-items: start;           
            height: 95vh;            
        }
        form{
            display: flex;
            flex-direction: column;           
            gap: 10px;     
            margin-top:25px                   
        }
    </style>
</head>
<body>
    <main>

        <form action="{{url('excel')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Selecionar um arquivo Excel</label>
        <input type="file" name="file" id="file">
         <button type="submit"> Enviar </button>
        
        
        </form>

    </main>
    

</body>
</html>