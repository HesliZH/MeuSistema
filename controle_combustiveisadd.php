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
$controle_combustiveis_add = new controle_combustiveis_add();

// Run the page
$controle_combustiveis_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$controle_combustiveis_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcontrole_combustiveisadd = currentForm = new ew.Form("fcontrole_combustiveisadd", "add");

// Validate form
fcontrole_combustiveisadd.validate = function() {
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
		<?php if ($controle_combustiveis_add->id_veiculo->Required) { ?>
			elm = this.getElements("x" + infix + "_id_veiculo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $controle_combustiveis->id_veiculo->caption(), $controle_combustiveis->id_veiculo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($controle_combustiveis_add->data_abastecimento->Required) { ?>
			elm = this.getElements("x" + infix + "_data_abastecimento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $controle_combustiveis->data_abastecimento->caption(), $controle_combustiveis->data_abastecimento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_data_abastecimento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($controle_combustiveis->data_abastecimento->errorMessage()) ?>");
		<?php if ($controle_combustiveis_add->id_conta->Required) { ?>
			elm = this.getElements("x" + infix + "_id_conta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $controle_combustiveis->id_conta->caption(), $controle_combustiveis->id_conta->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($controle_combustiveis_add->valor->Required) { ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $controle_combustiveis->valor->caption(), $controle_combustiveis->valor->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($controle_combustiveis->valor->errorMessage()) ?>");

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
fcontrole_combustiveisadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontrole_combustiveisadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontrole_combustiveisadd.lists["x_id_veiculo"] = <?php echo $controle_combustiveis_add->id_veiculo->Lookup->toClientList() ?>;
fcontrole_combustiveisadd.lists["x_id_veiculo"].options = <?php echo JsonEncode($controle_combustiveis_add->id_veiculo->lookupOptions()) ?>;
fcontrole_combustiveisadd.lists["x_id_conta"] = <?php echo $controle_combustiveis_add->id_conta->Lookup->toClientList() ?>;
fcontrole_combustiveisadd.lists["x_id_conta"].options = <?php echo JsonEncode($controle_combustiveis_add->id_conta->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $controle_combustiveis_add->showPageHeader(); ?>
<?php
$controle_combustiveis_add->showMessage();
?>
<form name="fcontrole_combustiveisadd" id="fcontrole_combustiveisadd" class="<?php echo $controle_combustiveis_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($controle_combustiveis_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $controle_combustiveis_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="controle_combustiveis">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$controle_combustiveis_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($controle_combustiveis->id_veiculo->Visible) { // id_veiculo ?>
	<div id="r_id_veiculo" class="form-group row">
		<label id="elh_controle_combustiveis_id_veiculo" for="x_id_veiculo" class="<?php echo $controle_combustiveis_add->LeftColumnClass ?>"><?php echo $controle_combustiveis->id_veiculo->caption() ?><?php echo ($controle_combustiveis->id_veiculo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $controle_combustiveis_add->RightColumnClass ?>"><div<?php echo $controle_combustiveis->id_veiculo->cellAttributes() ?>>
<span id="el_controle_combustiveis_id_veiculo">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($controle_combustiveis->id_veiculo->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $controle_combustiveis->id_veiculo->ViewValue ?></button>
		<div id="dsl_x_id_veiculo" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $controle_combustiveis->id_veiculo->radioButtonListHtml(TRUE, "x_id_veiculo") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_id_veiculo" class="ew-template"><input type="radio" class="form-check-input" data-table="controle_combustiveis" data-field="x_id_veiculo" data-value-separator="<?php echo $controle_combustiveis->id_veiculo->displayValueSeparatorAttribute() ?>" name="x_id_veiculo" id="x_id_veiculo" value="{value}"<?php echo $controle_combustiveis->id_veiculo->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$controle_combustiveis->id_veiculo->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $controle_combustiveis->id_veiculo->Lookup->getParamTag("p_x_id_veiculo") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php echo $controle_combustiveis->id_veiculo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($controle_combustiveis->data_abastecimento->Visible) { // data_abastecimento ?>
	<div id="r_data_abastecimento" class="form-group row">
		<label id="elh_controle_combustiveis_data_abastecimento" for="x_data_abastecimento" class="<?php echo $controle_combustiveis_add->LeftColumnClass ?>"><?php echo $controle_combustiveis->data_abastecimento->caption() ?><?php echo ($controle_combustiveis->data_abastecimento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $controle_combustiveis_add->RightColumnClass ?>"><div<?php echo $controle_combustiveis->data_abastecimento->cellAttributes() ?>>
<span id="el_controle_combustiveis_data_abastecimento">
<input type="text" data-table="controle_combustiveis" data-field="x_data_abastecimento" name="x_data_abastecimento" id="x_data_abastecimento" placeholder="<?php echo HtmlEncode($controle_combustiveis->data_abastecimento->getPlaceHolder()) ?>" value="<?php echo $controle_combustiveis->data_abastecimento->EditValue ?>"<?php echo $controle_combustiveis->data_abastecimento->editAttributes() ?>>
</span>
<?php echo $controle_combustiveis->data_abastecimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($controle_combustiveis->id_conta->Visible) { // id_conta ?>
	<div id="r_id_conta" class="form-group row">
		<label id="elh_controle_combustiveis_id_conta" for="x_id_conta" class="<?php echo $controle_combustiveis_add->LeftColumnClass ?>"><?php echo $controle_combustiveis->id_conta->caption() ?><?php echo ($controle_combustiveis->id_conta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $controle_combustiveis_add->RightColumnClass ?>"><div<?php echo $controle_combustiveis->id_conta->cellAttributes() ?>>
<span id="el_controle_combustiveis_id_conta">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($controle_combustiveis->id_conta->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $controle_combustiveis->id_conta->ViewValue ?></button>
		<div id="dsl_x_id_conta" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $controle_combustiveis->id_conta->radioButtonListHtml(TRUE, "x_id_conta") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_id_conta" class="ew-template"><input type="radio" class="form-check-input" data-table="controle_combustiveis" data-field="x_id_conta" data-value-separator="<?php echo $controle_combustiveis->id_conta->displayValueSeparatorAttribute() ?>" name="x_id_conta" id="x_id_conta" value="{value}"<?php echo $controle_combustiveis->id_conta->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$controle_combustiveis->id_conta->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
<?php echo $controle_combustiveis->id_conta->Lookup->getParamTag("p_x_id_conta") ?>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php echo $controle_combustiveis->id_conta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($controle_combustiveis->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_controle_combustiveis_valor" for="x_valor" class="<?php echo $controle_combustiveis_add->LeftColumnClass ?>"><?php echo $controle_combustiveis->valor->caption() ?><?php echo ($controle_combustiveis->valor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $controle_combustiveis_add->RightColumnClass ?>"><div<?php echo $controle_combustiveis->valor->cellAttributes() ?>>
<span id="el_controle_combustiveis_valor">
<input type="text" data-table="controle_combustiveis" data-field="x_valor" name="x_valor" id="x_valor" size="30" placeholder="<?php echo HtmlEncode($controle_combustiveis->valor->getPlaceHolder()) ?>" value="<?php echo $controle_combustiveis->valor->EditValue ?>"<?php echo $controle_combustiveis->valor->editAttributes() ?>>
</span>
<?php echo $controle_combustiveis->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$controle_combustiveis_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $controle_combustiveis_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $controle_combustiveis_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$controle_combustiveis_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$controle_combustiveis_add->terminate();
?>