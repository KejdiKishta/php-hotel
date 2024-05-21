<!-- Descrizione
Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Iniziate in modo graduale.
Prima stampate in pagina i dati, senza preoccuparvi dello stile.
Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella. -->

<!-- Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)  -->

<!-- NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel. -->


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
    [
        'name' => 'Hotel Sole',
        'description' => 'Hotel Sole Descrizione',
        'parking' => true,
        'vote' => 3,
        'distance_to_center' => 3.2
    ],
    [
        'name' => 'Hotel Splendido',
        'description' => 'Hotel Splendido Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 8.7
    ],
    [
        'name' => 'Hotel Vista Mare',
        'description' => 'Hotel Vista Mare Descrizione',
        'parking' => false,
        'vote' => 2,
        'distance_to_center' => 15.1
    ],
    [
        'name' => 'Hotel Luna',
        'description' => 'Hotel Luna Descrizione',
        'parking' => false,
        'vote' => 3,
        'distance_to_center' => 6.9
    ],
    [
        'name' => 'Hotel Stella',
        'description' => 'Hotel Stella Descrizione',
        'parking' => true,
        'vote' => 5,
        'distance_to_center' => 4.8
    ],
    [
        'name' => 'Hotel Mediterraneo',
        'description' => 'Hotel Mediterraneo Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 12.3
    ],
    [
        'name' => 'Hotel Panorama',
        'description' => 'Hotel Panorama Descrizione',
        'parking' => false,
        'vote' => 3,
        'distance_to_center' => 7.6
    ],
    [
        'name' => 'Hotel Azzurro',
        'description' => 'Hotel Azzurro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 20.5
    ],
    [
        'name' => 'Hotel Aurora',
        'description' => 'Hotel Aurora Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 9.4
    ],
    [
        'name' => 'Hotel La Baia',
        'description' => 'Hotel La Baia Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 3.8
    ]

];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-primary">
    <div class="container">
        <h1 class="text-center fw-bold text-white my-4">PHP Hotels</h1>

        <!-- form con i filtri -->
        <form class="bg-dark my-5 p-3 d-flex justify-content-between" action="index.php" method="GET">
            <!-- filtro del parcheggio che se checked ritorna value = 1 -->
            <div class="w-25 d-flex justify-content-center align-items-center">
                <label for="parking" class="text-white me-2">Show only hotels with parking:</label>
                <input class="form-check-input" type="checkbox" id="parking" name="parking" value="1">
            </div>
            <!-- filtro del rating che ritorna un value compreso tra 0 e 5 -->
            <div class="w-25 d-flex justify-content-center align-items-center">
                <label for="rating" class="text-white me-2">Min rating:</label>
                <input class="form-control" type="number" id="rating" name="rating" min="0" max="5" value="">
            </div>
            <!-- submit -->
            <div class="w-25 d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Add Filter</button>
            </div>
        </form>

        <table class="table table-dark table-striped">
            <thead>
                <!-- foreach che stampa ogni chiave del primo oggetto per usarli come table head -->
                <?php foreach ($hotels[0] as $key => $value) { ?>
                    <?php echo "<th scope='col'>" ?>
                    <?php echo $key ?>
                    <?php echo "</th>" ?>
                <?php } ?>
            </thead>
            <tbody>
                <!-- foreach che prende ogni elemento della variabile -->
                <?php foreach ($hotels as $cur_hotel) { ?>
                    <!-- condizioni per cui gli hotel vengono stampati -->
                    <!-- vengono utilizzati i $_GET che prendiamo dal form -->
                    <?php
                        // variabile inizialmente vera che permette di mostrare l'hotel corrente
                        $show = true;

                        // se il filtro parking è settato, è uguale a 1 cioè checked e l'hotel corrente ha parking = false non lo mostriamo
                        if (isset($_GET["parking"]) && $_GET["parking"] === "1" && !$cur_hotel["parking"]) {
                            $show = false;
                        } 
                        // se rating è settato e il suo value è maggiore del key vote non mostriamo l'hotel
                        elseif (isset($_GET["rating"]) && $_GET["rating"] > $cur_hotel["vote"]) {
                            $show = false;
                        }
                    ?>
                    <!-- se l'hotel supera i filtri o stampiamo -->
                    <?php if ($show) { ?>
                        <?php echo "<tr>" ?>
                        <!-- prendo tutte le chiavi dell'hotel corrente e le stampo -->
                        <?php foreach ($cur_hotel as $key => $value) { ?>
                            <?php echo "<td>" ?>
                            <?php
                            // converto il booleano con un check o cross in base al valore
                            if ($key === "parking") {
                                if ($value === true) {
                                    $value = "<span class='text-success fw-bold'>&check;</span>";
                                } elseif ($value === false) {
                                    $value = "<span class='text-danger fw-bold'>&cross;</span>";
                                }
                                echo $value;
                            }
                            // per il voto utilizzo le stelle piene finche $i non supera $vote e le restanti sono vuote
                            elseif ($key === "vote") {
                                $result = "";
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $value) {
                                        // piene
                                        $result = "$result&#9733;";
                                    } else {
                                        // vuote
                                        $result = "$result&#9734;";
                                    }
                                }
                                echo $result;
                            }
                            // aggiungo km alla distanza per essere più leggibile
                            elseif ($key === "distance_to_center") {
                                $value = "{$value} km";
                                echo $value;
                            } else {
                                echo $value;
                            }
                            ?>
                            <?php echo "</td>" ?>
                        <?php } ?>
                        <?php echo "</tr>" ?>
                    <?php } ?>
                <?php } ?>

            </tbody>
        </table>
    </div>
</body>

</html>