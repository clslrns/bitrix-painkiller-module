<?
/*
Returns component parametrs for given component name

Usage:
?component=bitrix:news.list

Response in JSON: {
    status:
        found — component founded,
        not_found — ...,
        error — bad component name
        not_found — ...,
        error — bad component name
    data:
        in error case — array with calculated namespace and component name for debug purposes;
        in other cases, array with component' default params
}
*/

$bitrixDir = dirname( __FILE__ ) . '/../..';
require $bitrixDir . '/modules/main/include.php';

list( $arCData['nspace'], $arCData['name'] ) = explode( ':', urldecode($_GET['component']) );

// Namespace and name validation
if( !preg_match( '/[a-zA-Z_-]+/', $arCData['nspace'] )
    || !preg_match( '/[a-zA-Z._-]+/', $arCData['name'] ) )
{
    echo json_encode(
        array(
            'status' => 'error',
            'data' => $arCData
        )
    );
    die;
}

$arCData['dir']  = $bitrixDir . '/components/'
                 . $arCData['nspace'] . '/'
                 . $arCData['name'];

$arReturn = array(
    'status' => 'not_found'
);
if( is_file( $arCData['dir'] . '/.parameters.php' ) ){
    include $arCData['dir'] . '/.parameters.php';

    ksort( $arComponentParameters['PARAMETERS'] );

    foreach( $arComponentParameters['PARAMETERS'] as $paramName => $arParam ){
        $arParams[ $paramName ] = $arParam['DEFAULT'] ? $arParam['DEFAULT'] : '';
    }
    $arReturn['status'] = 'found';
    $arReturn['data'] = $arParams;
}

echo json_encode( $arReturn );