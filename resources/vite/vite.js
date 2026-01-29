const {glob} = require("glob")
const fs = require('fs');

var arguments = process.argv;

let onProduction = false

if (typeof arguments[2] !== 'undefined' && arguments[2] === '--build') {
    onProduction = true;
}

const modeTitle = onProduction === false ? 'Development' : 'Production';

const newFiles = glob(['app/Utils/Enqueuer/Vite.php'])

newFiles.then(function (files) {
    files.forEach(function (item, index, array) {
        const data = fs.readFileSync(item, 'utf8');

        let result;

        if(onProduction){
            const mapObj = {
                DEVELOPMENT_MODE: "PRODUCTION_MODE"
            };
            result = data.replace(/DEVELOPMENT_MODE/gi, function (matched) {
                return mapObj[matched];
            });
        }else{
            const mapObj = {
                PRODUCTION_MODE: "DEVELOPMENT_MODE"
            };
            result = data.replace(/PRODUCTION_MODE/gi, function (matched) {
                return mapObj[matched];
            });
        }

        fs.writeFile(item, result, 'utf8', function (err) {
            if (err) return console.log(err);
        });
        console.log(`✅ ${modeTitle} asset enqueued!`);
    });
})
