# Practica UD2

Este proyecto está diseñado para demostrar una implementación completa de un cliente y servidor utilizando una API REST. El servidor está construido con Spring Boot, aprovechando su capacidad para desarrollar aplicaciones robustas y fácilmente escalables en Java. El cliente está construido con React, lo que permite una experiencia de usuario interactiva y dinámica.

## 🚀

Para realizar esta práctica las tecnologías empleadas han sido springboot para el backend, react para el frontend y también se ha usado docker.

### Requisitos 📋

##### Docker (para crear contenedores)
##### Docker Compose (para gestionar múltiples contenedores)
##### Java 23+ (para ejecutar Spring Boot)
##### Node.js 18+ (para ejecutar la aplicación React)


### Instalación 🔧

Para la ejecución del proyecto deberas seguir estos pasos:

Lo primero clonar el proyecto y entrar a la carpeta

```
git clone https://github.com/julimartinez11/practicaUD2.git
cd practicaUD2
```

Despues tendras que realizar el docker compose para levantarlo

```
docker-compose up --build
```

Este comando construye las imagenes del backend y el frontend y levanta el contenedor correspondiente.

##  ⚙️

Para probarlo solo tendras que entrar en tu navegador a http://localhost:3000

## Para resaltar

Este proyecto tiene en cuenta el CORS ya que es una cosa que he tenido que arreglar para que funcionara. Esta el archivo webConfig en el backend que lo tiene en cuenta.
