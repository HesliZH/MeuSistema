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
$contas_pagar_delete = new contas_pagar_delete();

// Run the page
$contas_pagar_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontas_pagardelete = currentForm = new ew.Form("fcontas_pagardelete", "delete");

// Form_CustomValidate event
fcontas_pagardelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagardelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_pagardelete.lists["x_id_conta"] = <?php echo $contas_pagar_delete->id_conta->Lookup->toClientList() ?>;
fcontas_pagardelete.lists["x_id_conta"].options = <?php echo JsonEncode($contas_pagar_delete->id_conta->lookupOptions()) ?>;
fcontas_pagardelete.lists["x_pago[]"] = <?php echo $contas_pagar_delete->pago->Lookup->toClientList() ?>;
fcontas_pagardelete.lists["x_pago[]"].options = <?php echo JsonEncode($contas_pagar_delete->pago->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_pagar_delete->showPageHeader(); ?>
<?php
$contas_pagar_delete->showMessage();
?>
<form name="fcontas_pagardelete" id="fcontas_pagardelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contas_pagar_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contas_pagar->id->Visible) { // id ?>
		<th class="<?php echo $contas_pagar->id->headerCellClass() ?>"><span id="elh_contas_pagar_id" class="contas_pagar_id"><?php echo $contas_pagar->id->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar->id_conta->Visible) { // id_conta ?>
		<th class="<?php echo $contas_pagar->id_conta->headerCellClass() ?>"><span id="elh_contas_pagar_id_conta" class="contas_pagar_id_conta"><?php echo $contas_pagar->id_conta->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar->parcela->Visible) { // parcela ?>
		<th class="<?php echo $contas_pagar->parcela->headerCellClass() ?>"><span id="elh_contas_pagar_parcela" class="contas_pagar_parcela"><?php echo $contas_pagar->parcela->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar->data_vencimento->Visible) { // data_vencimento ?>
		<th class="<?php echo $contas_pagar->data_vencimento->headerCellClass() ?>"><span id="elh_contas_pagar_data_vencimento" class="contas_pagar_data_vencimento"><?php echo $contas_pagar->data_vencimento->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar->valor->Visible) { // valor ?>
		<th class="<?php echo $contas_pagar->valor->headerCellClass() ?>"><span id="elh_contas_pagar_valor" class="contas_pagar_valor"><?php echo $contas_pagar->valor->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar->pago->Visible) { // pago ?>
		<th class="<?php echo $contas_pagar->pago->headerCellClass() ?>"><span id="elh_contas_pagar_pago" class="contas_pagar_pago"><?php echo $contas_pagar->pago->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contas_pagar_delete->RecCnt = 0;
$i = 0;
while (!$contas_pagar_delete->Recordset->EOF) {
	$contas_pagar_delete->RecCnt++;
	$contas_pagar_delete->RowCnt++;

	// Set row properties
	$contas_pagar->resetAttributes();
	$contas_pagar->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contas_pagar_delete->loadRowValues($contas_pagar_delete->Recordset);

	// Render row
	$contas_pagar_delete->renderRow();
?>
	<tr<?php echo $contas_pagar->rowAttributes() ?>>
<?php if ($contas_pagar->id->Visible) { // id ?>
		<td<?php echo $contas_pagar->id->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_delete->RowCnt ?>_contas_pagar_id" class="contas_pagar_id">
<span<?php echo $contas_pagar->id->viewAttributes() ?>>
<?php echo $contas_pagar->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar->id_conta->Visible) { // id_conta ?>
		<td<?php echo $contas_pagar->id_conta->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_delete->RowCnt ?>_contas_pagar_id_conta" class="contas_pagar_id_conta">
<span<?php echo $contas_pagar->id_conta->viewAttributes() ?>>
<?php echo $contas_pagar->id_conta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar->parcela->Visible) { // parcela ?>
		<td<?php echo $contas_pagar->parcela->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_delete->RowCnt ?>_contas_pagar_parcela" class="contas_pagar_parcela">
<span<?php echo $contas_pagar->parcela->viewAttributes() ?>>
<?php echo $contas_pagar->parcela->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar->data_vencimento->Visible) { // data_vencimento ?>
		<td<?php echo $contas_pagar->data_vencimento->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_delete->RowCnt ?>_contas_pagar_data_vencimento" class="contas_pagar_data_vencimento">
<span<?php echo $contas_pagar->data_vencimento->viewAttributes() ?>>
<?php echo $contas_pagar->data_vencimento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar->valor->Visible) { // valor ?>
		<td<?php echo $contas_pagar->valor->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_delete->RowCnt ?>_contas_pagar_valor" class="contas_pagar_valor">
<span<?php echo $contas_pagar->valor->viewAttributes() ?>>
<?php echo $contas_pagar->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar->pago->Visible) { // pago ?>
		<td<?php echo $contas_pagar->pago->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_delete->RowCnt ?>_contas_pagar_pago" class="contas_pagar_pago">
<span<?php echo $contas_pagar->pago->viewAttributes() ?>>
<?php if (ConvertToBool($contas_pagar->pago->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas_pagar->pago->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas_pagar->pago->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contas_pagar_delete->Recordset->moveNext();
}
$contas_pagar_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_pagar_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contas_pagar_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_pagar_delete->terminate();
?>