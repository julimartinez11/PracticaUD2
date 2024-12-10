# Practica UD2

Este proyecto está diseñado para demostrar una implementación completa de un cliente y servidor utilizando una API REST. El servidor está construido con Laravel. El cliente está construido con Vue, lo que permite una experiencia de usuario interactiva y dinámica.

## 🚀

Para realizar esta práctica las tecnologías empleadas han sido Laravel para el backend, Vue para el frontend y también se ha usado docker.

### Requisitos 📋

##### Docker (para crear contenedores)
##### Docker Compose (para gestionar múltiples contenedores)
##### PHP (Yo he tenido que instalar la version 8.2 porque las otras me fallaban)
##### Node.js 18+ (para ejecutar la aplicación Vue)


### Instalación 🔧

Para la ejecución del proyecto deberas seguir estos pasos:

Lo primero clonar el proyecto y entrar a la carpeta

```
git clone https://github.com/julimartinez11/practicaUD2.git
cd practicaUD2
```
Una vez has realizado el clone puedes entrar al backend y hacer composer install , una vez realizado esto tendras que hacer una copia del .env.example a .env luego php artisan key:generate , despues migrar la bbdd php artisan migrate y por ultimo php artisan serve. Esto seria para la carpeta backend.
Para la carpeta frontend tendras que hacer un npm install y un npm run serve.
La otra opción es con Docker. Docker compose para levantarlo

```
docker-compose up --build
```

Este comando construye las imagenes del backend y el frontend y levanta el contenedor correspondiente.

##  ⚙️

Para probarlo solo tendras que entrar en tu navegador a http://localhost:8080

## Para resaltar

Este proyecto tiene en cuenta el CORS ya que es una cosa que he tenido que arreglar para que funcionara. Esta el archivo webConfig en el backend que lo tiene en cuenta.
