<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assurez-vous que les champs nécessaires sont présents
    if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message'])) {
        $name = strip_tags(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $message = strip_tags(trim($_POST['message']));

        // Validez que les données sont correctes
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // L'adresse email n'est pas valide
            echo "Adresse email invalide.";
            exit;
        }

        // Définissez à qui l'email doit être envoyé
        $to = "tommi.putelat2@gmail.com"; // Remplacez par votre adresse email réelle
        $subject = "Nouveau message de $name";
        $body = "Vous avez reçu un nouveau message de $name ($email):\n\n$message";

        // En-têtes pour le courriel
        $headers = "From: $name <$email>";

        // Envoie de l'email
        if (mail($to, $subject, $body, $headers)) {
            echo "Message envoyé avec succès.";
        } else {
            echo "Erreur lors de l'envoi du message.";
        }
    } else {
        echo "Des champs obligatoires sont manquants.";
    }
} else {
    // N'est pas une requête POST
    echo "Erreur: Méthode de requête non prise en charge.";
}
?>
