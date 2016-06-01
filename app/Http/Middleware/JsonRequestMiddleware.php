<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
class JsonRequestMiddleWare
{

  
    public function handle(Request $request, Closure $next)
    {

        $is_facebook = null;
        $is_api = null;
        $is_bo = null;

        if( ! $request->ajax())
        {            
            //echo $_SERVER['HTTP_REFERER'];
            if(isset($_SERVER['HTTP_REFERER'])){                
                $is_facebook        =   preg_match('/facebook.com/', $_SERVER['HTTP_REFERER']);
                $is_api             =   preg_match('/api/', $_SERVER['REQUEST_URI']);                
            }
            $is_bo              =   preg_match('/bo/', $_SERVER['REQUEST_URI']);                   
        
           if(!device('isMobile') && !$is_facebook && getenv('APP_ENV') != 'local'){                 
              if(!$is_api && !$is_bo){                
                return new RedirectResponse(conf('facebook.tab_url'));
              }
           }
        }
       
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])
            && $request->isJson()
        ) {
            $data = $request->json()->all();
            $request->request->replace(is_array($data) ? $data : []);
        }
        return $next($request);
    }
}