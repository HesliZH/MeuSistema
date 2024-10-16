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
$controle_combustiveis_delete = new controle_combustiveis_delete();

// Run the page
$controle_combustiveis_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$controle_combustiveis_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontrole_combustiveisdelete = currentForm = new ew.Form("fcontrole_combustiveisdelete", "delete");

// Form_CustomValidate event
fcontrole_combustiveisdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontrole_combustiveisdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontrole_combustiveisdelete.lists["x_id_veiculo"] = <?php echo $controle_combustiveis_delete->id_veiculo->Lookup->toClientList() ?>;
fcontrole_combustiveisdelete.lists["x_id_veiculo"].options = <?php echo JsonEncode($controle_combustiveis_delete->id_veiculo->lookupOptions()) ?>;
fcontrole_combustiveisdelete.lists["x_id_conta"] = <?php echo $controle_combustiveis_delete->id_conta->Lookup->toClientList() ?>;
fcontrole_combustiveisdelete.lists["x_id_conta"].options = <?php echo JsonEncode($controle_combustiveis_delete->id_conta->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $controle_combustiveis_delete->showPageHeader(); ?>
<?php
$controle_combustiveis_delete->showMessage();
?>
<form name="fcontrole_combustiveisdelete" id="fcontrole_combustiveisdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($controle_combustiveis_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $controle_combustiveis_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="controle_combustiveis">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($controle_combustiveis_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($controle_combustiveis->id->Visible) { // id ?>
		<th class="<?php echo $controle_combustiveis->id->headerCellClass() ?>"><span id="elh_controle_combustiveis_id" class="controle_combustiveis_id"><?php echo $controle_combustiveis->id->caption() ?></span></th>
<?php } ?>
<?php if ($controle_combustiveis->id_veiculo->Visible) { // id_veiculo ?>
		<th class="<?php echo $controle_combustiveis->id_veiculo->headerCellClass() ?>"><span id="elh_controle_combustiveis_id_veiculo" class="controle_combustiveis_id_veiculo"><?php echo $controle_combustiveis->id_veiculo->caption() ?></span></th>
<?php } ?>
<?php if ($controle_combustiveis->data_abastecimento->Visible) { // data_abastecimento ?>
		<th class="<?php echo $controle_combustiveis->data_abastecimento->headerCellClass() ?>"><span id="elh_controle_combustiveis_data_abastecimento" class="controle_combustiveis_data_abastecimento"><?php echo $controle_combustiveis->data_abastecimento->caption() ?></span></th>
<?php } ?>
<?php if ($controle_combustiveis->id_conta->Visible) { // id_conta ?>
		<th class="<?php echo $controle_combustiveis->id_conta->headerCellClass() ?>"><span id="elh_controle_combustiveis_id_conta" class="controle_combustiveis_id_conta"><?php echo $controle_combustiveis->id_conta->caption() ?></span></th>
<?php } ?>
<?php if ($controle_combustiveis->valor->Visible) { // valor ?>
		<th class="<?php echo $controle_combustiveis->valor->headerCellClass() ?>"><span id="elh_controle_combustiveis_valor" class="controle_combustiveis_valor"><?php echo $controle_combustiveis->valor->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$controle_combustiveis_delete->RecCnt = 0;
$i = 0;
while (!$controle_combustiveis_delete->Recordset->EOF) {
	$controle_combustiveis_delete->RecCnt++;
	$controle_combustiveis_delete->RowCnt++;

	// Set row properties
	$controle_combustiveis->resetAttributes();
	$controle_combustiveis->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$controle_combustiveis_delete->loadRowValues($controle_combustiveis_delete->Recordset);

	// Render row
	$controle_combustiveis_delete->renderRow();
?>
	<tr<?php echo $controle_combustiveis->rowAttributes() ?>>
<?php if ($controle_combustiveis->id->Visible) { // id ?>
		<td<?php echo $controle_combustiveis->id->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_delete->RowCnt ?>_controle_combustiveis_id" class="controle_combustiveis_id">
<span<?php echo $controle_combustiveis->id->viewAttributes() ?>>
<?php echo $controle_combustiveis->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($controle_combustiveis->id_veiculo->Visible) { // id_veiculo ?>
		<td<?php echo $controle_combustiveis->id_veiculo->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_delete->RowCnt ?>_controle_combustiveis_id_veiculo" class="controle_combustiveis_id_veiculo">
<span<?php echo $controle_combustiveis->id_veiculo->viewAttributes() ?>>
<?php echo $controle_combustiveis->id_veiculo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($controle_combustiveis->data_abastecimento->Visible) { // data_abastecimento ?>
		<td<?php echo $controle_combustiveis->data_abastecimento->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_delete->RowCnt ?>_controle_combustiveis_data_abastecimento" class="controle_combustiveis_data_abastecimento">
<span<?php echo $controle_combustiveis->data_abastecimento->viewAttributes() ?>>
<?php echo $controle_combustiveis->data_abastecimento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($controle_combustiveis->id_conta->Visible) { // id_conta ?>
		<td<?php echo $controle_combustiveis->id_conta->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_delete->RowCnt ?>_controle_combustiveis_id_conta" class="controle_combustiveis_id_conta">
<span<?php echo $controle_combustiveis->id_conta->viewAttributes() ?>>
<?php echo $controle_combustiveis->id_conta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($controle_combustiveis->valor->Visible) { // valor ?>
		<td<?php echo $controle_combustiveis->valor->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_delete->RowCnt ?>_controle_combustiveis_valor" class="controle_combustiveis_valor">
<span<?php echo $controle_combustiveis->valor->viewAttributes() ?>>
<?php echo $controle_combustiveis->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$controle_combustiveis_delete->Recordset->moveNext();
}
$controle_combustiveis_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $controle_combustiveis_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$controle_combustiveis_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$controle_combustiveis_delete->terminate();
?>