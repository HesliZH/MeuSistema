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
$veiculos_view = new veiculos_view();

// Run the page
$veiculos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$veiculos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$veiculos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fveiculosview = currentForm = new ew.Form("fveiculosview", "view");

// Form_CustomValidate event
fveiculosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fveiculosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$veiculos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $veiculos_view->ExportOptions->render("body") ?>
<?php $veiculos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $veiculos_view->showPageHeader(); ?>
<?php
$veiculos_view->showMessage();
?>
<form name="fveiculosview" id="fveiculosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($veiculos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $veiculos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="veiculos">
<input type="hidden" name="modal" value="<?php echo (int)$veiculos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($veiculos->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $veiculos_view->TableLeftColumnClass ?>"><span id="elh_veiculos_id"><?php echo $veiculos->id->caption() ?></span></td>
		<td data-name="id"<?php echo $veiculos->id->cellAttributes() ?>>
<span id="el_veiculos_id">
<span<?php echo $veiculos->id->viewAttributes() ?>>
<?php echo $veiculos->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($veiculos->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $veiculos_view->TableLeftColumnClass ?>"><span id="elh_veiculos_descricao"><?php echo $veiculos->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $veiculos->descricao->cellAttributes() ?>>
<span id="el_veiculos_descricao">
<span<?php echo $veiculos->descricao->viewAttributes() ?>>
<?php echo $veiculos->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$veiculos_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$veiculos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$veiculos_view->terminate();
?>