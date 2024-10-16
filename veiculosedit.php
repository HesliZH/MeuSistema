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
$veiculos_edit = new veiculos_edit();

// Run the page
$veiculos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$veiculos_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fveiculosedit = currentForm = new ew.Form("fveiculosedit", "edit");

// Validate form
fveiculosedit.validate = function() {
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
		<?php if ($veiculos_edit->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $veiculos->descricao->caption(), $veiculos->descricao->RequiredErrorMessage)) ?>");
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
fveiculosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fveiculosedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $veiculos_edit->showPageHeader(); ?>
<?php
$veiculos_edit->showMessage();
?>
<form name="fveiculosedit" id="fveiculosedit" class="<?php echo $veiculos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($veiculos_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $veiculos_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="veiculos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$veiculos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($veiculos->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_veiculos_descricao" for="x_descricao" class="<?php echo $veiculos_edit->LeftColumnClass ?>"><?php echo $veiculos->descricao->caption() ?><?php echo ($veiculos->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $veiculos_edit->RightColumnClass ?>"><div<?php echo $veiculos->descricao->cellAttributes() ?>>
<span id="el_veiculos_descricao">
<input type="text" data-table="veiculos" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($veiculos->descricao->getPlaceHolder()) ?>" value="<?php echo $veiculos->descricao->EditValue ?>"<?php echo $veiculos->descricao->editAttributes() ?>>
</span>
<?php echo $veiculos->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="veiculos" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($veiculos->id->CurrentValue) ?>">
<?php if (!$veiculos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $veiculos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $veiculos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$veiculos_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$veiculos_edit->terminate();
?>