const fs = require('fs');
const path = require('path');
const postcss = require('postcss');
const cssnano = require('cssnano');

// Caminhos dos arquivos CSS
const bootstrapPath = path.join(__dirname, 'css/bootstrap.min.css');
const customPath = path.join(__dirname, 'style.css');
const outputPath = path.join(__dirname, 'style.min.css');  // Gera style.min.css

// Lê o conteúdo dos arquivos CSS
const bootstrapCSS = fs.readFileSync(bootstrapPath, 'utf8');
const customCSS = fs.readFileSync(customPath, 'utf8');

// Extrai @import do style.css (mas ignora o cabeçalho)
const importRegex = /@import[^;]+;/g;
const importMatch = customCSS.match(importRegex);

// Mantém @import no topo (se existir)
const imports = importMatch ? importMatch.join('\n') : '';

// Remove o cabeçalho e @import do CSS customizado
const customCSSWithoutHeader = customCSS
  .replace(/\/\*[\s\S]*?\*\//, '')  // Remove o cabeçalho
  .replace(importRegex, '')          // Remove o @import duplicado
  .trim();

// Combina o @import + Bootstrap + CSS customizado
const combinedCSS = `${imports}\n\n${bootstrapCSS}\n\n${customCSSWithoutHeader}`;

// Minifica o CSS com cssnano
postcss([cssnano])
  .process(combinedCSS, { from: undefined })
  .then(result => {
    // Salva apenas o CSS minificado no style.min.css (sem cabeçalho)
    fs.writeFileSync(outputPath, result.css, 'utf8');
    console.log('CSS combinado, minificado e salvo como style.min.css sem cabeçalho!');
  })
  .catch(err => {
    console.error('Erro ao minificar o CSS:', err);
  });
