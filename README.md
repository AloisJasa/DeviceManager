# DeviceManager

## Local development instructions
- setup traefik (or any other reverse proxy)
- copy .env.example to .env and set up your environment variables
- docker-compose up -d
- docker compose exec core bash #připojení do kontejneru
- composer install -o
- make init-database
- make init-fixtures

### Traefik example 
```yaml
  reverse-proxy:
    image: traefik:v3.1
    restart: always
    command:
      - --log.level=INFO
      - --accesslog=true
    ports:
      - "80:80"
      - "2112:2112"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - $PWD/traefik.yml:/etc/traefik/traefik.yml
    healthcheck:
      test: ["CMD", "wget", "http://localhost:8082/ping","--spider"]
      interval: 10s
      timeout: 5s
      retries: 3
      start_period: 5s
    labels:
      - "traefik.http.routers.dashboard.rule=Host(`traefik.localhost`)"
      - "traefik.http.routers.dashboard.service=api@internal"
      - "traefik.http.services.dashboard.loadbalancer.server.port=8080"
      - "traefik.http.routers.dashboard.entrypoints=web,metrics,ping"
```

## traefik.yml example
```yaml
providers:
  docker:
    endpoint: "unix:///var/run/docker.sock"
    defaultRule: "Host(`{{ normalize .Name }}.localhost`)"
#    useBindPortIP: true
#    exposedByDefault: true

api:
  insecure: false
  dashboard: true

ping:
  entryPoint: ping

entryPoints:
  ping:
    address: ":8082"
  web:
    address: ":80"
```
