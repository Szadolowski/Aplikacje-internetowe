<?php
if (isset($_COOKIE["StronaLotniska"])) {
} else {
  setcookie("StronaLotniska", "UserWelcome",  time() + 3600 * 2);
}

$DBase = mysqli_connect("localhost", "root", "", "egzamin");

$Question = "SELECT czas, kierunek, nr_rejsu, status_lotu FROM przyloty ORDER BY czas;";

if (mysqli_error($DBase)) {
  die("Błąd połączenia z bazą danych: " . $DBase->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Port Lotniczy</title>
  <link rel="stylesheet" href="styl5.css" />
</head>

<body>
  <header>
    <section id="Baner-One">
      <img src="zad5.png" alt="logo lotnisko" />
    </section>
    <section id="Baner-Two">
      <h1>Przyloty</h1>
    </section>
    <section id="Baner-Thr">
      <h3>przydatne linki</h3>
      <a href="kwerendy.txt">Pobierz...</a>
    </section>
  </header>
  <main>
    <table>
      <tr>
        <th>czas</th>
        <th>kierunek</th>
        <th>numer rejsu</th>
        <th>status</th>
      </tr>

      <?php

      $result = mysqli_query($DBase, $Question);

      if ($result) {
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<th>" . $row["czas"] . "</th>";
          echo "<th>" . $row["kierunek"] . "</th>";
          echo "<th>" . $row["nr_rejsu"] . "</th>";
          echo "<th>" . $row["status_lotu"] . "</th>";
          echo "</tr>";
        }
      } else {
        echo "Błąd zapytania" . mysqli_error($DBase);
      }

      $result->free();
      mysqli_close($DBase);
      ?>
    </table>
  </main>
  <footer>
    <section id="Footer-One">
      <?php
      if ($_COOKIE["StronaLotniska"] == "UserWelcome") {
        echo "<p><b>Dzień dobry! Strona lotniska Używa ciasteczek</b></p>";
        setcookie("StronaLotniska", "AnatherOne", time() + 3600 * 2);
      }
      if ($_COOKIE["StronaLotniska"] == "AnatherOne") {
        echo "<p><i>Witaj pomnownie na stronie lotniska</i></p>";
      }

      ?>
    </section>
    <section id="Footer-Two">Autor:00000000000</section>
  </footer>
</body>

</html>