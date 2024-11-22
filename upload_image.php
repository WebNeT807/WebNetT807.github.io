<?php
// Vérifie si le fichier image a été téléchargé
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Définir le répertoire où les images seront enregistrées
    $image_dir = 'assets/images/';
    
    // Récupérer les informations sur le fichier téléchargé
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = $image_dir . basename($image_name);

    // Vérifier si le répertoire d'images existe
    if (!is_dir($image_dir)) {
        mkdir($image_dir, 0777, true);
    }

    // Déplacer l'image dans le répertoire de destination
    if (move_uploaded_file($image_tmp, $image_path)) {
        // Récupérer les autres informations depuis le formulaire
        $title = $_POST['title'];
        $description = $_POST['description'];
        $url = $_POST['url'];

        // Charger le fichier JSON existant
        $files = json_decode(file_get_contents('assets/data/files.json'), true);

        // Ajouter le nouveau fichier avec l'image
        $newFile = [
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'image' => 'assets/images/' . basename($image_name)
        ];
        $files[] = $newFile;

        // Sauvegarder les données dans le fichier JSON
        file_put_contents('assets/data/files.json', json_encode($files, JSON_PRETTY_PRINT));

        // Retourner une réponse JSON
        echo json_encode(['status' => 'success', 'message' => 'Fichier ajouté avec succès.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors du téléchargement de l\'image.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Aucune image téléchargée.']);
}
?>
