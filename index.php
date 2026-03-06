<?php
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$parking = $_GET["parking"];
$vote = $_GET["vote"];

$filtered_hotels = $hotels;

// PARKING FILTER
if ($parking === "on") {
    $filtered_hotels = array_filter($filtered_hotels, function ($hotel) {
        return $hotel["parking"] === true;
    });
}

// VOTE FILTER
if ($vote) {
    $filtered_hotels = array_filter($filtered_hotels, function ($hotel) use ($vote) {
        return $hotel['vote'] >= $vote;
    });
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>PHP Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">

    <style>
        form {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-control {
            display: inline;
            width: auto;
        }
    </style>
</head>

<body class="container pt-5">
    <h1 class="pb-3">PHP Hotels</h1>

    <!-- FORM FILTER -->
    <h4>Filters</h4>
    <form action="./"
          method="GET"
          class="pb-3">
        <!-- Parking filter -->
        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   name="parking"
                   id="parking">
            <label class="form-check-label"
                   for="parking">
                Parking
            </label>
        </div>
        <!-- Vote filter -->
        <div class="form-check">
            <label for="vote"
                   class="form-check-label">Vote</label>
            <input type="number"
                   name="vote"
                   id="vote"
                   min="1"
                   max="5"
                   class="form-control">

        </div>
        <!-- Submit button -->
        <div>
            <button class="btn btn-primary mt-2"
                    type="submit">Apply filters</button>
        </div>
    </form>

    <!-- HOTELS TABLE -->
    <table class="table">
        <!-- Headings -->
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Parking</th>
                <th scope="col">Vote</th>
                <th scope="col">Distance to center</th>
            </tr>
        </thead>
        <!-- Hotel rows -->
        <tbody>
            <?php
            foreach ($filtered_hotels as $hotel) {
                echo "<tr>";

                // Table data
                foreach ($hotel as $key => $value) {
                    if (is_bool($value)) {
                        echo "<td>" . ($value == true ? "Yes" : "No") . "</td>"; /* Formatting booleans data */
                    } else {
                        echo "<td> $value </td>";
                    }
                }

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>