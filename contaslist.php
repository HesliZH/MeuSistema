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
$contas_list = new contas_list();

// Run the page
$contas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontaslist = currentForm = new ew.Form("fcontaslist", "list");
fcontaslist.formKeyCountName = '<?php echo $contas_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontaslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontaslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontaslist.lists["x_inativo[]"] = <?php echo $contas_list->inativo->Lookup->toClientList() ?>;
fcontaslist.lists["x_inativo[]"].options = <?php echo JsonEncode($contas_list->inativo->options(FALSE, TRUE)) ?>;

// Form object for search
var fcontaslistsrch = currentSearchForm = new ew.Form("fcontaslistsrch");

// Filters
fcontaslistsrch.filterList = <?php echo $contas_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contas_list->TotalRecs > 0 && $contas_list->ExportOptions->visible()) { ?>
<?php $contas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_list->ImportOptions->visible()) { ?>
<?php $contas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_list->SearchOptions->visible()) { ?>
<?php $contas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contas_list->FilterOptions->visible()) { ?>
<?php $contas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contas->isExport() && !$contas->CurrentAction) { ?>
<form name="fcontaslistsrch" id="fcontaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($contas_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcontaslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contas">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($contas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($contas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contas_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contas_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contas_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contas_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $contas_list->showPageHeader(); ?>
<?php
$contas_list->showMessage();
?>
<?php if ($contas_list->TotalRecs > 0 || $contas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contas">
<form name="fcontaslist" id="fcontaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas">
<div id="gmp_contas" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($contas_list->TotalRecs > 0 || $contas->isGridEdit()) { ?>
<table id="tbl_contaslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contas_list->RowType = ROWTYPE_HEADER;

// Render list options
$contas_list->renderListOptions();

// Render list options (header, left)
$contas_list->ListOptions->render("header", "left");
?>
<?php if ($contas->id->Visible) { // id ?>
	<?php if ($contas->sortUrl($contas->id) == "") { ?>
		<th data-name="id" class="<?php echo $contas->id->headerCellClass() ?>"><div id="elh_contas_id" class="contas_id"><div class="ew-table-header-caption"><?php echo $contas->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $contas->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas->SortUrl($contas->id) ?>',1);"><div id="elh_contas_id" class="contas_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas->descricao->Visible) { // descricao ?>
	<?php if ($contas->sortUrl($contas->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $contas->descricao->headerCellClass() ?>"><div id="elh_contas_descricao" class="contas_descricao"><div class="ew-table-header-caption"><?php echo $contas->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $contas->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas->SortUrl($contas->descricao) ?>',1);"><div id="elh_contas_descricao" class="contas_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contas->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas->inativo->Visible) { // inativo ?>
	<?php if ($contas->sortUrl($contas->inativo) == "") { ?>
		<th data-name="inativo" class="<?php echo $contas->inativo->headerCellClass() ?>"><div id="elh_contas_inativo" class="contas_inativo"><div class="ew-table-header-caption"><?php echo $contas->inativo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inativo" class="<?php echo $contas->inativo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas->SortUrl($contas->inativo) ?>',1);"><div id="elh_contas_inativo" class="contas_inativo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas->inativo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas->inativo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas->inativo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contas->ExportAll && $contas->isExport()) {
	$contas_list->StopRec = $contas_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contas_list->TotalRecs > $contas_list->StartRec + $contas_list->DisplayRecs - 1)
		$contas_list->StopRec = $contas_list->StartRec + $contas_list->DisplayRecs - 1;
	else
		$contas_list->StopRec = $contas_list->TotalRecs;
}
$contas_list->RecCnt = $contas_list->StartRec - 1;
if ($contas_list->Recordset && !$contas_list->Recordset->EOF) {
	$contas_list->Recordset->moveFirst();
	$selectLimit = $contas_list->UseSelectLimit;
	if (!$selectLimit && $contas_list->StartRec > 1)
		$contas_list->Recordset->move($contas_list->StartRec - 1);
} elseif (!$contas->AllowAddDeleteRow && $contas_list->StopRec == 0) {
	$contas_list->StopRec = $contas->GridAddRowCount;
}

// Initialize aggregate
$contas->RowType = ROWTYPE_AGGREGATEINIT;
$contas->resetAttributes();
$contas_list->renderRow();
while ($contas_list->RecCnt < $contas_list->StopRec) {
	$contas_list->RecCnt++;
	if ($contas_list->RecCnt >= $contas_list->StartRec) {
		$contas_list->RowCnt++;

		// Set up key count
		$contas_list->KeyCount = $contas_list->RowIndex;

		// Init row class and style
		$contas->resetAttributes();
		$contas->CssClass = "";
		if ($contas->isGridAdd()) {
		} else {
			$contas_list->loadRowValues($contas_list->Recordset); // Load row values
		}
		$contas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contas->RowAttrs = array_merge($contas->RowAttrs, array('data-rowindex'=>$contas_list->RowCnt, 'id'=>'r' . $contas_list->RowCnt . '_contas', 'data-rowtype'=>$contas->RowType));

		// Render row
		$contas_list->renderRow();

		// Render list options
		$contas_list->renderListOptions();
?>
	<tr<?php echo $contas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contas_list->ListOptions->render("body", "left", $contas_list->RowCnt);
?>
	<?php if ($contas->id->Visible) { // id ?>
		<td data-name="id"<?php echo $contas->id->cellAttributes() ?>>
<span id="el<?php echo $contas_list->RowCnt ?>_contas_id" class="contas_id">
<span<?php echo $contas->id->viewAttributes() ?>>
<?php echo $contas->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $contas->descricao->cellAttributes() ?>>
<span id="el<?php echo $contas_list->RowCnt ?>_contas_descricao" class="contas_descricao">
<span<?php echo $contas->descricao->viewAttributes() ?>>
<?php echo $contas->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas->inativo->Visible) { // inativo ?>
		<td data-name="inativo"<?php echo $contas->inativo->cellAttributes() ?>>
<span id="el<?php echo $contas_list->RowCnt ?>_contas_inativo" class="contas_inativo">
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
<?php

// Render list options (body, right)
$contas_list->ListOptions->render("body", "right", $contas_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$contas->isGridAdd())
		$contas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$contas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contas_list->Recordset)
	$contas_list->Recordset->Close();
?>
<?php if (!$contas->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contas->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contas_list->Pager)) $contas_list->Pager = new PrevNextPager($contas_list->StartRec, $contas_list->DisplayRecs, $contas_list->TotalRecs, $contas_list->AutoHidePager) ?>
<?php if ($contas_list->Pager->RecordCount > 0 && $contas_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contas_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contas_list->pageUrl() ?>start=<?php echo $contas_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contas_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contas_list->pageUrl() ?>start=<?php echo $contas_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contas_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contas_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contas_list->pageUrl() ?>start=<?php echo $contas_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contas_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contas_list->pageUrl() ?>start=<?php echo $contas_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contas_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contas_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contas_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contas_list->TotalRecs == 0 && !$contas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contas_list->showPageFooter();
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
$contas_list->terminate();
?>