document.getElementById('upload-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const title = document.getElementById('file-title').value;
  const description = document.getElementById('file-description').value;
  const link = document.getElementById('file-link').value;
  const image = document.getElementById('file-image').value;

  const files = JSON.parse(localStorage.getItem('files')) || [];
  files.push({ title, description, link, image });
  localStorage.setItem('files', JSON.stringify(files));

  alert('Fichier ajouté avec succès !');
  document.getElementById('upload-form').reset();
});
