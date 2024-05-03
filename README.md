# Projeto Api Vagas
Rodar 'sudo setfacl -m u:MEUUSUARIO:rw /var/run/docker.sock'
Rodar 'sudo usermod -aG docker MEUUSUARIO'

#### 1. Run Docker

Start Server (in background)

- <b>docker-compose up -d</b>

Stop Server

- <b>docker-compose down</b>

Rebuild Server

- <b>docker-compose up -d --build</b>

#### 2. Acesso projeto

http://localhost:9090/

http://localhost:7070/