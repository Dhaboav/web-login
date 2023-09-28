<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>
            <a href="index.php">Penikmat Konten</a>
        </h1>
    </header>
    <nav>
        <a href="form.php" style="color: black;">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
        <a href="#">Link 4</a>
        <a href="#">Link 5</a>
    </nav>
    <section>
        <h1>FORM</h1>
        <article class="form-container">
            <form action='' method='POST'>
                <table>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td><input type='text' name='NIM'></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type='text' name='nama'></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>Pria<input type='radio' name='jk' value='Pria'> Wanita<input type='radio' name='jk' value='Wanita'>
                        </td>
                    </tr>
                    <tr>
                        <td>Hobi</td>
                        <td>:</td>
                        <td><input type='checkbox' name='hobi[]' value='hobi 1'>Hobi 1 <input type='checkbox' name='hobi[]' value='hobi 2'>Hobi 2 <input type='checkbox' name='hobi[]' value='hobi 3'>Hobi 3</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td>
                            <select name='agama'>
                                <option>Islam</option>
                                <option>Kristen</option>
                                <option>Khatolik</option>
                                <option>Buddha</option>
                                <option>Hindu </option>
                                <option>Konghucu</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><textarea name='alamat'></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="3"><button type="submit">SUBMIT</button></td>
                    </tr>
                </table>
            </form>
            </form>

        </article>
    </section>

</body>

</html>