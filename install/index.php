<?
class thelikers_painkiller extends CModule
{
    public $MODULE_ID = 'thelikers.painkiller';
    public $MODULE_NAME;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    function thelikers_painkiller(){
        include dirname( __FILE__ ) . '/version.php';
        IncludeModuleLangFile(__FILE__);

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage('PAINKILLER_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('PAINKILLER_DESCRIPTION');
        $this->PARTNER_NAME = GetMessage('PAINKILLER_PARTNER_NAME');
        $this->PARTNER_URI = "http://1c-bitrix.ru/partners/310515.php";
    }

    private function _InstallFiles(){
        global $DOCUMENT_ROOT;
        file_put_contents( dirname( __FILE__ ) . '/../site_host', $_SERVER['HTTP_HOST'] );
        copy(
            dirname( __FILE__ ) . '/painkiller_component_signature.php',
            $DOCUMENT_ROOT . '/bitrix/tools/painkiller_component_signature.php'
        );
        return true;
    }

    private function _UnInstallFiles(){
        global $DOCUMENT_ROOT;
        unlink( dirname( __FILE__ ) . '/../site_host' );
        unlink( $DOCUMENT_ROOT . '/bitrix/tools/painkiller_component_signature.php' );
        return true;
    }

    public function DoInstall(){
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->_InstallFiles();
        RegisterModule( $this->MODULE_ID );
        $APPLICATION->IncludeAdminFile(
            GetMessage('PAINKILLER_INSTALL'),
            $DOCUMENT_ROOT . '/bitrix/modules/' . $this->MODULE_ID . '/install/step.php'
        );
    }

    public function DoUninstall(){
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->_UnInstallFiles();
        UnRegisterModule( $this->MODULE_ID );
        $APPLICATION->IncludeAdminFile(
            GetMessage('PAINKILLER_UNINSTALL'),
            $DOCUMENT_ROOT . '/bitrix/modules/' . $this->MODULE_ID .'/install/unstep.php'
        );
    }
}