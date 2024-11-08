FROM nginx:alpine

COPY ./config /etc/nginx/

WORKDIR /usr/share/nginx/html

COPY ./html/50x.html .

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]