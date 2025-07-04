<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formula 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Misma parte CSS */
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
            left: 14px;                  
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
            background-color: #FF0000;
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
            background-color: #cc0000;
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        .btn:active {
            background-color: #990000;
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
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
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

        #tabla-pilotos,
        #tabla-constructores {
            list-style: none;
            padding: 0;
        }

        #tabla-pilotos li,
        #tabla-constructores li {
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

        <!--Contenido principal-->
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

        <!--Footer-->
        <footer>
            <?php
                echo "Curso: Conceptualización de servicios en la nube | Nombre: Julio Gonzalez | Código: 219549399 | Correo: julio.gonzalez5493@alumnos.udg.mx";
            ?>
        </footer>
    </div>

    <script>
        async function fetchData(url) {
            try {
                const res = await fetch(url);
                if (!res.ok) {
                    throw new Error(`Error HTTP ${res.status}`);
                }
                const data = await res.json();
                console.log("Respuesta de la API:", data); // 👈 Debug: imprime respuesta completa
                return data;
            } catch (error) {
                console.error('Error al obtener datos de la API:', error);
                return null;
            }
        }

        async function cargarClasificacion() {
            const url = 'https://f1api.dev/api/2025/drivers-championship';
            const data = await fetchData(url);

            const lista = document.getElementById('tabla-pilotos');
            lista.innerHTML = ''; // Limpia contenido previo

            if (data && data.drivers_championship && Array.isArray(data.drivers_championship)) {
                data.drivers_championship.forEach(piloto => {
                    const nombre = piloto.driverId; // 👈 Aquí puedes cambiar por piloto.driver.name si la API lo trae
                    const puntos = piloto.points;
                    const equipo = piloto.teamId; // 👈 Aquí puedes cambiar por piloto.team.name si la API lo trae
                    const posicion = piloto.position;

                    const item = document.createElement('li');
                    item.textContent = `${posicion}. ${nombre} (${equipo}) - ${puntos} pts`;
                    lista.appendChild(item);
                });
            } else {
                lista.innerHTML = '<li>No se encontraron datos de pilotos.</li>';
            }
        }

        async function cargarConstructores() {
            const url = 'https://f1api.dev/api/2025/constructors-championship';
            const data = await fetchData(url);

            const lista = document.getElementById('tabla-constructores');
            lista.innerHTML = ''; // Limpia contenido previo

            if (data && data.constructors_championship && Array.isArray(data.constructors_championship)) {
                data.constructors_championship.forEach(equipo => {
                    const nombre = equipo.teamId; // 👈 Cambia por equipo.team.name si existe
                    const puntos = equipo.points;
                    const posicion = equipo.position;

                    const item = document.createElement('li');
                    item.textContent = `${posicion}. ${nombre} - ${puntos} pts`;
                    lista.appendChild(item);
                });
            } else {
                lista.innerHTML = '<li>No se encontraron datos de constructores.</li>';
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            cargarClasificacion();
            cargarConstructores();
        });
    </script>
</body>
</html>
