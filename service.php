<?php

class DimeCuba extends Service{

  public function _main(Request $request){
    $images=['logo' => $this->pathToService.'/img/logo.png'];
    $today=Connection::query("SELECT A.username AS user, DATE_FORMAT(B.`inserted_date`, '%h:%i %p') AS hora FROM person A JOIN `_tienda_orders` B ON A.email=B.email AND CONVERT(B.`inserted_date`,DATE) = CONVERT(CURRENT_TIMESTAMP,DATE) AND B.product='1806121252'");
    $disponible=!isset($today[0]);
    
    $content=['images' => $images,'disponible' => $disponible, 'today' => $today];

    $response= new Response();
    $response->subject="DimeCuba";
    $response->createFromTemplate("main.tpl",$content,$images);
    return $response;
  }

  public function _recargar(Request $request){
    $images=['logo' => $this->pathToService.'/img/logo.png'];
    $today=Connection::query("SELECT A.username AS user, DATE_FORMAT(B.`inserted_date`, '%h:%i %p') AS hora FROM person A JOIN `_tienda_orders` B ON A.email=B.email WHERE CONVERT(B.`inserted_date`,DATE) = CONVERT(CURRENT_TIMESTAMP,DATE) AND B.product='1806121252'");
    $disponible=!isset($today[0]);
    $response= new Response();

      $number=(strlen($request->query)==10)?$request->query:"";
      $number=(substr($number,0,2)=="53")?$number:"";

      if (!empty($number)) {
        $user=Utils::getPerson($request->email);

        if (empty($user->phone)) Connection::query("UPDATE person SET phone='$number' WHERE email='$request->email'");

        if (!$disponible) {
          $response->subject="Recarga no disponible";
          $response->createFromTemplate("nodisponible.tpl",array('today' => $today));
          return $response;
        }

        if ($user->credit<40) {
          $response->subject="Error en su recarga";
          $response->createFromText("Usted tiene &sect;$user->credit de credito, lo cual no es suficiente para comprar la recarga con un valor de &sect;40");
          return $response;
        }

        $confirmationHash = Utils::generateRandomHash();
        Connection::query("START TRANSACTION;
        UPDATE person SET credit=credit-40 WHERE email='$request->email';
        UPDATE person SET credit=credit+40 WHERE email='alex@apretaste.com';
        INSERT INTO _tienda_orders(product,email,phone) VALUES('1806121252','$request->email','+$number');
        INSERT INTO transfer(sender,receiver,amount,confirmation_hash,inventory_code,transfered) VALUES ('$request->email', 'alex@apretaste.com', 40, '$confirmationHash', 'RECARGA DimeCuba',1);
        COMMIT;");

        $response->subject="DimeCuba Recarga Confirmada";
        $response->createFromTemplate("confirmar.tpl",array('images' => $images),$images);
      }
      else {
        $response->subject="Error en su recarga";
        $response->createFromText("El número que ingreso es invalido. El numero debe iniciar con 53 y tener una longitud total de 10 numeros");
      }

    return $response;
  }

  public function _anteriores(Request $request){
    $images=['logo' => $this->pathToService.'/img/logo.png'];
    $compradores=Connection::query("SELECT A.username AS user, DATE_FORMAT(B.`inserted_date`, '%d/%m/%Y %h:%i %p') AS fecha 
      FROM person A JOIN _tienda_orders B 
      ON A.email=B.email AND B.product='1806121252' 
      ORDER BY fecha DESC 
      LIMIT 30");

    $response= new Response();
    $response->subject="Ultimas recargas";
    $response->createFromTemplate("anteriores.tpl",array('compradores' => $compradores, 'images' => $images),$images);
    return $response;
  }

  public function _mias(Request $request)
  {
    $images=['logo' => $this->pathToService.'/img/logo.png'];
    $recargas=Connection::query("SELECT DATE_FORMAT(B.`inserted_date`, '%d/%m/%Y %h:%i %p') AS fecha, A.amount AS amount, B.phone AS phone
      FROM `transfer` A JOIN _tienda_orders B 
      ON A.sender='$request->email' AND B.email='$request->email' AND A.inventory_code='RECARGA DimeCuba'
      AND CONVERT(B.`inserted_date`,DATE) = CONVERT(A.transfer_time,DATE) AND B.product='1806121252'
      ORDER BY fecha DESC");

    $response= new Response();
    $response->subject="Sus recargas";
    $response->createFromTemplate("misrecargas.tpl",array('recargas' => $recargas, 'images' => $images),$images);
    return $response;
  }
}
