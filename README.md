<a name="readme-top"></a>


<!-- PROJECT LOGO -->
<br />
<div align="center">
<h3 align="center">Simple Web Login with MySQL</h3>

  <p align="center">
    This repository is about simple login logout system using php and build in using html and css with MySQL database.
    <br />
    <a href="https://github.com/Dhaboav/web-login"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/Dhaboav/web-login">View Demo</a>
    ·
    <a href="https://github.com/Dhaboav/web-login/issues">Report Bug</a>
    ·
    <a href="https://github.com/Dhaboav/web-login/issues">Request Feature</a>
  </p>
</div>


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#about-the-project">About The Project</a></li>
    <li><a href="#file-structure">File Structure</a></li>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#feature">Feature</a></li>
    <li><a href="#contributing">Contributing</a></li> 
  </ol>
</details>


<!-- ABOUT THE PROJECT -->
## About The Project
This repository is making simple login system that have some feature like chain login session and logout and show table. And create using `HTML`, `CSS`, `PHP` with `MySQL`

Login Sample:
![Sample Login](https://github.com/Dhaboav/web-login/blob/main/img/login.png)

Home Sample:
![Sample Dashboard](https://github.com/Dhaboav/web-login/blob/main/img/home.png)


Image Source:
<br>
[Login Background Source](https://wall.alphacoders.com/big.php?i=971943)
<br>
[Home Background Source](https://www.zerochan.net/3584651)

<p align="right">(<a href="#readme-top">back to top</a>)</p>


### File Structure
Here is the file structure of this repository
```
. 
├── css
|   |
|   ├── content.css
|   └── login.css
|
├── img
|   |
|   ├── bg.jpg
|   ├── home.png
|   ├── login.png
|   └── loginbg.png
|
├── src  
|   |
|   ├── home.php
|   ├── matkul.php
|   └── mhs.php
|
├── index.php
└── README.md
```
<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- GETTING STARTED -->
### Installation
1. Clone the repo
  ```sh
   git clone https://github.com/Dhaboav/web-login.git
  ```

2. Create database uas in MySQL
  ```Prompt
  CREATE DATABASE uas;
  ```

3. Create table mahasiswa in database uas
  ```Prompt
  CREATE TABLE mahasiswa (
    nim varchar(11) PRIMARY KEY,
    nama varchar(50),
    jenis_kelamin varchar(6),
    no_hp varchar(13)
  );
  ``` 
4. Create table mata_kuliah in database uas
  ```Prompt
  CREATE TABLE mata_kuliah (
    id_matakuliah varchar(6) PRIMARY KEY,
    nama_matakuliah varchar(50),
    sks int(2),
    dosen_pengampu varchar(50)
  );
  ``` 

5. Run in your localhost
  ```localhost
   http://localhost/web-personal/index.php
  ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- Feature -->
## Feature

- Simple Login System (Chain session login and logout) with MySQL database.
- Simple error message in wrong username or password.
- Simple Dashboard to show table in database.
- Can edit and delete for admin. And only see and edit for unique id.

See the [open issues](https://github.com/Dhaboav/web-login/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>
