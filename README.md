<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/BryantJimenez/currency-converter">
    <img src="public/admins/img/logo.png" alt="Logo" width="80" height="80">
  </a>
  <br />
  <p align="center">

[![Build Status][build-shield]][build-url]
[![MIT License][license-shield]][license-url]
  
  </p>

  <h3 align="center">Currency Converter</h3>

  <p align="center">
    Web system to calculate and quote the exchange rate between currencies for sending remittances.
    <br />
    <br />
    <a href="https://github.com/BryantJimenez/currency-converter/issues">Report Bug</a>
    ·
    <a href="https://github.com/BryantJimenez/currency-converter/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#modules">Modules</a></li>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
        <li><a href="#production">Production</a></li>
      </ul>
    </li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

![Currency Converter GIF][product-gif]

It is a web system for calculating and quoting the exchange rate between currencies for sending remittances. It has its respective user authentication (login and recover password), in addition to a user profile. It has 6 modules, which are: Users, Clients, Quotes, Currencies, Reports and Settings.

It has integrated [Spatie](https://spatie.be/docs/laravel-permission/v5/introduction) roles and permissions, exports PDF ([DOMPDF](https://github.com/barryvdh/laravel-dompdf) Package) and Excel ([Laravel Excel](https://laravel-excel.com) Package) documents. And it has integrated the Livewire package, used to show the calculation between currencies in a dynamic way.

The design was made using the [Cork](https://themeforest.net/item/cork-responsive-admin-dashboard-template/25582188?gclid=Cj0KCQiA_bieBhDSARIsADU4zLdCnT8rmjuLKjAok-LtD56h79QvisNP2KhXleWWZGPU_jpzBkxeC7EaAtwEEALw_wcB) template as a base.



### Modules

**Users:** Manage users who can enter the system (Super Administrators and Administrators).
<br />
**Customers:** Manage customers, in addition to adding bank accounts and linking them with other customers.
<br />
**Quotes:** Calculate currency conversions and save the quote with commissions. Allows you to export invoices for each quote.
<br />
**Currencies:** Manage currencies and their respective exchange rates.
<br />
**Reports:** Export quotes in Excel and PDF with time and currency filters.
<br />
**Settings:** Edit the settings when quoting remittances (commissions and VAT).



### Built With

The system is developed using the Laravel framework in the backend, and in the frontend are libraries and web languages such as: JavaScript, CSS, HTML, JQuery, Bootstrap, among others. Also, the database was created with MySQL.

[![PHP][php]][php-url]
[![Composer][composer]][composer-url]
[![Laravel][laravel]][laravel-url]
[![Livewire][livewire]][livewire-url]
[![MySQL][mysql]][mysql-url]
[![HTML5][html5]][html5-url]
[![CSS3][css3]][css3-url]
[![JavaScript][javascript]][javascript-url]
[![Bootstrap][bootstrap]][bootstrap-url]
[![JQuery][jquery]][jquery-url]



<!-- GETTING STARTED -->
## Getting Started

_Follow the instructions below to clone this repository to your local machine._

### Prerequisites

To clone this repository, you must have an Apache server installed, PHP and MSQL (I recommend XAMPP) and the dependency managers for PHP (Composer) and for JavaScript (NPM).

Before starting check if you have composer with the following command in your terminal.
```sh
composer -v
```
If you do not have it installed, you can install it following the official documentation at:
https://getcomposer.org/doc/00-intro.md

Also check the npm version in the terminal with the following command
```sh
npm --version
```
If you do not have it installed, you can install it following the official documentation at:
https://www.npmjs.com/get-npm



### Installation

_Follow the instructions below to clone the repository_

1. _Clone the repo_

```sh
git clone https://github.com/BryantJimenez/currency-converter.git
```

2. _Install and update all dependencies_

```sh
composer install
composer update
```

3. _Install NPM packages (Optional)_

```sh
npm install
```

4. _Copy the .env.example file to a new .env file with the command_

```sh
cp .env.example .env
```

5. _Set the database, email and other environment variables in the .env file._

6. _Generate a new Key for the project_

```sh
php artisan key:generate
```

7. _Run the project's migrations and seeders with the command_

```sh
php artisan migrate --seed
```

8. _Run the project with the command_

```sh
php artisan serve
```

_If everything is correct you can access the project at the url `http://localhost:8000`._
<br />
_And you can access with the following access data:_
<br />
Email: `admin@gmail.com`
<br />
Password: `12345678`



### Production

_To upload to production I recommend the following changes in the .env file._

```
APP_ENV=production
APP_DEBUG=false
DEBUGBAR_ENABLED=false
```



<!-- LICENSE -->
## License

Distributed under the [MIT License](https://opensource.org/licenses/MIT).



<!-- CONTACT -->
## Contact

Bryant Jimenez - bryant.luis1600186@gmail.com

[![Twitter][twitter-shield]][twitter-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[build-shield]: https://img.shields.io/badge/Build-Finished-97ca00?style=for-the-badge
[build-url]: https://github.com/BryantJimenez/currency-converter
[license-shield]: https://img.shields.io/badge/License-MIT-97ca00?style=for-the-badge
[license-url]: https://opensource.org/licenses/MIT

[product-gif]: public/admins/readme/about.gif

[laravel]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[laravel-url]: https://laravel.com
[bootstrap]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[bootstrap-url]: https://getbootstrap.com
[jquery]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[jquery-url]: https://jquery.com
[composer]: https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=Composer&logoColor=white
[composer-url]: https://getcomposer.org
[html5]: https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white
[html5-url]: https://developer.mozilla.org/es/docs/Glossary/HTML5
[mysql]: https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white
[mysql-url]: https://www.mysql.com
[css3]: https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white
[css3-url]: https://developer.mozilla.org/es/docs/Web/CSS
[javascript]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white
[javascript-url]: https://developer.mozilla.org/es/docs/Web/JavaScript
[livewire]: https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white
[livewire-url]: https://laravel-livewire.com
[php]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[php-url]: https://www.php.net/manual/es/intro-whatis.php

[twitter-shield]: https://img.shields.io/badge/Twitter-@bryantluis1-1DA1F2.svg?style=for-the-badge&logo=twitter
[twitter-url]: https://twitter.com/bryantluis1
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=0A66C2
[linkedin-url]: https://linkedin.com/in/bryant-jimenez-reyes
