<?php
namespace PHPMaker2019\MeuSistema;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$controle_combustiveis_view = new controle_combustiveis_view();

// Run the page
$controle_combustiveis_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$controle_combustiveis_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontrole_combustiveisview = currentForm = new ew.Form("fcontrole_combustiveisview", "view");

// Form_CustomValidate event
fcontrole_combustiveisview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontrole_combustiveisview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontrole_combustiveisview.lists["x_id_veiculo"] = <?php echo $controle_combustiveis_view->id_veiculo->Lookup->toClientList() ?>;
fcontrole_combustiveisview.lists["x_id_veiculo"].options = <?php echo JsonEncode($controle_combustiveis_view->id_veiculo->lookupOptions()) ?>;
fcontrole_combustiveisview.lists["x_id_conta"] = <?php echo $controle_combustiveis_view->id_conta->Lookup->toClientList() ?>;
fcontrole_combustiveisview.lists["x_id_conta"].options = <?php echo JsonEncode($controle_combustiveis_view->id_conta->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $controle_combustiveis_view->ExportOptions->render("body") ?>
<?php $controle_combustiveis_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $controle_combustiveis_view->showPageHeader(); ?>
<?php
$controle_combustiveis_view->showMessage();
?>
<form name="fcontrole_combustiveisview" id="fcontrole_combustiveisview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($controle_combustiveis_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $controle_combustiveis_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="controle_combustiveis">
<input type="hidden" name="modal" value="<?php echo (int)$controle_combustiveis_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($controle_combustiveis->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $controle_combustiveis_view->TableLeftColumnClass ?>"><span id="elh_controle_combustiveis_id"><?php echo $controle_combustiveis->id->caption() ?></span></td>
		<td data-name="id"<?php echo $controle_combustiveis->id->cellAttributes() ?>>
<span id="el_controle_combustiveis_id">
<span<?php echo $controle_combustiveis->id->viewAttributes() ?>>
<?php echo $controle_combustiveis->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($controle_combustiveis->id_veiculo->Visible) { // id_veiculo ?>
	<tr id="r_id_veiculo">
		<td class="<?php echo $controle_combustiveis_view->TableLeftColumnClass ?>"><span id="elh_controle_combustiveis_id_veiculo"><?php echo $controle_combustiveis->id_veiculo->caption() ?></span></td>
		<td data-name="id_veiculo"<?php echo $controle_combustiveis->id_veiculo->cellAttributes() ?>>
<span id="el_controle_combustiveis_id_veiculo">
<span<?php echo $controle_combustiveis->id_veiculo->viewAttributes() ?>>
<?php echo $controle_combustiveis->id_veiculo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($controle_combustiveis->data_abastecimento->Visible) { // data_abastecimento ?>
	<tr id="r_data_abastecimento">
		<td class="<?php echo $controle_combustiveis_view->TableLeftColumnClass ?>"><span id="elh_controle_combustiveis_data_abastecimento"><?php echo $controle_combustiveis->data_abastecimento->caption() ?></span></td>
		<td data-name="data_abastecimento"<?php echo $controle_combustiveis->data_abastecimento->cellAttributes() ?>>
<span id="el_controle_combustiveis_data_abastecimento">
<span<?php echo $controle_combustiveis->data_abastecimento->viewAttributes() ?>>
<?php echo $controle_combustiveis->data_abastecimento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($controle_combustiveis->id_conta->Visible) { // id_conta ?>
	<tr id="r_id_conta">
		<td class="<?php echo $controle_combustiveis_view->TableLeftColumnClass ?>"><span id="elh_controle_combustiveis_id_conta"><?php echo $controle_combustiveis->id_conta->caption() ?></span></td>
		<td data-name="id_conta"<?php echo $controle_combustiveis->id_conta->cellAttributes() ?>>
<span id="el_controle_combustiveis_id_conta">
<span<?php echo $controle_combustiveis->id_conta->viewAttributes() ?>>
<?php echo $controle_combustiveis->id_conta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($controle_combustiveis->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $controle_combustiveis_view->TableLeftColumnClass ?>"><span id="elh_controle_combustiveis_valor"><?php echo $controle_combustiveis->valor->caption() ?></span></td>
		<td data-name="valor"<?php echo $controle_combustiveis->valor->cellAttributes() ?>>
<span id="el_controle_combustiveis_valor">
<span<?php echo $controle_combustiveis->valor->viewAttributes() ?>>
<?php echo $controle_combustiveis->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$controle_combustiveis_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$controle_combustiveis_view->terminate();
?>