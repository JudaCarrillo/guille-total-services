FROM nginx:alpine

COPY ./config /etc/nginx/
COPY ./certs /etc/nginx/conf.d/certs

WORKDIR /usr/share/nginx/html

COPY ./html/50x.html .

EXPOSE 443

CMD ["nginx", "-g", "daemon off;"]