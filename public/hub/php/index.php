<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("PHP - Скриптовый язык общего назначения");
?>
<div class="page-header page-header_full" id="hub_260">
	<div class="page-header_wrapper">
		<div class="media-obj media-obj_page-header">
            <a href="https://habr.com/ru/hub/php/" class="media-obj__image"> <img width="48" src="//habrastorage.org/getpro/habr/hub/98a/7a8/831/98a7a88319d5644cdc627b5e04b47d0f.png" height="48" class="media-obj__image-pic"> </a>
			<div class="media-obj__body media-obj__body_page-header media-obj__body_page-header_hub">
				<div class="page-header__stats">
					<div class="page-header__stats-value">
						 132,08
					</div>
					<div class="page-header__stats-label">
						 Рейтинг
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-header__info">
		<h1 class="page-header__info-title">PHP</h1>
        <span class="n-profiled_hub" title="Профильный хаб"></span>
		<h2 class="page-header__info-desc">Скриптовый язык общего назначения </h2>
	</div>
</div>
<div class="tabs">
	<div class="tabs__level tabs-level_top tabs-menu">
		 <a class="tabs-menu__item tabs-menu__item_link" rel="nofollow" >
            <h3 class="tabs-menu__item-text tabs-menu__item-text_active">Все подряд</h3>
        </a>
        <a class="tabs-menu__item tabs-menu__item_link" rel="nofollow" >
            <h3 class="tabs-menu__item-text ">Лучшие</h3>
        </a>
        <a class="tabs-menu__item tabs-menu__item_link" rel="nofollow" >
            <h3 class="tabs-menu__item-text ">Авторы</h3>
        </a>
	</div>
	<div class="tabs__level tabs__level_bottom">
		<ul class="toggle-menu">
			<li class="toggle-menu__item">
                <a href="/hub/php/all/" class="toggle-menu__item-link <?if($_REQUEST["FILTER"] == 'all') echo 'toggle-menu__item-link_active'?>" rel="nofollow" title="Все публикации в хронологическом порядке">Без порога </a>
            </li>
			<li class="toggle-menu__item">
                <a href="/hub/php/top10/" class="toggle-menu__item-link <?if($_REQUEST["FILTER"] == 'top10') echo 'toggle-menu__item-link_active'?>" rel="nofollow" title="Все публикации с рейтингом 10 и выше">≥10 </a>
            </li>
			<li class="toggle-menu__item">
                <a href="/hub/php/top25/" class="toggle-menu__item-link <?if($_REQUEST["FILTER"] == 'top25') echo 'toggle-menu__item-link_active'?>" rel="nofollow" title="Все публикации с рейтингом 25 и выше">≥25 </a>
            </li>
			<li class="toggle-menu__item">
                <a href="/hub/php/top50/" class="toggle-menu__item-link <?if($_REQUEST["FILTER"] == 'top50') echo 'toggle-menu__item-link_active'?>" rel="nofollow" title="Все публикации с рейтингом 50 и выше">≥50 </a>
            </li>
			<li class="toggle-menu__item">
                <a href="/hub/php/top100/" class="toggle-menu__item-link <?if($_REQUEST["FILTER"] == 'top100') echo 'toggle-menu__item-link_active'?>" rel="nofollow" title="Все публикации с рейтингом 100 и выше">≥100 </a>
            </li>
		</ul>
	</div>
</div>

<?$APPLICATION->IncludeComponent(
    "main:posts.list",
    "habr",
    [
        "FILTER" => $_REQUEST["FILTER"],
        "CURPAGE" => $_REQUEST["CURPAGE"],
        "POSTS_PER_PAGE" => 2,
    ]
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>