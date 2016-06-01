var mysql   =   require('mysql'),
    fs = require("fs");

var envPath = '/home/server/htdocs/projects/clients/dhl-faq/conf/env/.env-dev';
var env = require('dotenv').config({
    path:  fs.existsSync(envPath)?envPath:__dirname+'/../conf/env/.env-dev'
});

var connection = mysql.createConnection({
        host                : process.env.DB_HOST,
        user                : process.env.DB_USERNAME,
        password            : process.env.DB_PASSWORD,
        database            : process.env.DB_DATABASE,
        multipleStatements  : true
    });

var queryString = 'SELECT * FROM i18n_locales WHERE is_enabled = 1 LIMIT 1';
 label_list = {};

connection.query(queryString, function(err, rows, fields) {
    if (err) throw err;

    var enabled_locale = rows[0].locale;
    var localesQuery = 'SELECT id_label,'+enabled_locale+'  FROM i18n_locales_labels';

    
    connection.query(localesQuery, function(err, labels, fields) {
        if (err) throw err;

        for(var n in labels) {

            var locale_name = labels[n].id_label, label_name=labels[n][enabled_locale];

            label_list[locale_name] = label_name;
        }

       enabled_locale = 'fr';
       fs.writeFile('public/assets/languages/' + enabled_locale+'.json', JSON.stringify(label_list), function (err) {
          if (err) throw err;
          console.log('Saved!');
        });
    
    });
    connection.end();
  
});