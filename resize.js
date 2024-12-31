const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

// Caminho correto para a pasta img dentro do tema
const inputFolder = path.join(__dirname, 'wp-content', 'themes', 'cadfiber-bundle', 'img');
const outputFolder = path.join(__dirname, 'wp-content', 'themes', 'cadfiber-bundle', 'img');

// Certifica-se de que a pasta de saída existe
if (!fs.existsSync(outputFolder)) {
    fs.mkdirSync(outputFolder, { recursive: true });
}

// Tamanhos desejados
const sizes = [600, 1200];

// Função para redimensionar a imagem
async function resizeImage(file) {
    const inputPath = path.join(inputFolder, file);
    const ext = path.extname(file);
    const baseName = path.basename(file, ext);

    for (const size of sizes) {
        const outputPath = path.join(outputFolder, `${baseName}-${size}${ext}`);

        // Verifica se a imagem já existe para evitar redundância
        if (fs.existsSync(outputPath)) {
            console.log(`Imagem já existe: ${outputPath}, pulando...`);
            continue;
        }

        // Redimensiona a imagem
        await sharp(inputPath)
            .resize(size)
            .toFile(outputPath)
            .then(() => {
                console.log(`Imagem redimensionada: ${outputPath}`);
            })
            .catch(err => {
                console.error(`Erro ao redimensionar ${file}:`, err);
            });
    }
}

// Processa todas as imagens na pasta
fs.readdirSync(inputFolder).forEach(file => {
    if (/\.(jpg|jpeg|png|webp)$/i.test(file)) {
        resizeImage(file);
    }
});
