const fs = require('fs');
const path = require('path');
const cheerio = require('cheerio');
const uglify = require('uglify-js');

// Caminho do Bootstrap e diretórios a serem analisados
const jsFilePath = './js/bootstrap.bundle.min.js';
const searchPaths = ['./', './templates'];  // Raiz e templates

// Função para buscar todos os arquivos PHP nos diretórios especificados
function getPhpFiles(dirs) {
    let phpFiles = [];
    
    dirs.forEach(dir => {
        const files = fs.readdirSync(dir);

        files.forEach(file => {
            const fullPath = path.join(dir, file);
            const stat = fs.statSync(fullPath);

            if (stat.isDirectory()) {
                phpFiles = phpFiles.concat(getPhpFiles([fullPath]));  // Busca recursiva
            } else if (fullPath.endsWith('.php')) {
                phpFiles.push(fullPath);
            }
        });
    });

    return phpFiles;
}

// Analisa os arquivos PHP para encontrar componentes Bootstrap usados
function getUsedBootstrapComponentsFromPhp(phpFiles) {
    const usedComponents = new Set();

    phpFiles.forEach(file => {
        const content = fs.readFileSync(file, 'utf-8');
        const $ = cheerio.load(content);

        $('[data-bs-toggle]').each((i, el) => {
            const component = $(el).attr('data-bs-toggle');
            usedComponents.add(component);
        });
    });

    return Array.from(usedComponents);
}

// Remove componentes não utilizados do JS
function purgeBootstrap(jsContent, usedComponents) {
    const components = {
        Tooltip: 'Tooltip',
        Popover: 'Popover',
        Carousel: 'Carousel',
        Modal: 'Modal',
        Dropdown: 'Dropdown',
        Collapse: 'Collapse',
        Offcanvas: 'Offcanvas',
        Tab: 'Tab'
    };

    Object.keys(components).forEach(component => {
        if (!usedComponents.includes(components[component])) {
            const regex = new RegExp(`\\/\\*!.*?${component}.*?\\*\\/([\\s\\S]*?)return.*?${component}.*?}`, 'g');
            jsContent = jsContent.replace(regex, '');
        }
    });

    return jsContent;
}

// Função principal
(async function run() {
    try {
        let bootstrapJs = fs.readFileSync(jsFilePath, 'utf-8');

        // Busca arquivos PHP na raiz e em templates
        const phpFiles = getPhpFiles(searchPaths);
        console.log('Arquivos PHP encontrados:', phpFiles);

        // Identifica componentes Bootstrap usados
        const usedComponents = getUsedBootstrapComponentsFromPhp(phpFiles);
        console.log('Componentes identificados:', usedComponents);

        // Remove componentes não utilizados do Bootstrap JS
        let customizedBootstrap = purgeBootstrap(bootstrapJs, usedComponents);

        // Minifica o JS final
        const result = uglify.minify(customizedBootstrap);

        if (result.error) {
            console.error('Erro ao minificar:', result.error);
            return;
        }

        fs.writeFileSync('./js/bootstrap.purged.min.js', result.code);
        console.log('Arquivo bootstrap.purged.min.js criado com sucesso.');
    } catch (error) {
        console.error('Erro geral:', error);
    }
})();
