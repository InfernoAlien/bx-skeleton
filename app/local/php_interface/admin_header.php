<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init(['jquery2']);

$curPage = $APPLICATION->GetCurPage();

// Для формы добавления инфоблока в Битриксе немного дурацкие и неудобные значения по-умолчанию, немного подкорректируем их:
// 1. Выберем 2 версию инфоблоков, а не 1. В большинстве случаев использовать лучше именно 2 версию.
// 2. Выставим чекбоксы привязок ко всем сайтам вместо незаполненного поля
// 3. Выключим индексирование элементов и разделов каталога для модуля поиска
// 4. Выставим право доступа "Для всех пользователей [2]: Чтение" вместо "Нет доступа"
// Это всё только значения по-умолчанию, при заполнении формы их, конечно, можно менять.
if ($curPage === '/bitrix/admin/iblock_edit.php' && empty($_GET['ID'])) {
?>
    <script>
        $(function() {
            $('input[name="VERSION"][value="2"]').attr('checked', true);
            $('input[name="LID[]"]').prop('checked', true);
            $('input[name="INDEX_SECTION"]').prop('checked', false);
            $('input[name="INDEX_ELEMENT"]').prop('checked', false);
            $('select[name="GROUP[2]"]').val("R");
        });
    </script>
<?
}
