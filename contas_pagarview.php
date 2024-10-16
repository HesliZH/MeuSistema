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
$contas_pagar_view = new contas_pagar_view();

// Run the page
$contas_pagar_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_pagar->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontas_pagarview = currentForm = new ew.Form("fcontas_pagarview", "view");

// Form_CustomValidate event
fcontas_pagarview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagarview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_pagarview.lists["x_id_conta"] = <?php echo $contas_pagar_view->id_conta->Lookup->toClientList() ?>;
fcontas_pagarview.lists["x_id_conta"].options = <?php echo JsonEncode($contas_pagar_view->id_conta->lookupOptions()) ?>;
fcontas_pagarview.lists["x_pago[]"] = <?php echo $contas_pagar_view->pago->Lookup->toClientList() ?>;
fcontas_pagarview.lists["x_pago[]"].options = <?php echo JsonEncode($contas_pagar_view->pago->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_pagar->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contas_pagar_view->ExportOptions->render("body") ?>
<?php $contas_pagar_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contas_pagar_view->showPageHeader(); ?>
<?php
$contas_pagar_view->showMessage();
?>
<form name="fcontas_pagarview" id="fcontas_pagarview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar">
<input type="hidden" name="modal" value="<?php echo (int)$contas_pagar_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contas_pagar->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $contas_pagar_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_id"><?php echo $contas_pagar->id->caption() ?></span></td>
		<td data-name="id"<?php echo $contas_pagar->id->cellAttributes() ?>>
<span id="el_contas_pagar_id">
<span<?php echo $contas_pagar->id->viewAttributes() ?>>
<?php echo $contas_pagar->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar->id_conta->Visible) { // id_conta ?>
	<tr id="r_id_conta">
		<td class="<?php echo $contas_pagar_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_id_conta"><?php echo $contas_pagar->id_conta->caption() ?></span></td>
		<td data-name="id_conta"<?php echo $contas_pagar->id_conta->cellAttributes() ?>>
<span id="el_contas_pagar_id_conta">
<span<?php echo $contas_pagar->id_conta->viewAttributes() ?>>
<?php echo $contas_pagar->id_conta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar->parcela->Visible) { // parcela ?>
	<tr id="r_parcela">
		<td class="<?php echo $contas_pagar_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_parcela"><?php echo $contas_pagar->parcela->caption() ?></span></td>
		<td data-name="parcela"<?php echo $contas_pagar->parcela->cellAttributes() ?>>
<span id="el_contas_pagar_parcela">
<span<?php echo $contas_pagar->parcela->viewAttributes() ?>>
<?php echo $contas_pagar->parcela->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar->data_vencimento->Visible) { // data_vencimento ?>
	<tr id="r_data_vencimento">
		<td class="<?php echo $contas_pagar_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_data_vencimento"><?php echo $contas_pagar->data_vencimento->caption() ?></span></td>
		<td data-name="data_vencimento"<?php echo $contas_pagar->data_vencimento->cellAttributes() ?>>
<span id="el_contas_pagar_data_vencimento">
<span<?php echo $contas_pagar->data_vencimento->viewAttributes() ?>>
<?php echo $contas_pagar->data_vencimento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $contas_pagar_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_valor"><?php echo $contas_pagar->valor->caption() ?></span></td>
		<td data-name="valor"<?php echo $contas_pagar->valor->cellAttributes() ?>>
<span id="el_contas_pagar_valor">
<span<?php echo $contas_pagar->valor->viewAttributes() ?>>
<?php echo $contas_pagar->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar->pago->Visible) { // pago ?>
	<tr id="r_pago">
		<td class="<?php echo $contas_pagar_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pago"><?php echo $contas_pagar->pago->caption() ?></span></td>
		<td data-name="pago"<?php echo $contas_pagar->pago->cellAttributes() ?>>
<span id="el_contas_pagar_pago">
<span<?php echo $contas_pagar->pago->viewAttributes() ?>>
<?php if (ConvertToBool($contas_pagar->pago->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas_pagar->pago->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas_pagar->pago->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$contas_pagar_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contas_pagar->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contas_pagar_view->terminate();
?>