<?php
// Vérifie si le formulaire a été soumis avec les informations nécessaires
if (isset($_POST['title'], $_POST['description'], $_POST['url'])) {
    // Récupérer les données envoyées par le formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $image = isset($_POST['image']) ? $_POST['image'] : ''; // Si une image est fournie

    // Charger le fichier JSON existant
    $files = json_decode(file_get_contents('assets/data/files.json'), true);
    
    // Si le fichier JSON est vide, initialiser un tableau vide
    if (!$files) {
        $files = [];
    }

    // Créer un nouveau fichier avec les informations envoyées
    $newFile = [
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'image' => $image
    ];

    // Ajouter le nouveau fichier à la liste
    $files[] = $newFile;

    // Sauvegarder les données dans le fichier JSON
    file_put_contents('assets/data/files.json', json_encode($files, JSON_PRETTY_PRINT));

    // Retourner une réponse JSON
    echo json_encode(['status' => 'success', 'message' => 'Fichier ajouté avec succès.']);
} else {
    // Si les informations nécessaires ne sont pas présentes, retourner une erreur
    echo json_encode(['status' => 'error', 'message' => 'Les données nécessaires ne sont pas fournies.']);
}
?>
