<?
global $DOCUMENT_ROOT;
$arPath = array(
    $DOCUMENT_ROOT . '/bitrix/modules/thelikers.painkiller/',
    $DOCUMENT_ROOT . '/bitrix/tools/'
);

IncludeModuleLangFile(__FILE__);

foreach( $arPath as $path ){
    if( !is_writable( $path ) ){
        echo CAdminMessage::ShowMessage( GetMessage('PAINKILLER_PERMISSION_ERROR') . $path );
    }
}
?>

<form action="<?=$APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?=LANG?>">
    <input type="submit" name="" value="<?=GetMessage("MOD_BACK")?>">
<form>