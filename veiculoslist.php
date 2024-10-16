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
$veiculos_list = new veiculos_list();

// Run the page
$veiculos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$veiculos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$veiculos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fveiculoslist = currentForm = new ew.Form("fveiculoslist", "list");
fveiculoslist.formKeyCountName = '<?php echo $veiculos_list->FormKeyCountName ?>';

// Form_CustomValidate event
fveiculoslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fveiculoslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fveiculoslistsrch = currentSearchForm = new ew.Form("fveiculoslistsrch");

// Filters
fveiculoslistsrch.filterList = <?php echo $veiculos_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$veiculos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($veiculos_list->TotalRecs > 0 && $veiculos_list->ExportOptions->visible()) { ?>
<?php $veiculos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($veiculos_list->ImportOptions->visible()) { ?>
<?php $veiculos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($veiculos_list->SearchOptions->visible()) { ?>
<?php $veiculos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($veiculos_list->FilterOptions->visible()) { ?>
<?php $veiculos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$veiculos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$veiculos->isExport() && !$veiculos->CurrentAction) { ?>
<form name="fveiculoslistsrch" id="fveiculoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($veiculos_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fveiculoslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="veiculos">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($veiculos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($veiculos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $veiculos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($veiculos_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($veiculos_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($veiculos_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($veiculos_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $veiculos_list->showPageHeader(); ?>
<?php
$veiculos_list->showMessage();
?>
<?php if ($veiculos_list->TotalRecs > 0 || $veiculos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($veiculos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> veiculos">
<form name="fveiculoslist" id="fveiculoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($veiculos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $veiculos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="veiculos">
<div id="gmp_veiculos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($veiculos_list->TotalRecs > 0 || $veiculos->isGridEdit()) { ?>
<table id="tbl_veiculoslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$veiculos_list->RowType = ROWTYPE_HEADER;

// Render list options
$veiculos_list->renderListOptions();

// Render list options (header, left)
$veiculos_list->ListOptions->render("header", "left");
?>
<?php if ($veiculos->id->Visible) { // id ?>
	<?php if ($veiculos->sortUrl($veiculos->id) == "") { ?>
		<th data-name="id" class="<?php echo $veiculos->id->headerCellClass() ?>"><div id="elh_veiculos_id" class="veiculos_id"><div class="ew-table-header-caption"><?php echo $veiculos->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $veiculos->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $veiculos->SortUrl($veiculos->id) ?>',1);"><div id="elh_veiculos_id" class="veiculos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $veiculos->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($veiculos->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($veiculos->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($veiculos->descricao->Visible) { // descricao ?>
	<?php if ($veiculos->sortUrl($veiculos->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $veiculos->descricao->headerCellClass() ?>"><div id="elh_veiculos_descricao" class="veiculos_descricao"><div class="ew-table-header-caption"><?php echo $veiculos->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $veiculos->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $veiculos->SortUrl($veiculos->descricao) ?>',1);"><div id="elh_veiculos_descricao" class="veiculos_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $veiculos->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($veiculos->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($veiculos->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$veiculos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($veiculos->ExportAll && $veiculos->isExport()) {
	$veiculos_list->StopRec = $veiculos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($veiculos_list->TotalRecs > $veiculos_list->StartRec + $veiculos_list->DisplayRecs - 1)
		$veiculos_list->StopRec = $veiculos_list->StartRec + $veiculos_list->DisplayRecs - 1;
	else
		$veiculos_list->StopRec = $veiculos_list->TotalRecs;
}
$veiculos_list->RecCnt = $veiculos_list->StartRec - 1;
if ($veiculos_list->Recordset && !$veiculos_list->Recordset->EOF) {
	$veiculos_list->Recordset->moveFirst();
	$selectLimit = $veiculos_list->UseSelectLimit;
	if (!$selectLimit && $veiculos_list->StartRec > 1)
		$veiculos_list->Recordset->move($veiculos_list->StartRec - 1);
} elseif (!$veiculos->AllowAddDeleteRow && $veiculos_list->StopRec == 0) {
	$veiculos_list->StopRec = $veiculos->GridAddRowCount;
}

// Initialize aggregate
$veiculos->RowType = ROWTYPE_AGGREGATEINIT;
$veiculos->resetAttributes();
$veiculos_list->renderRow();
while ($veiculos_list->RecCnt < $veiculos_list->StopRec) {
	$veiculos_list->RecCnt++;
	if ($veiculos_list->RecCnt >= $veiculos_list->StartRec) {
		$veiculos_list->RowCnt++;

		// Set up key count
		$veiculos_list->KeyCount = $veiculos_list->RowIndex;

		// Init row class and style
		$veiculos->resetAttributes();
		$veiculos->CssClass = "";
		if ($veiculos->isGridAdd()) {
		} else {
			$veiculos_list->loadRowValues($veiculos_list->Recordset); // Load row values
		}
		$veiculos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$veiculos->RowAttrs = array_merge($veiculos->RowAttrs, array('data-rowindex'=>$veiculos_list->RowCnt, 'id'=>'r' . $veiculos_list->RowCnt . '_veiculos', 'data-rowtype'=>$veiculos->RowType));

		// Render row
		$veiculos_list->renderRow();

		// Render list options
		$veiculos_list->renderListOptions();
?>
	<tr<?php echo $veiculos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$veiculos_list->ListOptions->render("body", "left", $veiculos_list->RowCnt);
?>
	<?php if ($veiculos->id->Visible) { // id ?>
		<td data-name="id"<?php echo $veiculos->id->cellAttributes() ?>>
<span id="el<?php echo $veiculos_list->RowCnt ?>_veiculos_id" class="veiculos_id">
<span<?php echo $veiculos->id->viewAttributes() ?>>
<?php echo $veiculos->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($veiculos->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $veiculos->descricao->cellAttributes() ?>>
<span id="el<?php echo $veiculos_list->RowCnt ?>_veiculos_descricao" class="veiculos_descricao">
<span<?php echo $veiculos->descricao->viewAttributes() ?>>
<?php echo $veiculos->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$veiculos_list->ListOptions->render("body", "right", $veiculos_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$veiculos->isGridAdd())
		$veiculos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$veiculos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($veiculos_list->Recordset)
	$veiculos_list->Recordset->Close();
?>
<?php if (!$veiculos->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$veiculos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($veiculos_list->Pager)) $veiculos_list->Pager = new PrevNextPager($veiculos_list->StartRec, $veiculos_list->DisplayRecs, $veiculos_list->TotalRecs, $veiculos_list->AutoHidePager) ?>
<?php if ($veiculos_list->Pager->RecordCount > 0 && $veiculos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($veiculos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $veiculos_list->pageUrl() ?>start=<?php echo $veiculos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($veiculos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $veiculos_list->pageUrl() ?>start=<?php echo $veiculos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $veiculos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($veiculos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $veiculos_list->pageUrl() ?>start=<?php echo $veiculos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($veiculos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $veiculos_list->pageUrl() ?>start=<?php echo $veiculos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $veiculos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($veiculos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $veiculos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $veiculos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $veiculos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $veiculos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($veiculos_list->TotalRecs == 0 && !$veiculos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $veiculos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$veiculos_list->showPageFooter();
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
$veiculos_list->terminate();
?>