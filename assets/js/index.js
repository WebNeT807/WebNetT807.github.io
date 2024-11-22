// Contrôle du volume de la musique
document.getElementById('bg-music').volume = 0.15;  // Volume à 15%

// Affichage dynamique des fichiers
function displayFiles() {
  const files = JSON.parse(localStorage.getItem('files')) || [];
  const fileList = document.getElementById('file-list');

  fileList.innerHTML = files
    .map(
      (file) => `
      <div class="file-item">
        <img src="${file.image}" alt="${file.title}">
        <h5>${file.title}</h5>
        <p>${file.description}</p>
        <a href="${file.link}" target="_blank">
          <button class="download-btn">Télécharger</button>
        </a>
      </div>`
    )
    .join('');
}

// Gestion du clavier pour la connexion admin
document.addEventListener('keydown', function (e) {
  if (e.ctrlKey && e.key === 'm') {
    const modal = new bootstrap.Modal(document.getElementById('admin-modal'));
    modal.show();
  }
});

// Connexion à la page admin
document.getElementById('admin-login-form').addEventListener('submit', function (e) {
  e.preventDefault();
  const username = document.getElementById('admin-username').value;
  const password = document.getElementById('admin-password').value;

  if (username === 'Admin' && password === 'Antoine80@') {
    window.location.href = 'admin.html';
  } else {
    alert('Identifiants incorrects');
  }
});

// Initialisation
displayFiles();
