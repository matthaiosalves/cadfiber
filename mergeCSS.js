const fs = require('fs');
const path = require('path');
const postcss = require('postcss');
const cssnano = require('cssnano');

// Caminhos dos arquivos CSS
const bootstrapPath = path.join(__dirname, 'css/bootstrap.min.css');
const customPath = path.join(__dirname, 'style.css');
const outputPath = path.join(__dirname, 'style.css');  // Sobrescreve o style.css na raiz

// Lê o conteúdo dos arquivos CSS
const bootstrapCSS = fs.readFileSync(bootstrapPath, 'utf8');
const customCSS = fs.readFileSync(customPath, 'utf8');

// Extrai o cabeçalho do style.css (até encontrar "*/")
const headerRegex = /\/\*[\s\S]*?\*\//;
const importRegex = /@import[^;]+;/g;

const headerMatch = customCSS.match(headerRegex);
const importMatch = customCSS.match(importRegex);

// Mantém o cabeçalho do tema
const header = headerMatch ? headerMatch[0] : '/* Tema WordPress */';

// Mantém @import no topo (se existir)
const imports = importMatch ? importMatch.join('\n') : '';

// Remove o cabeçalho e @import do CSS customizado para evitar duplicidade
const customCSSWithoutHeader = customCSS
  .replace(headerRegex, '')
  .replace(importRegex, '')
  .trim();

// Combina o cabeçalho + @import + Bootstrap + CSS customizado
const combinedCSS = `${header}\n\n${imports}\n\n${bootstrapCSS}\n\n${customCSSWithoutHeader}`;

// Minifica o CSS com cssnano
postcss([cssnano])
  .process(combinedCSS, { from: undefined })
  .then(result => {
    fs.writeFileSync(outputPath, result.css, 'utf8');
    console.log('CSS combinado, cabeçalho preservado, @import mantido e minificado com sucesso!');
  })
  .catch(err => {
    console.error('Erro ao minificar o CSS:', err);
  });
