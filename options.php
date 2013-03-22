<?
if( !$USER->IsAdmin() ){
    return;
}

const ADMIN_MODULE_NAME = 'thelikers.painkiller';
$module_id = "thelikers.painkiller";

IncludeModuleLangFile( __FILE__ );

// Обрабатываем настройки
{
    if( $_POST['Update'] && $_POST['painkiller_host'] ){
        file_put_contents( dirname( __FILE__ ) . '/site_host', $_POST['painkiller_host'] );
    }
    $siteHost = file_get_contents( dirname( __FILE__ ) . '/site_host' );
}

$aTabs = array(
    array(
        "DIV" => 'edit1',
        "TAB" => GetMessage('PAINKILLER_SETTINGS'),
        "ICON" => 'ib_settings',
        "TITLE" => GetMessage('PAINKILLER_SETTINGS')
    )
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$tabControl->Begin();
?>

<form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>">
    <?$tabControl->BeginNextTab()?>
        <tr>
            <td width="50%" class="adm-detail-content-cell-l">
                <label for="painkiller_host"><?=GetMessage('PAINKILLER_HOST')?>:</label>
            </td>
            <td valign="top" width="50%">
                <input type="text"
                    id="painkiller_host"
                    name="painkiller_host"
                    value="<?=$siteHost?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <span class="smalltext">
                <?=GetMessage('PAINKILLER_HOST_COMMENT')?></span>
            </td>
        </tr>

        <?$tabControl->Buttons()?>
        <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>">
        <input type="submit" name="Apply" value="<?=GetMessage("MAIN_APPLY")?>">
        <?=bitrix_sessid_post()?>
    <?$tabControl->End();?>
</form>