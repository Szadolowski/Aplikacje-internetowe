<?php
$Connect = mysqli_connect("localhost", "root", "", "dane");

if (mysqli_error($Connect)) {
  die("Błąd połączenia z bazą danych: " . $DBase->connect_error);
}

error_reporting(0);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="styl4.css" />
</head>

<body>
    <header id="Baner">
        <h3>Portal Społecznościowy - panel administratora</h3>
    </header>
    <section id="Main">
        <nav id="Main-Nav" class="Main">
            <h4>Użytkownictestesy</h4>

            <?php
      $Question = mysqli_query($Connect, "SELECT id, imie, nazwisko, rok_urodzenia, zdjecie from osoby;");

      while ($elem = mysqli_fetch_array($Question)) {
        echo $elem["id"] . ". " . $elem["imie"] . " " . $elem["nazwisko"] . ", " . date("Y") - $elem["rok_urodzenia"] . " lat<br>";
      }

      unset($Question);
      ?>

            <a href="settings.html">Inne ustawienia</a>
        </nav>
        <main id="Main-Content" class="Main">
            <h4>Podaj id użytkownika</h4>
            <form action="user.php" method="post">
                <input type="number" name="Pole-Numeryczne" id="Pole-Numeryczne" />
                <button type="submit" id="Button">ZOBACZ</button>
            </form>
            <hr />
            <?php
      if (isset($_POST["Pole-Numeryczne"])) {
        $Number = $_POST["Pole-Numeryczne"];

        $Question = mysqli_query($Connect, 'SELECT osoby.imie, osoby.nazwisko, osoby.rok_urodzenia, osoby.opis, osoby.zdjecie, hobby.nazwa from osoby INNER JOIN hobby on osoby.hobby_id = hobby_id WHERE osoby.id=' . $Number . ';');

        $elem = mysqli_fetch_array($Question);
        echo "<h2>" . $Number . " " . $elem["imie"] . " " . $elem["nazwisko"] . "</h2>";
        echo '<img src="' . $elem["zdjecie"] . '" alt="' . $Number . '">';
        echo "<p>" . $elem["rok_urodzenia"] . "</p>";
        echo "<p>" . $elem["opis"] . "</p>";
        echo "<p>" . $elem["nazwa"] . "</p>";
      }
      unset($Question);
      ?>
        </main>
    </section>
    <footer id="Stopka">Stronę wykonał:00000000000</footer>
</body>

</html>

<?php
mysqli_close($Connect);
?>