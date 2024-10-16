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
$contas_view = new contas_view();

// Run the page
$contas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontasview = currentForm = new ew.Form("fcontasview", "view");

// Form_CustomValidate event
fcontasview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontasview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontasview.lists["x_inativo[]"] = <?php echo $contas_view->inativo->Lookup->toClientList() ?>;
fcontasview.lists["x_inativo[]"].options = <?php echo JsonEncode($contas_view->inativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contas_view->ExportOptions->render("body") ?>
<?php $contas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contas_view->showPageHeader(); ?>
<?php
$contas_view->showMessage();
?>
<form name="fcontasview" id="fcontasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas">
<input type="hidden" name="modal" value="<?php echo (int)$contas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contas->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $contas_view->TableLeftColumnClass ?>"><span id="elh_contas_id"><?php echo $contas->id->caption() ?></span></td>
		<td data-name="id"<?php echo $contas->id->cellAttributes() ?>>
<span id="el_contas_id">
<span<?php echo $contas->id->viewAttributes() ?>>
<?php echo $contas->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $contas_view->TableLeftColumnClass ?>"><span id="elh_contas_descricao"><?php echo $contas->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $contas->descricao->cellAttributes() ?>>
<span id="el_contas_descricao">
<span<?php echo $contas->descricao->viewAttributes() ?>>
<?php echo $contas->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas->inativo->Visible) { // inativo ?>
	<tr id="r_inativo">
		<td class="<?php echo $contas_view->TableLeftColumnClass ?>"><span id="elh_contas_inativo"><?php echo $contas->inativo->caption() ?></span></td>
		<td data-name="inativo"<?php echo $contas->inativo->cellAttributes() ?>>
<span id="el_contas_inativo">
<span<?php echo $contas->inativo->viewAttributes() ?>>
<?php if (ConvertToBool($contas->inativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas->inativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas->inativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$contas_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contas->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contas_view->terminate();
?>