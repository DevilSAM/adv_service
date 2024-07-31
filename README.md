# TEST_APP

My test app

## Assumes that you have Docker installed
This app runs with docker so you have to install it first if you didn't yet

## Installation

### Clone the project
```bash
git clone https://github.com/DevilSAM/adv_service.git adv_service
```

### Go to the created app directory
```bash
cd adv_service
```

### Create .env file using the example one

```bash
cp .env.example .env
```

### Run building the app with docker
```bash
docker compose build
```

```bash
docker compose up -d
```

```bash
npm install
```

```bash
npm run build
```


## Now the app is available in the browser
http://localhost:8080/


## Run Tests
```bash
 ./vendor/bin/phpunit
```

