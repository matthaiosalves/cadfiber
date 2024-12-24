const fs = require('fs');
const path = require('path');

// Caminho para o arquivo style.css
const stylePath = path.join(__dirname, 'style.css');

// Lê o arquivo style.css
fs.readFile(stylePath, 'utf8', (err, data) => {
  if (err) {
    console.error('Erro ao ler o arquivo style.css:', err);
    return;
  }

  // Captura a versão atual
  const versionRegex = /Version:\s*(\d+\.\d+\.\d+)/;
  const match = data.match(versionRegex);

  if (match) {
    let versionParts = match[1].split('.').map(Number);
    versionParts[2]++;  // Incrementa a versão de patch (x.x.PATCH)

    const newVersion = versionParts.join('.');
    const updatedData = data.replace(versionRegex, `Version: ${newVersion}`);

    // Escreve o novo style.css com a versão incrementada
    fs.writeFile(stylePath, updatedData, 'utf8', (err) => {
      if (err) {
        console.error('Erro ao atualizar a versão:', err);
        return;
      }
      console.log(`Versão atualizada para ${newVersion}`);
    });
  } else {
    console.log('Não foi possível encontrar a versão no style.css.');
  }
});
