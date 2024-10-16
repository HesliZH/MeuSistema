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
$controle_combustiveis_list = new controle_combustiveis_list();

// Run the page
$controle_combustiveis_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$controle_combustiveis_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontrole_combustiveislist = currentForm = new ew.Form("fcontrole_combustiveislist", "list");
fcontrole_combustiveislist.formKeyCountName = '<?php echo $controle_combustiveis_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontrole_combustiveislist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontrole_combustiveislist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontrole_combustiveislist.lists["x_id_veiculo"] = <?php echo $controle_combustiveis_list->id_veiculo->Lookup->toClientList() ?>;
fcontrole_combustiveislist.lists["x_id_veiculo"].options = <?php echo JsonEncode($controle_combustiveis_list->id_veiculo->lookupOptions()) ?>;
fcontrole_combustiveislist.lists["x_id_conta"] = <?php echo $controle_combustiveis_list->id_conta->Lookup->toClientList() ?>;
fcontrole_combustiveislist.lists["x_id_conta"].options = <?php echo JsonEncode($controle_combustiveis_list->id_conta->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($controle_combustiveis_list->TotalRecs > 0 && $controle_combustiveis_list->ExportOptions->visible()) { ?>
<?php $controle_combustiveis_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($controle_combustiveis_list->ImportOptions->visible()) { ?>
<?php $controle_combustiveis_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$controle_combustiveis_list->renderOtherOptions();
?>
<?php $controle_combustiveis_list->showPageHeader(); ?>
<?php
$controle_combustiveis_list->showMessage();
?>
<?php if ($controle_combustiveis_list->TotalRecs > 0 || $controle_combustiveis->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($controle_combustiveis_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> controle_combustiveis">
<form name="fcontrole_combustiveislist" id="fcontrole_combustiveislist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($controle_combustiveis_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $controle_combustiveis_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="controle_combustiveis">
<div id="gmp_controle_combustiveis" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($controle_combustiveis_list->TotalRecs > 0 || $controle_combustiveis->isGridEdit()) { ?>
<table id="tbl_controle_combustiveislist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$controle_combustiveis_list->RowType = ROWTYPE_HEADER;

// Render list options
$controle_combustiveis_list->renderListOptions();

// Render list options (header, left)
$controle_combustiveis_list->ListOptions->render("header", "left");
?>
<?php if ($controle_combustiveis->id->Visible) { // id ?>
	<?php if ($controle_combustiveis->sortUrl($controle_combustiveis->id) == "") { ?>
		<th data-name="id" class="<?php echo $controle_combustiveis->id->headerCellClass() ?>"><div id="elh_controle_combustiveis_id" class="controle_combustiveis_id"><div class="ew-table-header-caption"><?php echo $controle_combustiveis->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $controle_combustiveis->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $controle_combustiveis->SortUrl($controle_combustiveis->id) ?>',1);"><div id="elh_controle_combustiveis_id" class="controle_combustiveis_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $controle_combustiveis->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($controle_combustiveis->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($controle_combustiveis->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($controle_combustiveis->id_veiculo->Visible) { // id_veiculo ?>
	<?php if ($controle_combustiveis->sortUrl($controle_combustiveis->id_veiculo) == "") { ?>
		<th data-name="id_veiculo" class="<?php echo $controle_combustiveis->id_veiculo->headerCellClass() ?>"><div id="elh_controle_combustiveis_id_veiculo" class="controle_combustiveis_id_veiculo"><div class="ew-table-header-caption"><?php echo $controle_combustiveis->id_veiculo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_veiculo" class="<?php echo $controle_combustiveis->id_veiculo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $controle_combustiveis->SortUrl($controle_combustiveis->id_veiculo) ?>',1);"><div id="elh_controle_combustiveis_id_veiculo" class="controle_combustiveis_id_veiculo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $controle_combustiveis->id_veiculo->caption() ?></span><span class="ew-table-header-sort"><?php if ($controle_combustiveis->id_veiculo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($controle_combustiveis->id_veiculo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($controle_combustiveis->data_abastecimento->Visible) { // data_abastecimento ?>
	<?php if ($controle_combustiveis->sortUrl($controle_combustiveis->data_abastecimento) == "") { ?>
		<th data-name="data_abastecimento" class="<?php echo $controle_combustiveis->data_abastecimento->headerCellClass() ?>"><div id="elh_controle_combustiveis_data_abastecimento" class="controle_combustiveis_data_abastecimento"><div class="ew-table-header-caption"><?php echo $controle_combustiveis->data_abastecimento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_abastecimento" class="<?php echo $controle_combustiveis->data_abastecimento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $controle_combustiveis->SortUrl($controle_combustiveis->data_abastecimento) ?>',1);"><div id="elh_controle_combustiveis_data_abastecimento" class="controle_combustiveis_data_abastecimento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $controle_combustiveis->data_abastecimento->caption() ?></span><span class="ew-table-header-sort"><?php if ($controle_combustiveis->data_abastecimento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($controle_combustiveis->data_abastecimento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($controle_combustiveis->id_conta->Visible) { // id_conta ?>
	<?php if ($controle_combustiveis->sortUrl($controle_combustiveis->id_conta) == "") { ?>
		<th data-name="id_conta" class="<?php echo $controle_combustiveis->id_conta->headerCellClass() ?>"><div id="elh_controle_combustiveis_id_conta" class="controle_combustiveis_id_conta"><div class="ew-table-header-caption"><?php echo $controle_combustiveis->id_conta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_conta" class="<?php echo $controle_combustiveis->id_conta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $controle_combustiveis->SortUrl($controle_combustiveis->id_conta) ?>',1);"><div id="elh_controle_combustiveis_id_conta" class="controle_combustiveis_id_conta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $controle_combustiveis->id_conta->caption() ?></span><span class="ew-table-header-sort"><?php if ($controle_combustiveis->id_conta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($controle_combustiveis->id_conta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($controle_combustiveis->valor->Visible) { // valor ?>
	<?php if ($controle_combustiveis->sortUrl($controle_combustiveis->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $controle_combustiveis->valor->headerCellClass() ?>"><div id="elh_controle_combustiveis_valor" class="controle_combustiveis_valor"><div class="ew-table-header-caption"><?php echo $controle_combustiveis->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $controle_combustiveis->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $controle_combustiveis->SortUrl($controle_combustiveis->valor) ?>',1);"><div id="elh_controle_combustiveis_valor" class="controle_combustiveis_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $controle_combustiveis->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($controle_combustiveis->valor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($controle_combustiveis->valor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$controle_combustiveis_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($controle_combustiveis->ExportAll && $controle_combustiveis->isExport()) {
	$controle_combustiveis_list->StopRec = $controle_combustiveis_list->TotalRecs;
} else {

	// Set the last record to display
	if ($controle_combustiveis_list->TotalRecs > $controle_combustiveis_list->StartRec + $controle_combustiveis_list->DisplayRecs - 1)
		$controle_combustiveis_list->StopRec = $controle_combustiveis_list->StartRec + $controle_combustiveis_list->DisplayRecs - 1;
	else
		$controle_combustiveis_list->StopRec = $controle_combustiveis_list->TotalRecs;
}
$controle_combustiveis_list->RecCnt = $controle_combustiveis_list->StartRec - 1;
if ($controle_combustiveis_list->Recordset && !$controle_combustiveis_list->Recordset->EOF) {
	$controle_combustiveis_list->Recordset->moveFirst();
	$selectLimit = $controle_combustiveis_list->UseSelectLimit;
	if (!$selectLimit && $controle_combustiveis_list->StartRec > 1)
		$controle_combustiveis_list->Recordset->move($controle_combustiveis_list->StartRec - 1);
} elseif (!$controle_combustiveis->AllowAddDeleteRow && $controle_combustiveis_list->StopRec == 0) {
	$controle_combustiveis_list->StopRec = $controle_combustiveis->GridAddRowCount;
}

// Initialize aggregate
$controle_combustiveis->RowType = ROWTYPE_AGGREGATEINIT;
$controle_combustiveis->resetAttributes();
$controle_combustiveis_list->renderRow();
while ($controle_combustiveis_list->RecCnt < $controle_combustiveis_list->StopRec) {
	$controle_combustiveis_list->RecCnt++;
	if ($controle_combustiveis_list->RecCnt >= $controle_combustiveis_list->StartRec) {
		$controle_combustiveis_list->RowCnt++;

		// Set up key count
		$controle_combustiveis_list->KeyCount = $controle_combustiveis_list->RowIndex;

		// Init row class and style
		$controle_combustiveis->resetAttributes();
		$controle_combustiveis->CssClass = "";
		if ($controle_combustiveis->isGridAdd()) {
		} else {
			$controle_combustiveis_list->loadRowValues($controle_combustiveis_list->Recordset); // Load row values
		}
		$controle_combustiveis->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$controle_combustiveis->RowAttrs = array_merge($controle_combustiveis->RowAttrs, array('data-rowindex'=>$controle_combustiveis_list->RowCnt, 'id'=>'r' . $controle_combustiveis_list->RowCnt . '_controle_combustiveis', 'data-rowtype'=>$controle_combustiveis->RowType));

		// Render row
		$controle_combustiveis_list->renderRow();

		// Render list options
		$controle_combustiveis_list->renderListOptions();
?>
	<tr<?php echo $controle_combustiveis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$controle_combustiveis_list->ListOptions->render("body", "left", $controle_combustiveis_list->RowCnt);
?>
	<?php if ($controle_combustiveis->id->Visible) { // id ?>
		<td data-name="id"<?php echo $controle_combustiveis->id->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_list->RowCnt ?>_controle_combustiveis_id" class="controle_combustiveis_id">
<span<?php echo $controle_combustiveis->id->viewAttributes() ?>>
<?php echo $controle_combustiveis->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($controle_combustiveis->id_veiculo->Visible) { // id_veiculo ?>
		<td data-name="id_veiculo"<?php echo $controle_combustiveis->id_veiculo->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_list->RowCnt ?>_controle_combustiveis_id_veiculo" class="controle_combustiveis_id_veiculo">
<span<?php echo $controle_combustiveis->id_veiculo->viewAttributes() ?>>
<?php echo $controle_combustiveis->id_veiculo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($controle_combustiveis->data_abastecimento->Visible) { // data_abastecimento ?>
		<td data-name="data_abastecimento"<?php echo $controle_combustiveis->data_abastecimento->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_list->RowCnt ?>_controle_combustiveis_data_abastecimento" class="controle_combustiveis_data_abastecimento">
<span<?php echo $controle_combustiveis->data_abastecimento->viewAttributes() ?>>
<?php echo $controle_combustiveis->data_abastecimento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($controle_combustiveis->id_conta->Visible) { // id_conta ?>
		<td data-name="id_conta"<?php echo $controle_combustiveis->id_conta->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_list->RowCnt ?>_controle_combustiveis_id_conta" class="controle_combustiveis_id_conta">
<span<?php echo $controle_combustiveis->id_conta->viewAttributes() ?>>
<?php echo $controle_combustiveis->id_conta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($controle_combustiveis->valor->Visible) { // valor ?>
		<td data-name="valor"<?php echo $controle_combustiveis->valor->cellAttributes() ?>>
<span id="el<?php echo $controle_combustiveis_list->RowCnt ?>_controle_combustiveis_valor" class="controle_combustiveis_valor">
<span<?php echo $controle_combustiveis->valor->viewAttributes() ?>>
<?php echo $controle_combustiveis->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$controle_combustiveis_list->ListOptions->render("body", "right", $controle_combustiveis_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$controle_combustiveis->isGridAdd())
		$controle_combustiveis_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$controle_combustiveis->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($controle_combustiveis_list->Recordset)
	$controle_combustiveis_list->Recordset->Close();
?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$controle_combustiveis->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($controle_combustiveis_list->Pager)) $controle_combustiveis_list->Pager = new PrevNextPager($controle_combustiveis_list->StartRec, $controle_combustiveis_list->DisplayRecs, $controle_combustiveis_list->TotalRecs, $controle_combustiveis_list->AutoHidePager) ?>
<?php if ($controle_combustiveis_list->Pager->RecordCount > 0 && $controle_combustiveis_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($controle_combustiveis_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $controle_combustiveis_list->pageUrl() ?>start=<?php echo $controle_combustiveis_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($controle_combustiveis_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $controle_combustiveis_list->pageUrl() ?>start=<?php echo $controle_combustiveis_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $controle_combustiveis_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($controle_combustiveis_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $controle_combustiveis_list->pageUrl() ?>start=<?php echo $controle_combustiveis_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($controle_combustiveis_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $controle_combustiveis_list->pageUrl() ?>start=<?php echo $controle_combustiveis_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $controle_combustiveis_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($controle_combustiveis_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $controle_combustiveis_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $controle_combustiveis_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $controle_combustiveis_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $controle_combustiveis_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($controle_combustiveis_list->TotalRecs == 0 && !$controle_combustiveis->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $controle_combustiveis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$controle_combustiveis_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$controle_combustiveis->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$controle_combustiveis_list->terminate();
?>