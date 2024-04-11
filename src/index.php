<?php
$api_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjFiOTUwNGFjLTUwYjktNGFkZS1iNmY3LTZhZDZlNTdmYmRhOSIsImlhdCI6MTcxMTM2NjI5NSwic3ViIjoiZGV2ZWxvcGVyL2Y1Y2NiMDUzLTg0ZTgtYzM1OC1lNWQzLWQ3ZmY4ZDVhY2EwMyIsInNjb3BlcyI6WyJicmF3bHN0YXJzIl0sImxpbWl0cyI6W3sidGllciI6ImRldmVsb3Blci9zaWx2ZXIiLCJ0eXBlIjoidGhyb3R0bGluZyJ9LHsiY2lkcnMiOlsiODYuMTI3LjIyNi4xMzUiXSwidHlwZSI6ImNsaWVudCJ9XX0.PLvlJGqRI2NE1CAqWFpMZtprIRqs7S1QN9w7zB7O1mK2aSGZqdintUpZIffslmOTORKQ2xGczWjqmjwA9O1P3Q';

if (isset($_GET['player_tag'])) {
    $player_tag = $_GET['player_tag'];
    $url = "https://api.brawlstars.com/v1/players/%23{$player_tag}";
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Authorization: Bearer {$api_key}"
        ]
    ];
    $context = stream_context_create($opts);
    $data = file_get_contents($url, false, $context);
    if ($data === false) {
        echo "Error al recuperar los datos del jugador.";
    } else {
        // Decodifica el JSON en un array asociativo
        $data = json_decode($data, true);

        

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador Brawl Stars</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col gap-6">
    <header class="flex flex-col gap-4 p-4">
        <h1 class="titulo">Buscador Brawl Stars</h1>

        <form class="flex gap-4">
            <input type="text" name="player_tag" placeholder="Introduce tu ID" autocomplete="off" class="pl-4 bg-transparent">
            <button type="submit">
                <img class="pr-2" src="/img/search-icon.svg" alt="">
            </button>
        </form>
    </header>


    <section id="section-1" class="flex gap-4 justify-items-center items-center">
    <?php if (!empty($data)) { ?>
        <div class="name">
            <p><?php echo ($data['name'] ?? ''); ?></p>
        </div>
        <div class="trof">
            <img src="/img/trophies-icon.png" alt="" class="img1">
            <p><?php echo ($data['trophies'] ?? ''); ?></p>
        </div>
    <?php } ?>
</section>

<section id="section-2" class="flex gap-4">
    <?php if (!empty($data['club'])) { ?>
        <div class="club">
            <img src="/img/club-icon.png" alt="" class="img2">
            <p><?php echo ($data['club']['name'] ?? ''); ?></p>
        </div>
    <?php } ?>
</section>

<section id="section-3" class="flex flex-col gap-4">
    <div class="flex">
        <div class="solo">
            <img src="/img/solo-icon.png" alt="" class="img3">
            <p><?php echo ($data['soloVictories'] ?? ''); ?></p>
        </div>
        <div class="duo">
            <img src="/img/duo-icon.png" alt="" class="img4">
            <p><?php echo ($data['duoVictories'] ?? ''); ?></p>
        </div>
    </div>
    <div class="vs">
        <div class="vs3">
            <img src="/img/3vs3-icon.png" alt="" class="img5">
            <p><?php echo ($data['3vs3Victories'] ?? ''); ?></p>
        </div>
    </div>

    <div class="dani">
        <div class="by">
            <p>By Duma</p>
        </div>
    </div>
</section>



    <script src="https://cdn.tailwindcss.com"></script>

</body>
</html>