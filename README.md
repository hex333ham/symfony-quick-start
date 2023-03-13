# Symfony Quick Start

Last Updated: March 2023

## Instructions

*These instructions assume a Linux environment is being used.*

**PLEASE NOTE: Do not run in the project in a production environment without changing all defaults labelled !ChangeMe! and removing the potentially dangerous scripts (reseeding) in /src/bin. See URL below for more info.**

https://github.com/dunglas/symfony-docker/blob/main/docs/production.md

### Docker

I've used this template recommended by Symfony to get a quick Docker setup - https://github.com/dunglas/symfony-docker

1. Build and run the project in Docker:

```bash
docker compose build --no-cache --pull
docker compose up -d
```

If you receive a `Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use`, please stop Apache2 and prevent it from auto-restarting, then re-run the above script.

2. Setup and seed the database, using the helper script:

```bash
./src/bin/reseeddb
```

**PLEASE NOTE:** This script will context switch depending upon if it can find an active docker container for the project. It will display a message telling you which one it is attempting for 5 seconds before execution.

3. Connect to `https://localhost` and accept the security risk warning.

4. Login using the following details:

**User:** test
**Pass:** p@ssword

### Symfony CLI, Apache etc.

1. Prepare your environment:

If you wish to use other local development tools, you will need to setup the following yourself:

- Symfony compatible database
- Hosting for the project
- `.env.local` settings

2. Setup and seed the database, using the helper script:

```bash
./src/bin/reseeddb
```

**PLEASE NOTE:** This script will context switch depending upon if it can find an active docker container for the project. It will display a message telling you which one it is attempting for 5 seconds before execution.

3. Ensure the project is running over HTTP somewhere, then access it's url in a web browser.

4. Login using the following details:

**User:** test
**Pass:** p@ssword
