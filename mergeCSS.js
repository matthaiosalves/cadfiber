const fs = require('fs');
const path = require('path');
const postcss = require('postcss');
const cssnano = require('cssnano');

// Caminhos dos arquivos CSS
const bootstrapPath = path.join(__dirname, 'css/bootstrap.min.css');
const customPath = path.join(__dirname, 'style.css');
const outputPath = path.join(__dirname, 'style.css');  // Sobrescreve o style.css na raiz

// Lê os arquivos CSS
const bootstrapCSS = fs.readFileSync(bootstrapPath, 'utf8');
const customCSS = fs.readFileSync(customPath, 'utf8');

// Combina o Bootstrap com o CSS customizado
const combinedCSS = `${bootstrapCSS}\n\n${customCSS}`;

// Minifica o CSS com cssnano
postcss([cssnano])
  .process(combinedCSS, { from: undefined })
  .then(result => {
    fs.writeFileSync(outputPath, result.css, 'utf8');
    console.log('CSS combinado e minificado com sucesso!');
  })
  .catch(err => {
    console.error('Erro ao minificar o CSS:', err);
  });
