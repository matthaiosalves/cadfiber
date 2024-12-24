const fs = require('fs');
const path = require('path');

// Caminho do diretório do tema (ajuste conforme necessário)
const themePath = path.join(__dirname, './');

// Função para verificar e adicionar loading="lazy"
function processFiles(dir) {
    fs.readdirSync(dir).forEach(file => {
        const filePath = path.join(dir, file);

        // Verifica se é diretório ou arquivo
        if (fs.statSync(filePath).isDirectory()) {
            processFiles(filePath);  // Recursão para subdiretórios
        } else if (file.endsWith('.php') || file.endsWith('.html')) {
            let content = fs.readFileSync(filePath, 'utf8');

            // Expressão para capturar <img> sem loading="lazy"
            const imgRegex = /<img([^>]*)(?<!loading=["']lazy["'])/g;

            let updatedContent = content.replace(imgRegex, (match, p1) => {
                // Se já houver loading, não adiciona
                if (p1.includes('loading=')) {
                    return match;
                }
                return `<img loading="lazy"${p1}`;
            });

            // Salva o arquivo atualizado
            fs.writeFileSync(filePath, updatedContent, 'utf8');
            console.log(`Processado: ${filePath}`);
        }
    });
}

// Inicia a verificação no diretório do tema
processFiles(themePath);
console.log('Todas as imagens foram verificadas para lazy loading!');
