var audio = new Audio('/audio/sucess.mp3');

// Dans la fonction qui gère la soumission du formulaire

function handleFormSubmission() {
    var notificationDuration = 9000;
    audio.play();
    setTimeout(function() {
        audio.pause();
        audio.currentTime = 0;
    }, notificationDuration);
}