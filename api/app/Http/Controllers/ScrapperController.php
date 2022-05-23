<?php

namespace App\Http\Controllers;

use Goutte\Client;

class ScrapperController extends Controller
{
   public function verifyCUIT(Client $client)
   {
       // URL https://www.dateas.com/es/consulta_cuit_cuil?cuit=$cuit
       $crawler = $client->request('GET','https://www.dateas.com/es/consulta_cuit_cuil?cuit=20389958043');
       dd($crawler);
   }
}
