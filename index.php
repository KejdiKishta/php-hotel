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

        <table class="table table-dark table-striped">
            <thead>
                <?php foreach ($hotels[0] as $key => $value) { ?>
                    <?php echo "<th scope='col'>" ?>
                    <?php echo $key ?>
                    <?php echo "</th>" ?>
                <?php } ?>
            </thead>
            <tbody>
        
                <?php foreach ($hotels as $cur_hotel) { ?>
                    <?php echo "<tr>" ?>
                    <?php foreach ($cur_hotel as $key => $value) { ?>
                        <?php echo "<td>" ?>
                        <?php
                            if ($key === "parking") {
                                if ($value === true) {
                                    $value = "<span class='text-success fw-bold'>&check;</span>";
                                } elseif ($value === false) {
                                    $value = "<span class='text-danger fw-bold'>&cross;</span>";
                                }
                                echo $value;
                            } elseif ($key === "vote") {
                                $result = "";
                                for ($i=0; $i < 5; $i++) {
                                    if ($i < $value) {
                                        $result = "$result&#9733;";
                                    } else {
                                        $result = "$result&#9734;";
                                    }
                                }
                                echo $result;
                            } elseif ($key === "distance_to_center") {
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
            
            </tbody>
        </table>
    </div>
</body>
</html>