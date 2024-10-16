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
$contas_pagar_list = new contas_pagar_list();

// Run the page
$contas_pagar_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_pagar->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontas_pagarlist = currentForm = new ew.Form("fcontas_pagarlist", "list");
fcontas_pagarlist.formKeyCountName = '<?php echo $contas_pagar_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontas_pagarlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagarlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_pagarlist.lists["x_id_conta"] = <?php echo $contas_pagar_list->id_conta->Lookup->toClientList() ?>;
fcontas_pagarlist.lists["x_id_conta"].options = <?php echo JsonEncode($contas_pagar_list->id_conta->lookupOptions()) ?>;
fcontas_pagarlist.lists["x_pago[]"] = <?php echo $contas_pagar_list->pago->Lookup->toClientList() ?>;
fcontas_pagarlist.lists["x_pago[]"].options = <?php echo JsonEncode($contas_pagar_list->pago->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_pagar->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contas_pagar_list->TotalRecs > 0 && $contas_pagar_list->ExportOptions->visible()) { ?>
<?php $contas_pagar_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_pagar_list->ImportOptions->visible()) { ?>
<?php $contas_pagar_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contas_pagar_list->renderOtherOptions();
?>
<?php $contas_pagar_list->showPageHeader(); ?>
<?php
$contas_pagar_list->showMessage();
?>
<?php if ($contas_pagar_list->TotalRecs > 0 || $contas_pagar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contas_pagar_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contas_pagar">
<form name="fcontas_pagarlist" id="fcontas_pagarlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar">
<div id="gmp_contas_pagar" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($contas_pagar_list->TotalRecs > 0 || $contas_pagar->isGridEdit()) { ?>
<table id="tbl_contas_pagarlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contas_pagar_list->RowType = ROWTYPE_HEADER;

// Render list options
$contas_pagar_list->renderListOptions();

// Render list options (header, left)
$contas_pagar_list->ListOptions->render("header", "left");
?>
<?php if ($contas_pagar->id->Visible) { // id ?>
	<?php if ($contas_pagar->sortUrl($contas_pagar->id) == "") { ?>
		<th data-name="id" class="<?php echo $contas_pagar->id->headerCellClass() ?>"><div id="elh_contas_pagar_id" class="contas_pagar_id"><div class="ew-table-header-caption"><?php echo $contas_pagar->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $contas_pagar->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar->SortUrl($contas_pagar->id) ?>',1);"><div id="elh_contas_pagar_id" class="contas_pagar_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar->id_conta->Visible) { // id_conta ?>
	<?php if ($contas_pagar->sortUrl($contas_pagar->id_conta) == "") { ?>
		<th data-name="id_conta" class="<?php echo $contas_pagar->id_conta->headerCellClass() ?>"><div id="elh_contas_pagar_id_conta" class="contas_pagar_id_conta"><div class="ew-table-header-caption"><?php echo $contas_pagar->id_conta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_conta" class="<?php echo $contas_pagar->id_conta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar->SortUrl($contas_pagar->id_conta) ?>',1);"><div id="elh_contas_pagar_id_conta" class="contas_pagar_id_conta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar->id_conta->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar->id_conta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar->id_conta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar->parcela->Visible) { // parcela ?>
	<?php if ($contas_pagar->sortUrl($contas_pagar->parcela) == "") { ?>
		<th data-name="parcela" class="<?php echo $contas_pagar->parcela->headerCellClass() ?>"><div id="elh_contas_pagar_parcela" class="contas_pagar_parcela"><div class="ew-table-header-caption"><?php echo $contas_pagar->parcela->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="parcela" class="<?php echo $contas_pagar->parcela->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar->SortUrl($contas_pagar->parcela) ?>',1);"><div id="elh_contas_pagar_parcela" class="contas_pagar_parcela">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar->parcela->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar->parcela->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar->parcela->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar->data_vencimento->Visible) { // data_vencimento ?>
	<?php if ($contas_pagar->sortUrl($contas_pagar->data_vencimento) == "") { ?>
		<th data-name="data_vencimento" class="<?php echo $contas_pagar->data_vencimento->headerCellClass() ?>"><div id="elh_contas_pagar_data_vencimento" class="contas_pagar_data_vencimento"><div class="ew-table-header-caption"><?php echo $contas_pagar->data_vencimento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_vencimento" class="<?php echo $contas_pagar->data_vencimento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar->SortUrl($contas_pagar->data_vencimento) ?>',1);"><div id="elh_contas_pagar_data_vencimento" class="contas_pagar_data_vencimento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar->data_vencimento->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar->data_vencimento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar->data_vencimento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar->valor->Visible) { // valor ?>
	<?php if ($contas_pagar->sortUrl($contas_pagar->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $contas_pagar->valor->headerCellClass() ?>"><div id="elh_contas_pagar_valor" class="contas_pagar_valor"><div class="ew-table-header-caption"><?php echo $contas_pagar->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $contas_pagar->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar->SortUrl($contas_pagar->valor) ?>',1);"><div id="elh_contas_pagar_valor" class="contas_pagar_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar->valor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar->valor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar->pago->Visible) { // pago ?>
	<?php if ($contas_pagar->sortUrl($contas_pagar->pago) == "") { ?>
		<th data-name="pago" class="<?php echo $contas_pagar->pago->headerCellClass() ?>"><div id="elh_contas_pagar_pago" class="contas_pagar_pago"><div class="ew-table-header-caption"><?php echo $contas_pagar->pago->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pago" class="<?php echo $contas_pagar->pago->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar->SortUrl($contas_pagar->pago) ?>',1);"><div id="elh_contas_pagar_pago" class="contas_pagar_pago">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar->pago->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar->pago->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar->pago->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contas_pagar_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contas_pagar->ExportAll && $contas_pagar->isExport()) {
	$contas_pagar_list->StopRec = $contas_pagar_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contas_pagar_list->TotalRecs > $contas_pagar_list->StartRec + $contas_pagar_list->DisplayRecs - 1)
		$contas_pagar_list->StopRec = $contas_pagar_list->StartRec + $contas_pagar_list->DisplayRecs - 1;
	else
		$contas_pagar_list->StopRec = $contas_pagar_list->TotalRecs;
}
$contas_pagar_list->RecCnt = $contas_pagar_list->StartRec - 1;
if ($contas_pagar_list->Recordset && !$contas_pagar_list->Recordset->EOF) {
	$contas_pagar_list->Recordset->moveFirst();
	$selectLimit = $contas_pagar_list->UseSelectLimit;
	if (!$selectLimit && $contas_pagar_list->StartRec > 1)
		$contas_pagar_list->Recordset->move($contas_pagar_list->StartRec - 1);
} elseif (!$contas_pagar->AllowAddDeleteRow && $contas_pagar_list->StopRec == 0) {
	$contas_pagar_list->StopRec = $contas_pagar->GridAddRowCount;
}

// Initialize aggregate
$contas_pagar->RowType = ROWTYPE_AGGREGATEINIT;
$contas_pagar->resetAttributes();
$contas_pagar_list->renderRow();
while ($contas_pagar_list->RecCnt < $contas_pagar_list->StopRec) {
	$contas_pagar_list->RecCnt++;
	if ($contas_pagar_list->RecCnt >= $contas_pagar_list->StartRec) {
		$contas_pagar_list->RowCnt++;

		// Set up key count
		$contas_pagar_list->KeyCount = $contas_pagar_list->RowIndex;

		// Init row class and style
		$contas_pagar->resetAttributes();
		$contas_pagar->CssClass = "";
		if ($contas_pagar->isGridAdd()) {
		} else {
			$contas_pagar_list->loadRowValues($contas_pagar_list->Recordset); // Load row values
		}
		$contas_pagar->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contas_pagar->RowAttrs = array_merge($contas_pagar->RowAttrs, array('data-rowindex'=>$contas_pagar_list->RowCnt, 'id'=>'r' . $contas_pagar_list->RowCnt . '_contas_pagar', 'data-rowtype'=>$contas_pagar->RowType));

		// Render row
		$contas_pagar_list->renderRow();

		// Render list options
		$contas_pagar_list->renderListOptions();
?>
	<tr<?php echo $contas_pagar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contas_pagar_list->ListOptions->render("body", "left", $contas_pagar_list->RowCnt);
?>
	<?php if ($contas_pagar->id->Visible) { // id ?>
		<td data-name="id"<?php echo $contas_pagar->id->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_list->RowCnt ?>_contas_pagar_id" class="contas_pagar_id">
<span<?php echo $contas_pagar->id->viewAttributes() ?>>
<?php echo $contas_pagar->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar->id_conta->Visible) { // id_conta ?>
		<td data-name="id_conta"<?php echo $contas_pagar->id_conta->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_list->RowCnt ?>_contas_pagar_id_conta" class="contas_pagar_id_conta">
<span<?php echo $contas_pagar->id_conta->viewAttributes() ?>>
<?php echo $contas_pagar->id_conta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar->parcela->Visible) { // parcela ?>
		<td data-name="parcela"<?php echo $contas_pagar->parcela->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_list->RowCnt ?>_contas_pagar_parcela" class="contas_pagar_parcela">
<span<?php echo $contas_pagar->parcela->viewAttributes() ?>>
<?php echo $contas_pagar->parcela->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar->data_vencimento->Visible) { // data_vencimento ?>
		<td data-name="data_vencimento"<?php echo $contas_pagar->data_vencimento->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_list->RowCnt ?>_contas_pagar_data_vencimento" class="contas_pagar_data_vencimento">
<span<?php echo $contas_pagar->data_vencimento->viewAttributes() ?>>
<?php echo $contas_pagar->data_vencimento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar->valor->Visible) { // valor ?>
		<td data-name="valor"<?php echo $contas_pagar->valor->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_list->RowCnt ?>_contas_pagar_valor" class="contas_pagar_valor">
<span<?php echo $contas_pagar->valor->viewAttributes() ?>>
<?php echo $contas_pagar->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar->pago->Visible) { // pago ?>
		<td data-name="pago"<?php echo $contas_pagar->pago->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_list->RowCnt ?>_contas_pagar_pago" class="contas_pagar_pago">
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
<?php

// Render list options (body, right)
$contas_pagar_list->ListOptions->render("body", "right", $contas_pagar_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$contas_pagar->isGridAdd())
		$contas_pagar_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$contas_pagar->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contas_pagar_list->Recordset)
	$contas_pagar_list->Recordset->Close();
?>
<?php if (!$contas_pagar->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contas_pagar->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contas_pagar_list->Pager)) $contas_pagar_list->Pager = new PrevNextPager($contas_pagar_list->StartRec, $contas_pagar_list->DisplayRecs, $contas_pagar_list->TotalRecs, $contas_pagar_list->AutoHidePager) ?>
<?php if ($contas_pagar_list->Pager->RecordCount > 0 && $contas_pagar_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contas_pagar_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contas_pagar_list->pageUrl() ?>start=<?php echo $contas_pagar_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contas_pagar_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contas_pagar_list->pageUrl() ?>start=<?php echo $contas_pagar_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contas_pagar_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contas_pagar_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contas_pagar_list->pageUrl() ?>start=<?php echo $contas_pagar_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contas_pagar_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contas_pagar_list->pageUrl() ?>start=<?php echo $contas_pagar_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contas_pagar_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contas_pagar_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contas_pagar_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contas_pagar_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contas_pagar_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contas_pagar_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contas_pagar_list->TotalRecs == 0 && !$contas_pagar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contas_pagar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contas_pagar_list->showPageFooter();
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
$contas_pagar_list->terminate();
?>