<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>
        <h2>Llene el formulario de contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">
                <label for="email">E-mail:</label>
                <input type="email" placeholder="Tu Email" id="email">
                <label for="telefono">Telefono:</label>
                <input type="tel" placeholder="Tu Telefono" id="telefono">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
                
                
            </fieldset>
            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>--Selecciona--</option>
                    <option value="Compra">Compra</option>
                    <option value="Venta">Venta</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto: </label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser Contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-correo">Correo</label>
                    <input name="contacto" type="radio" value="correo" id="contactar-correo">
                </div>
                <p>Si eligio telefono, Elija la fecha y hora</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:000" max="18:00">
            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>
<?php
    incluirTemplate('footer');
?>