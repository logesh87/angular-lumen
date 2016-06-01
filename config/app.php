
<?php 

$config     =   [];



switch(getenv('APP_ENV'))
{
   case 'production': 
        $config['facebook']  =[
            'app_id' => '992372617485119',
            'app_secret' => '61518d63ed52a9fd72739b43811ada32',
            'version' => 'v2.6',
            'page_id' => '',
            'page_url' => '',
            'tab_url' => '',
            'auth_scope' => 'email',
            'developers' => ''            
        ];
   break;

   case 'development':
        $config['facebook']  =[
            'app_id' => '992372987485082',
            'app_secret' => 'c1e706f4cc087c237670eee30d1ccde9',
            'version' => 'v2.6',
            'page_id' => '',
            'page_url' => 'https://www.facebook.com/EkhoAppsTesting/',
            'tab_url' => 'https://www.facebook.com/EkhoAppsTesting/app/992372987485082',
            'auth_scope' => 'email',
            'developers' => '',
            'callback_url' => 'https://dev-faq-dhl.dev.krds.com/df'
        ];
   break;

   case 'staging':
        $config['facebook']  =[
            'app_id' => '258584081156591',
            'app_secret' => '56dc8ab8b3e19e31cc7ac2b62121664d',
            'version' => 'v2.6',
            'page_id' => '',
            'page_url' => 'https://www.facebook.com/EkhoAppsTesting/',
            'tab_url' => 'https://www.facebook.com/EkhoAppsTesting/app/992376227484758',
            'auth_scope' => 'email',
            'developers' => ''        
        ];
   break;

   case 'testing':
        $config['facebook']  =[
            'app_id' => '258583677823298',
            'app_secret' => '6d605f1ebb2621cd802fbb78df070430',
            'version' => 'v2.6',
            'page_id' => '',
            'page_url' => 'https://www.facebook.com/EkhoAppsTesting/',
            'tab_url' => 'https://www.facebook.com/EkhoAppsTesting/app/992376070818107',
            'auth_scope' => 'email',
            'developers' => ''            
        ];    
   break;

   case 'local':        
        $config['facebook']  =[
            'app_id' => '1710135712595429',
            'app_secret' => 'ba096db78f3e5c50b7b22a8c7a7d2bc9',
            'version' => 'v2.6',
            'page_id' => '',
            'page_url' => 'https://www.facebook.com/EkhoAppsTesting/',
            'tab_url' => 'https://www.facebook.com/EkhoAppsTesting/app/1710135712595429/',
            'auth_scope' => 'email',
            'developers' => '',
            'callback_url' => 'http://localhost:4000'            
        ];
   break;


}

return $config;
 ?>