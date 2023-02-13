<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoraciond e tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>
        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por : <span>Admin</span></p>
        <div class="resumen-propiedad">
           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad necessitatibus itaque distinctio dignissimos
                nihil officia nam autem possimus, beatae culpa eos at, quae maiores voluptatibus quisquam debitis,
                quidem id iure. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit odio delectus
                accusantium inventore molestias eligendi nisi et dolorum deleniti? Voluptas laudantium laborum ad ut eum
                illo aliquam earum voluptatum explicabo? Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque
                corrupti ea vero accusamus. Error qui autem nobis quo consequatur, pariatur corporis. Impedit dolore
                similique distinctio laborum voluptatibus molestiae dolorum molestias?</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel ipsum nisi neque quam quo. Dicta, ipsam
                possimus, est beatae ab facilis quibusdam similique, eius fugit suscipit assumenda necessitatibus!
                Vitae, itaque! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas pariatur repudiandae
                maxime suscipit corporis alias, ad voluptatem eaque consequatur nisi consectetur qui, laborum magni
                voluptates distinctio exercitationem expedita ab rem? Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Laudantium officiis accusantium corporis quidem quo nemo vitae fugiat odit expedita? Cupiditate,
                qui ratione? Itaque nulla, mollitia minus non commodi nam a.</p>
        </div>
    </main>
<?php
    incluirTemplate('footer');
?>