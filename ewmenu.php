<?php
namespace PHPMaker2019\MeuSistema;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_contas", $MenuLanguage->MenuPhrase("1", "MenuText"), "contaslist.php", -1, "", IsLoggedIn() || AllowListMenu('{628FD02F-7671-473B-A63D-794D47F89F71}contas'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_veiculos", $MenuLanguage->MenuPhrase("2", "MenuText"), "veiculoslist.php", -1, "", IsLoggedIn() || AllowListMenu('{628FD02F-7671-473B-A63D-794D47F89F71}veiculos'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_controle_combustiveis", $MenuLanguage->MenuPhrase("3", "MenuText"), "controle_combustiveislist.php", -1, "", IsLoggedIn() || AllowListMenu('{628FD02F-7671-473B-A63D-794D47F89F71}controle_combustiveis'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_contas_pagar", $MenuLanguage->MenuPhrase("4", "MenuText"), "contas_pagarlist.php", -1, "", IsLoggedIn() || AllowListMenu('{628FD02F-7671-473B-A63D-794D47F89F71}contas_pagar'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>