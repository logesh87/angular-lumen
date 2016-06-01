<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use GenTux\Jwt\GetsJwtToken;
use GenTux\Jwt\GetsJwtController;
use GenTux\Jwt\JwtToken;
use App\Faq;

class FAQController extends Controller{

  public function __construct(){   

  }

  public function login(JwtToken $jwt, Request $cred){
    try {
      if($cred->username == "dhlfaq" && $cred->password == "123456"){      
        $payload = ['exp' => time() + 7200]; // expire in 2 hours
        $token = $jwt->createToken($payload); // new instance of JwtToken
        $result = ["message" => "success", "token" => $token];      
      }else{
        $result = ["message" => "INVALID_CREDENTIALS"];      
      }
      return response()->json($result);
    } catch (\Exception $e) {
      return response()->json(json_encode($e));
    }

    
  }

  public function saveFaq(Request $request){
    try {    
      $faq = new Faq;

      $faq->question = $request->question;
      $faq->answer = $request->answer;
      $faq->category_id = $request->categoryId;
      $faq->archived = $request->archived;
      $result =  $faq->save();      

      return response()->json($result);
    } catch (\Exception $e) {      
      return response()->json("error");
    }
  }

  public function getAllFaq(){ 
    try {       
      $faqs = Faq::all();
      return response()->json($faqs);
     } catch (\Exception $e) {
      return response()->json("error");
     }   
  }
  

  public function getFaq($id){ 
    try {       
      $faq = Faq::where('id', $id)->first();
      return response()->json($faq);
     } catch (\Exception $e) {
      return response()->json("error");
     }   
  }

  public function getFaqByCategory($cat_id){ 
    try {       
      $faq = Faq::where('category_id', $cat_id)->get();
      return response()->json($faq);
     } catch (\Exception $e) {
      return response()->json("error");
     }   
  }

  public function getFaqArchived(){ 
    try {       
      $faq = Faq::where('archived', 1)->get();
      return response()->json($faq);
     } catch (\Exception $e) {
      return response()->json("error");
     }   
  }

  public function updateFaq(Request $request){ 
    try {

      $result = Faq::where('id', $request->id)
                  ->update([
                    'question' => $request->question, 
                    'answer'   => $request->answer,
                    'category_id' => $request->categoryId, 
                    'archived' => $request->archived,
                    'archived' => $request->moderated
                ]);

      return response()->json($result);
       
     } catch (\Exception $e) {
       return response()->json("error");
     }   
  }

  public function deleteFaq(Request $request){
    try {
      $result = DB::table('faq')->where('id', $request->id)->delete();
      return response()->json($result);
      
    } catch (\Exception $e) {
      return response()->json("error");
    }
  }

  
}

