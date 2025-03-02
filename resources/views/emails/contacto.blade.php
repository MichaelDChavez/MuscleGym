<!DOCTYPE html>
<html>
<head>
    <title>Contacto LevelGym</title>
</head>
<body style="margin-inline: auto">
  <div style="margin-inline: auto;
    	border: 2px solid;
    	text-align: center;
    	width: 500px;
    	padding: 10px;
    	border-radius: 10px;
    	box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
        <img src="http://drive.google.com/uc?export=view&id=1ZVMOpxr4Kafa0_W-MQ779almOA-LyI1Q" />
        <h1>Tu registro fue exitoso.</h2>
        <p style="font-size: 15px; font-weight: lighter">Hola {{$data['nombre']}},</p>
        <p style="font-size: 15px; font-weight: lighter">Nos estaremos contactando contigo por {{ $data['medioContacto'] }},
            para dar respuesta a tu solicitud y resolver tus dudas.</p>

        <span style="font-size: 15px; font-weight: bold">Recuerda: Cada paso te llevará donde quieres estar.</span><br><br>
        <a style="background-color: orange;
            padding: 10px;
            text-decoration: none;
            margin: 10px;
            border-radius: 10px" href="http://localhost:8000">Visita nuestra página</a><br>
        <hr style="border: white">
  </div>
</body>
</html>
