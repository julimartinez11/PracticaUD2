# Utiliza una imagen oficial de Node.js para construir el proyecto
FROM node:18 as build

# Directorio de trabajo
WORKDIR /app

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias y construir el proyecto
RUN npm install && npm run build

# Servidor para servir archivos estáticos
FROM nginx:alpine

# Copiar la compilación del proyecto al directorio predeterminado de NGINX
COPY --from=build /app/dist /usr/share/nginx/html

# Exponer el puerto
EXPOSE 80
