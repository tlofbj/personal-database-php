# Personal Database Project - Documentation

This project is a vanilla-PHP demonstration of the Model-View-Controller framework that offers an interface in a localhost website to interact with a mysql database running on Tata's computer.

Author's Note: 耗时一年有余，中途电脑清空花三个星期重新打造的PHP Personal Database Project完结了！有完整的自定义的Core Infrastructure（Application, Autoloader, Container, Controller, Database, Middleware, Model, Request, Response, Router, Session, View, Services, Repositories, boostrap, and config），有可靠的localhost服务器启动和连接，有丝滑的登陆登出逻辑，有非常丝滑的存储、读取、删除数据的逻辑，还有非常极简的设计！


## Updates
**1.0.0** - This version is the first fully functional database able to store and destroy data. Last edit: Feb 17, 2025.
**0.3.0** - This update established custom `Request` and `Response` objects, Services (`AuthServices`, `UserServices`, and `ValidationServices`), and a `UserRepository`. Last edit: February 16, 2025.
**0.2.0** - This update completed registration and authorization logic. Last edit: February 3, 2025.
**0.1.0** - This update established basic object-oriented core classes. Last edit: February 2, 2025.

## Usage

1.  Create a php server: `php -S <host:port> -t <root>`
2.  Edit the `config.php` file to match your server address
