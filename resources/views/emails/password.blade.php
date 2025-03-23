<!DOCTYPE html>
<html>
<head>
    <title>Nueva Contraseña</title>
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
        <h1>Nueva contraseña</h2>

        <p style="font-size: 15px; font-weight: lighter">
            Tu nueva contraseña es: {{ $data['password'] }}
        </p>

        <p style="font-size: 15px; font-weight: lighter">
            Al ingresar puedes cambiar tu contraseña al ingresar a tu perfil
        </p>

        <span style="font-size: 15px; font-weight: bold">Cada paso te llevará donde quieres estar.</span><br><br>

        <hr style="border: white">
  </div>
</body>
</html>
