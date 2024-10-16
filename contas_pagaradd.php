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
$contas_pagar_add = new contas_pagar_add();

// Run the page
$contas_pagar_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcontas_pagaradd = currentForm = new ew.Form("fcontas_pagaradd", "add");

// Validate form
fcontas_pagaradd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($contas_pagar_add->id_conta->Required) { ?>
			elm = this.getElements("x" + infix + "_id_conta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar->id_conta->caption(), $contas_pagar->id_conta->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contas_pagar_add->parcela->Required) { ?>
			elm = this.getElements("x" + infix + "_parcela");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar->parcela->caption(), $contas_pagar->parcela->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_parcela");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar->parcela->errorMessage()) ?>");
		<?php if ($contas_pagar_add->data_vencimento->Required) { ?>
			elm = this.getElements("x" + infix + "_data_vencimento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar->data_vencimento->caption(), $contas_pagar->data_vencimento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_data_vencimento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar->data_vencimento->errorMessage()) ?>");
		<?php if ($contas_pagar_add->valor->Required) { ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar->valor->caption(), $contas_pagar->valor->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar->valor->errorMessage()) ?>");
		<?php if ($contas_pagar_add->pago->Required) { ?>
			elm = this.getElements("x" + infix + "_pago[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar->pago->caption(), $contas_pagar->pago->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcontas_pagaradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagaradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_pagaradd.lists["x_id_conta"] = <?php echo $contas_pagar_add->id_conta->Lookup->toClientList() ?>;
fcontas_pagaradd.lists["x_id_conta"].options = <?php echo JsonEncode($contas_pagar_add->id_conta->lookupOptions()) ?>;
fcontas_pagaradd.lists["x_pago[]"] = <?php echo $contas_pagar_add->pago->Lookup->toClientList() ?>;
fcontas_pagaradd.lists["x_pago[]"].options = <?php echo JsonEncode($contas_pagar_add->pago->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_pagar_add->showPageHeader(); ?>
<?php
$contas_pagar_add->showMessage();
?>
<form name="fcontas_pagaradd" id="fcontas_pagaradd" class="<?php echo $contas_pagar_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contas_pagar_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contas_pagar->id_conta->Visible) { // id_conta ?>
	<div id="r_id_conta" class="form-group row">
		<label id="elh_contas_pagar_id_conta" for="x_id_conta" class="<?php echo $contas_pagar_add->LeftColumnClass ?>"><?php echo $contas_pagar->id_conta->caption() ?><?php echo ($contas_pagar->id_conta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_add->RightColumnClass ?>"><div<?php echo $contas_pagar->id_conta->cellAttributes() ?>>
<span id="el_contas_pagar_id_conta">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($contas_pagar->id_conta->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $contas_pagar->id_conta->ViewValue ?></button>
		<div id="dsl_x_id_conta" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $contas_pagar->id_conta->radioButtonListHtml(TRUE, "x_id_conta") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_id_conta" class="ew-template"><input type="radio" class="form-check-input" data-table="contas_pagar" data-field="x_id_conta" data-value-separator="<?php echo $contas_pagar->id_conta->displayValueSeparatorAttribute() ?>" name="x_id_conta" id="x_id_conta" value="{value}"<?php echo $contas_pagar->id_conta->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$contas_pagar->id_conta->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $contas_pagar->id_conta->Lookup->getParamTag("p_x_id_conta") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php echo $contas_pagar->id_conta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar->parcela->Visible) { // parcela ?>
	<div id="r_parcela" class="form-group row">
		<label id="elh_contas_pagar_parcela" for="x_parcela" class="<?php echo $contas_pagar_add->LeftColumnClass ?>"><?php echo $contas_pagar->parcela->caption() ?><?php echo ($contas_pagar->parcela->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_add->RightColumnClass ?>"><div<?php echo $contas_pagar->parcela->cellAttributes() ?>>
<span id="el_contas_pagar_parcela">
<input type="text" data-table="contas_pagar" data-field="x_parcela" name="x_parcela" id="x_parcela" size="30" placeholder="<?php echo HtmlEncode($contas_pagar->parcela->getPlaceHolder()) ?>" value="<?php echo $contas_pagar->parcela->EditValue ?>"<?php echo $contas_pagar->parcela->editAttributes() ?>>
</span>
<?php echo $contas_pagar->parcela->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar->data_vencimento->Visible) { // data_vencimento ?>
	<div id="r_data_vencimento" class="form-group row">
		<label id="elh_contas_pagar_data_vencimento" for="x_data_vencimento" class="<?php echo $contas_pagar_add->LeftColumnClass ?>"><?php echo $contas_pagar->data_vencimento->caption() ?><?php echo ($contas_pagar->data_vencimento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_add->RightColumnClass ?>"><div<?php echo $contas_pagar->data_vencimento->cellAttributes() ?>>
<span id="el_contas_pagar_data_vencimento">
<input type="text" data-table="contas_pagar" data-field="x_data_vencimento" name="x_data_vencimento" id="x_data_vencimento" placeholder="<?php echo HtmlEncode($contas_pagar->data_vencimento->getPlaceHolder()) ?>" value="<?php echo $contas_pagar->data_vencimento->EditValue ?>"<?php echo $contas_pagar->data_vencimento->editAttributes() ?>>
</span>
<?php echo $contas_pagar->data_vencimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_contas_pagar_valor" for="x_valor" class="<?php echo $contas_pagar_add->LeftColumnClass ?>"><?php echo $contas_pagar->valor->caption() ?><?php echo ($contas_pagar->valor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_add->RightColumnClass ?>"><div<?php echo $contas_pagar->valor->cellAttributes() ?>>
<span id="el_contas_pagar_valor">
<input type="text" data-table="contas_pagar" data-field="x_valor" name="x_valor" id="x_valor" size="30" placeholder="<?php echo HtmlEncode($contas_pagar->valor->getPlaceHolder()) ?>" value="<?php echo $contas_pagar->valor->EditValue ?>"<?php echo $contas_pagar->valor->editAttributes() ?>>
</span>
<?php echo $contas_pagar->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar->pago->Visible) { // pago ?>
	<div id="r_pago" class="form-group row">
		<label id="elh_contas_pagar_pago" class="<?php echo $contas_pagar_add->LeftColumnClass ?>"><?php echo $contas_pagar->pago->caption() ?><?php echo ($contas_pagar->pago->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_add->RightColumnClass ?>"><div<?php echo $contas_pagar->pago->cellAttributes() ?>>
<span id="el_contas_pagar_pago">
<?php
$selwrk = (ConvertToBool($contas_pagar->pago->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="contas_pagar" data-field="x_pago" name="x_pago[]" id="x_pago[]" value="1"<?php echo $selwrk ?><?php echo $contas_pagar->pago->editAttributes() ?>>
</span>
<?php echo $contas_pagar->pago->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contas_pagar_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contas_pagar_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_pagar_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contas_pagar_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_pagar_add->terminate();
?>