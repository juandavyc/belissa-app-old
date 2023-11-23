<?php

$videos = array(
    'https://www.youtube.com/watch?v=rscOXVuaCGw', # Duro 2 horas -  Faraón Love Shady
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ', # Rick Astley - Never Gonna Give You Up
    'https://www.youtube.com/watch?v=l_KuNmn2KXY', # PANOCHA - Faraón Love Shady
    'https://www.youtube.com/watch?v=ARWg160eaX4', # Bad Bunny - Neverita (Video Oficial) | Un Verano Sin Ti 
    'https://www.youtube.com/watch?v=H9K8-3PHZOU', # The HampsterDance Song 
    'https://www.youtube.com/watch?v=dOMoolbCJS0', # [2 HOURS] TROLL PARTY! 
    'https://www.youtube.com/watch?v=33j6JmCf7Wo', # EL BAILE DEL TROLEO 1 HORA REMIX 
    'https://www.youtube.com/watch?v=tfnZa7C0Hzo', # UN DOS TRES CUATRO 1 HOUR 
);

echo " <script> location.href='" . $videos[rand(0, max(array_keys($videos)))] . "';</script>";