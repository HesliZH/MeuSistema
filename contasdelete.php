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
$contas_delete = new contas_delete();

// Run the page
$contas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontasdelete = currentForm = new ew.Form("fcontasdelete", "delete");

// Form_CustomValidate event
fcontasdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontasdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontasdelete.lists["x_inativo[]"] = <?php echo $contas_delete->inativo->Lookup->toClientList() ?>;
fcontasdelete.lists["x_inativo[]"].options = <?php echo JsonEncode($contas_delete->inativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_delete->showPageHeader(); ?>
<?php
$contas_delete->showMessage();
?>
<form name="fcontasdelete" id="fcontasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contas->id->Visible) { // id ?>
		<th class="<?php echo $contas->id->headerCellClass() ?>"><span id="elh_contas_id" class="contas_id"><?php echo $contas->id->caption() ?></span></th>
<?php } ?>
<?php if ($contas->descricao->Visible) { // descricao ?>
		<th class="<?php echo $contas->descricao->headerCellClass() ?>"><span id="elh_contas_descricao" class="contas_descricao"><?php echo $contas->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($contas->inativo->Visible) { // inativo ?>
		<th class="<?php echo $contas->inativo->headerCellClass() ?>"><span id="elh_contas_inativo" class="contas_inativo"><?php echo $contas->inativo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contas_delete->RecCnt = 0;
$i = 0;
while (!$contas_delete->Recordset->EOF) {
	$contas_delete->RecCnt++;
	$contas_delete->RowCnt++;

	// Set row properties
	$contas->resetAttributes();
	$contas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contas_delete->loadRowValues($contas_delete->Recordset);

	// Render row
	$contas_delete->renderRow();
?>
	<tr<?php echo $contas->rowAttributes() ?>>
<?php if ($contas->id->Visible) { // id ?>
		<td<?php echo $contas->id->cellAttributes() ?>>
<span id="el<?php echo $contas_delete->RowCnt ?>_contas_id" class="contas_id">
<span<?php echo $contas->id->viewAttributes() ?>>
<?php echo $contas->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas->descricao->Visible) { // descricao ?>
		<td<?php echo $contas->descricao->cellAttributes() ?>>
<span id="el<?php echo $contas_delete->RowCnt ?>_contas_descricao" class="contas_descricao">
<span<?php echo $contas->descricao->viewAttributes() ?>>
<?php echo $contas->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas->inativo->Visible) { // inativo ?>
		<td<?php echo $contas->inativo->cellAttributes() ?>>
<span id="el<?php echo $contas_delete->RowCnt ?>_contas_inativo" class="contas_inativo">
<span<?php echo $contas->inativo->viewAttributes() ?>>
<?php if (ConvertToBool($contas->inativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas->inativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas->inativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contas_delete->Recordset->moveNext();
}
$contas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contas_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_delete->terminate();
?>