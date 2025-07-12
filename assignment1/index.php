<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Favorite Movies List</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f0f5;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    .movie {
      background: white;
      padding: 20px;
      margin-bottom: 15px;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 20px;
    }
    .movie img {
      width: 120px;
      height: auto;
      border-radius: 5px;
    }
    .movie-info {
      flex: 1;
    }
    .highlight {
      color: green;
      font-weight: bold;
    }
    .low-rating {
      color: red;
    }
  </style>
</head>
<body>

<h1>Favorite Movies List</h1>

<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "assignment1";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM movies ORDER BY release_date DESC LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $ratingClass = $row["rating"] >= 8 ? "highlight" : "low-rating";

    echo "<div class='movie'>";
    echo "<img src='" . htmlspecialchars($row["poster_url"]) . "' alt='Poster'>";
    echo "<div class='movie-info'>";
    echo "<h2>" . $row["title"] . "</h2>";
    echo "<p><strong>Genre:</strong> " . $row["genre"] . "</p>";
    echo "<p><strong>Rating:</strong> <span class='$ratingClass'>" . $row["rating"] . "</span></p>";
    echo "<p><strong>Release Date:</strong> " . date("F d, Y", strtotime($row["release_date"])) . "</p>";
    echo "</div></div>";
  }
} else {
  echo "<p>No movies found.</p>";
}

$conn->close();
?>

</body>
</html>
