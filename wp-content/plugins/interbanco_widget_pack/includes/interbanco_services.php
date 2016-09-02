<?php


function consultar_tipo_cambio($url)
{
    //write_log($url);

    $service_url = $url;
    $params = array();


    $params['intCanalIn'] = 1;
    $params['intCanalOut'] = 1;
    $params['strReference'] = "1";
    $params['strCuenta'] = "0";
    $params['strOperacion'] = "MD";
    $params['strTrader'] = "";
    $params['strMonedaCuenta'] = "QTZ";
    $params['strMonedaTransaccion'] = "USD";
    $params['strUsuario'] = "IGTPGMRS";


    $client = new SoapClient($service_url, $params);

    $result = $client->TipoCambioAux($params);



    //write_log($result);

    if ($result->TipoCambioAuxResult->strResultCodigo = "000")
    {
        $xmlResult = new SimpleXMLElement($result->TipoCambioAuxResult->strResultDatos);
        //write_log($xmlResult);

        return $xmlResult->Table;

    }
    else
    {
        return null;
    }

}



function consultar_agencias_service($url)
{
    //write_log($url);

    $service_url = $url;
    $params = array();


//    $params['intCanalIn'] = 1;
//    $params['intCanalOut'] = 1;
//    $params['strReference'] = "1";
//    $params['strCuenta'] = "0";
//    $params['strOperacion'] = "MD";
//    $params['strTrader'] = "";
//    $params['strMonedaCuenta'] = "QTZ";
//    $params['strMonedaTransaccion'] = "USD";
//    $params['strUsuario'] = "IGTPGMRS";


    $client = new SoapClient($service_url, $params);

    $result = $client->getAgenciasInterBanco($params);




    //write_log($result);

    $jsonResult = json_decode($result->getAgenciasInterBancoResult, false);

    if ($jsonResult->cod = "000") {
        return $jsonResult->agencias;
    }
    else
    {
        return null;
    }

}


