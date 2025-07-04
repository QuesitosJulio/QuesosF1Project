<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formula 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /*Estilo del contenedor*/
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-image: url('img/formula1.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .contenedor {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.6);
        }

        header {
            display: flex;
            align-items: center;         
            justify-content: center;     
            padding: 10px 20px;
            background-color: #FF1801;
            position: relative;          
        }

        header img {
            height: 100px;
            position: absolute;          
            left: 20px;                  
        }

        header h1 {
            margin: 0;
            font-size: 2em;
            text-align: center;
            color: black;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        main a {
            color: #00acee;
            font-size: 20px;
            text-decoration: none;
            margin-top: 20px;
        }

        main a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            background-color: #FF0000; /* color rojo típico de YouTube */
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            background-color: #cc0000; /* rojo más oscuro al pasar el mouse */
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        .btn:active {
            background-color: #990000; /* rojo aún más oscuro al hacer click */
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        footer {
            background-color: #FF1801;
            padding: 15px 20px;
            text-align: center;
            font-size: 15px;
            color: black;
        }

        .recomendacion-video {
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro semitransparente */
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6); /* Sombra suave */
            backdrop-filter: blur(4px); /* Difumina ligeramente el fondo detrás */
            -webkit-backdrop-filter: blur(4px); /* Compatibilidad con Safari */
            text-align: center;
            max-width: 400px;
            margin: 20px auto;
        }

        .estadisticas {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            max-width: 600px;
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        .estadisticas h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        #tabla-pilotos {
            list-style: none;
            padding: 0;
        }

        #tabla-pilotos li {
            padding: 8px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
          
    </style>
</head>
<body>
    <div class="contenedor">
        <!--Header con logo-->
        <header>
            <img src='img/logoF1.png' alt="Logo del Sitio">
            <h1>Formula 1</h1>
        </header>

        <!--enlace a un video-->
        <main>

            <section class="estadisticas">
                <h2>Clasificación de Pilotos - Temporada Actual</h2>
                <ul id="tabla-pilotos"></ul>
            </section>
            <section class="estadisticas">
                <h2>Clasificación de Constructores - Temporada Actual</h2>
                <ul id="tabla-constructores"></ul>
            </section>

            <div class="recomendacion-video">
                <p>Mira este video destacado:</p>
                <a href="https://youtu.be/Wj6DHG0X66k?si=3Kt3YbN7x1y0jgDG" target="_blank" class="btn">Ver video en YouTube</a>
            </div>
        </main>

        <!--Footer con información-->
        <footer>
            <?php
                echo "Curso: Conceptualización de servicios en la nube | Nombre: Julio Gonzalez | Código: 219549399 | Correo: julio.gonzalez5493@alumnos.udg.mx";
            ?>
        </footer>
    </div>
    <script>
        async function cargarClasificacion() {
            const url = 'https://f1api.dev/api/standings/drivers';
            try {
                const res = await fetch(url);
                const data = await res.json();
                const pilotos = data.data;

                const lista = document.getElementById('tabla-pilotos');
                pilotos.forEach(piloto => {
                    const nombre = `${piloto.driver.name}`;
                    const puntos = piloto.points;
                    const equipo = piloto.team.name;
                    const posicion = piloto.position;

                    const item = document.createElement('li');
                    item.textContent = `${posicion}. ${nombre} (${equipo}) - ${puntos} pts`;
                    lista.appendChild(item);
                });
            } catch (error) {
                console.error('Error al cargar clasificación de pilotos:', error);
            }
        }

        async function cargarConstructores() {
            const url = 'https://f1api.dev/api/standings/constructors';
            try {
                const res = await fetch(url);
                const data = await res.json();
                const equipos = data.data;

                const lista = document.getElementById('tabla-constructores');
                equipos.forEach(equipo => {
                    const nombre = equipo.team.name;
                    const puntos = equipo.points;
                    const posicion = equipo.position;

                    const item = document.createElement('li');
                    item.textContent = `${posicion}. ${nombre} - ${puntos} pts`;
                    lista.appendChild(item);
                });
            } catch (error) {
                console.error('Error al cargar clasificación de constructores:', error);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            cargarClasificacion();
            cargarConstructores();
        });
    </script>
</body>
</html>
