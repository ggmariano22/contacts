## Contacts CRUD with Symfony and Start Bootstrap
![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white) ![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white) ![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white) ![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white) ![Bootstrap](https://img.shields.io/badge/bootstrap-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white)

### How to build?
Just run `make docker-install`. This command will:
- Build docker image for PHP and Nginx
- Install all composer dependencies
- Start the container

After this, go to `http://localhost:8080` and check if the login page will open.
**Important: if it's your first access, click on Create an Account! before try to login.**

### Testing
This project have unit and functional tests. To run, execute the command `make docker-test`.