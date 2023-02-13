<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum inventore nostrum, at temporibus optio veritatis facilis. Laudantium, quidem molestiae suscipit totam repellendus deserunt voluptatem quis, recusandae, praesentium eveniet sapiente in?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit maiores mollitia quis recusandae ab? Id velit alias tenetur voluptates deleniti rerum, quibusdam voluptatibus minus maxime vero. Vel tenetur unde recusandae.</p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit rerum ratione deleniti omnis
                    ullam tempore temporibus expedita, nemo, totam sint provident accusamus iusto blanditiis esse labore
                    corrupti! Magni, sequi vero.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit rerum ratione deleniti omnis
                    ullam tempore temporibus expedita, nemo, totam sint provident accusamus iusto blanditiis esse labore
                    corrupti! Magni, sequi vero.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit rerum ratione deleniti omnis
                    ullam tempore temporibus expedita, nemo, totam sint provident accusamus iusto blanditiis esse labore
                    corrupti! Magni, sequi vero.</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>