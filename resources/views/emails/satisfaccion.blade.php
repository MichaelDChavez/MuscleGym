<!DOCTYPE html>
<html>
<head>
    <title>Encuesta de Satisfaccion LevelGym</title>
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
        <h1>Encuesta de satisfacción</h2>
        <p style="font-size: 15px; font-weight: lighter">
            Selecciona la opción con la que te sientas más de acuerdo
        </p>
        <p style="font-size: 15px; font-weight: lighter">
            Recuerda que esto nos ayuda a mejorar
        </p>
        <span style="font-size: 15px; font-weight: bold">Cada paso te llevará donde quieres estar.</span><br><br>
        <a style="background-color: red;
            padding: 10px;
            text-decoration: none;
            margin-block: 10px;
            color: white;
            border-radius: 10px" href="{{ route('api.satisfaccion', [
                'idUsuario' => $data['id'],
                'idRespuesta' => 1
            ]) }}">Malo</a>
            <a style="background-color: yellow;
            padding: 10px;
            text-decoration: none;
            margin-block: 10px;
            border-radius: 10px" href="{{ route('api.satisfaccion', [
                'idUsuario' => $data['id'],
                'idRespuesta' => 2
            ]) }}">Regular</a>
            <a style="background-color: skyblue;
            padding: 10px;
            text-decoration: none;
            margin-block: 10px;
            border-radius: 10px" href="{{ route('api.satisfaccion', [
                'idUsuario' => $data['id'],
                'idRespuesta' => 3
            ]) }}">Bueno</a><br>
            <br>

        <hr style="border: white">
  </div>
</body>
</html>
