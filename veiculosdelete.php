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
$veiculos_delete = new veiculos_delete();

// Run the page
$veiculos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$veiculos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fveiculosdelete = currentForm = new ew.Form("fveiculosdelete", "delete");

// Form_CustomValidate event
fveiculosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fveiculosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $veiculos_delete->showPageHeader(); ?>
<?php
$veiculos_delete->showMessage();
?>
<form name="fveiculosdelete" id="fveiculosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($veiculos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $veiculos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="veiculos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($veiculos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($veiculos->id->Visible) { // id ?>
		<th class="<?php echo $veiculos->id->headerCellClass() ?>"><span id="elh_veiculos_id" class="veiculos_id"><?php echo $veiculos->id->caption() ?></span></th>
<?php } ?>
<?php if ($veiculos->descricao->Visible) { // descricao ?>
		<th class="<?php echo $veiculos->descricao->headerCellClass() ?>"><span id="elh_veiculos_descricao" class="veiculos_descricao"><?php echo $veiculos->descricao->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$veiculos_delete->RecCnt = 0;
$i = 0;
while (!$veiculos_delete->Recordset->EOF) {
	$veiculos_delete->RecCnt++;
	$veiculos_delete->RowCnt++;

	// Set row properties
	$veiculos->resetAttributes();
	$veiculos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$veiculos_delete->loadRowValues($veiculos_delete->Recordset);

	// Render row
	$veiculos_delete->renderRow();
?>
	<tr<?php echo $veiculos->rowAttributes() ?>>
<?php if ($veiculos->id->Visible) { // id ?>
		<td<?php echo $veiculos->id->cellAttributes() ?>>
<span id="el<?php echo $veiculos_delete->RowCnt ?>_veiculos_id" class="veiculos_id">
<span<?php echo $veiculos->id->viewAttributes() ?>>
<?php echo $veiculos->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($veiculos->descricao->Visible) { // descricao ?>
		<td<?php echo $veiculos->descricao->cellAttributes() ?>>
<span id="el<?php echo $veiculos_delete->RowCnt ?>_veiculos_descricao" class="veiculos_descricao">
<span<?php echo $veiculos->descricao->viewAttributes() ?>>
<?php echo $veiculos->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$veiculos_delete->Recordset->moveNext();
}
$veiculos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $veiculos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$veiculos_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$veiculos_delete->terminate();
?>