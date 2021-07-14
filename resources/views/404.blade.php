<head>
<meta charset="utf-8">
    <link href="css/errorPage.css" rel="stylesheet">
    <script>
        
    </script>
    
</head>
<main>
  <div class="container">
    <span style="display: flex; flex-direction: column; justify-content: center; align-items: center">
        <img src="../public/img/UCA.6b065e25.png" alt="uca" style="width: 164px; height: 220px;">
        <p style="font-family: 'Abel'; font-size: 10px; color: white">Centro de Servicio Social</p>
    </span>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
        <h1>Oops, parece que algo salió mal.</h1>
        <p>La página que está buscando no existe o no está disponible temporalmente.</p>
        <p>Puede usar este botón para regresar.</p>
        <div class="d-flex justify-content-center">
            <form action="{{url('/')}}" method="post">
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2 mx-auto" style="background-image: linear-gradient( 109.6deg,  rgba(39,142,255,1) 11.2%, rgba(98,113,255,0.78) 100.2% );" type="submit">Regresar</button>
            </form>
            
        </div>
    </div>
    
</div>
</main>