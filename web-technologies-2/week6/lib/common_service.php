<?php
 date_default_timezone_set ('Europe/Paris');
 header('Content-type: application/json;charset=UTF-8');

 spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
 });

 
 /**
  * @return meta infos array
  */
 function meta_infos(){
   return [
      'time' => date('Y-m-d H:i:s'),
      // autres meta info possibles
   ];
  }

 /**
  * code JSON d'une réponse en erreur (status error)
  * @param $message : texte du message associé
  * @return answer as a JSON string
  */
 function produceErrorAnswer(string $message){
    return json_encode( ['status'=>'error', 'message'=>$message , ...meta_infos()] );
 }
 /**
  * code JSON d'une réponse avec un résultat (status ok)
  * @param $result : résultat (type quelconque)
  * @return answer as a JSON string
  */
 function produceResultAnswer(mixed $result){
    return json_encode(['status'=>'ok','result'=>$result , ...meta_infos()] );
 }

?>
