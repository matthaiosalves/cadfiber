const fs = require('fs');
const path = require('path');
const glob = require('glob');  // Agora funciona normalmente com require()

// Caminho para imagens dentro da pasta do tema
const imgPath = path.join(__dirname, 'img/**/*.{jpg,jpeg,png}');
const themePath = path.join(__dirname, './');

// Função para converter imagens para WebP
async function convertImages() {
    const imagemin = (await import('imagemin')).default;
    const imageminWebp = (await import('imagemin-webp')).default;

    const files = await imagemin([imgPath], {
        destination: path.join(__dirname, 'img/'),
        plugins: [
            imageminWebp({ quality: 75 })
        ]
    });
    console.log(`✅ ${files.length} imagens convertidas para WebP!`);
}

// Função para substituir as referências de imagens no tema
function replaceImageReferences() {
    glob(`${themePath}/**/*.{php,html}`, (err, files) => {
        if (err) {
            console.error('❌ Erro ao localizar arquivos:', err);
            return;
        }
        
        files.forEach(file => {
            let content = fs.readFileSync(file, 'utf8');
            
            // Substitui .jpg, .jpeg e .png por .webp na pasta /img/
            content = content.replace(/(\/img\/[a-zA-Z0-9_-]+)\.(jpg|jpeg|png)/g, '$1.webp');
            
            fs.writeFileSync(file, content, 'utf8');
            console.log(`🔄 Referências atualizadas: ${file}`);
        });
    });
}

// Executa as duas funções em sequência
async function run() {
    await convertImages();
    replaceImageReferences();
}

run().catch(err => console.error('Erro ao executar:', err));
