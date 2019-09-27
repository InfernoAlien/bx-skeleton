<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?php frontend()->setPage('test') ?>

<main class="test-page">
        <div class="test-page__wrapper">
            <div class="test-page__container">
                <nav class="breadcrumbs breadcrumbs-- test-page__breadcrumbs" aria-labelledby="breadcrumbs--hl">
                    <h2 class="breadcrumbs__hl is-hidden" id="breadcrumbs--hl">Вы находитесь здесь:</h2>
                    <ol class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__link">Webpack Blank Project</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__link">Исходный код</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__link">Страницы</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <span>Main Test Page</span>
                        </li>
                    </ol>
                </nav>
                <h1 class="test-page__hl">Main Test Page</h1>
                <div class="test-page__desc">
                    Данная тестовая страница предназначена для проверки интеграции и включает в себя все существующие на проекте компоненты.
                </div>
            </div>
            <section class="test-page__section">
                <div class="test-page__container">
                    <h2 class="test-page__section-hl">
                        <span class="test-page__section-hl-container">Форма</span>
                    </h2>
                    <form class="test-page__form test-form" name="test-form" data-validate="true">
                        <fieldset class="toggle toggle--test test-form__toggle">
                            <legend class="is-hidden">Активация формы</legend>
                            <input type="checkbox" class="toggle__input" name="toggle-test[]" id="toggle-test-1" value="1" checked="checked">
                            <label class="toggle__label toggle__label--empty" for="toggle-test-1">
                                Активировать форму
                            </label>
                        </fieldset>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="field field--name test-form__field test-form__field--name">
                                    <label class="field__label" for="field-name">Введите ФИО *</label>
                                    <input class="field__input" type="text" name="name" id="field-name" data-parsley-name placeholder="Фамилия Имя Отчество" required>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="select select--single-render">
                                    <label class="select__label" for="select-single-render">Выберите лучшего программиста *</label>
                                    <select class="select__input" id="select-single-render" name="select-single-render" required>
                                        <option placeholder value>
                                            Выберите вариант...
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="field field--password">
                                    <label class="field__label" for="field-password">Введите пароль *</label>
                                    <input class="field__input field__input--control" type="password" name="password" id="field-password" data-parsley-password data-parsley-minlength="8" autocomplete="off" required>
                                    <div class="field__control field__control--password">
                                        <button class="field__password-btn" type="button">
                                            <svg class="icon icon--view field__icon">
                                                <title>Показать пароль</title>
                                                <use xlink:href="#icon-view"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="test-form__col">
                                <div class="field field--password-repeat">
                                    <label class="field__label" for="field-password-repeat">Повторите пароль *</label>
                                    <input class="field__input" type="password" name="password-repeat" id="field-password-repeat" data-parsley-equalto="#field-password" autocomplete="off" required>
                                    <div class="field__control field__control--password">
                                        <button class="field__password-btn" type="button">
                                            <svg class="icon icon--view field__icon">
                                                <title>Показать пароль</title>
                                                <use xlink:href="#icon-view"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="field field--textarea">
                                    <label class="field__label" for="field-textarea">Напишите о себе (не более 1000 символов) *</label>
                                    <textarea class="field__input" name="textarea" id="field-textarea" rows="1" maxlength="1000" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="select select--multiple">
                                    <label class="select__label" for="select-multiple">Накидайте вариантов из списка (не более 5) *</label>
                                    <select class="select__input" id="select-multiple" name="select-multiple[]" multiple="multiple" required>
                                        <option value="1">Вариант 1</option>
                                        <option value="2">Второй</option>
                                        <option value="3">Номер 3</option>
                                        <option value="4">Между 3 и 5</option>
                                        <option value="5">Пятый вариантиус</option>
                                        <option value="6">После 6-го идущий</option>
                                        <option value="7">7-ой пункт</option>
                                        <option value="8">8-ой варик</option>
                                        <option value="9">Наконец-то предпоследний</option>
                                        <option value="10">Ну и ластецкий</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="datepicker datepicker--single" data-mode="single" data-min="01.01.1900" data-max="today">
                                    <div class="field field--single field--datepicker datepicker__field">
                                        <label class="field__label" for="field-single">Дата рождения *</label>
                                        <input class="field__input field__input--datepicker field__input--control js-mask-date-single" type="text" name="single" id="field-single" data-parsley-date-single data-parsley-date-min-max="01.01.1900 — today" autocomplete="off" placeholder="01.01.2018" required>
                                        <div class="field__control">
                                            <svg class="icon icon--calendar field__icon">
                                                <use xlink:href="#icon-calendar"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="test-form__col">
                                <div class="datepicker datepicker--range" data-mode="range" data-min="01.01.2019" data-max="31.12.2019">
                                    <div class="field field--range field--datepicker datepicker__field">
                                        <label class="field__label" for="field-range">Диапазон дат в 2019 *</label>
                                        <input class="field__input field__input--datepicker field__input--control js-mask-date-range" type="text" name="range" id="field-range" data-parsley-date-range data-parsley-date-order data-parsley-date-min-max="01.01.2019 — 31.12.2019" autocomplete="off" placeholder="01.01.2019 — 31.01.2019" required>
                                        <div class="field__control">
                                            <svg class="icon icon--calendar field__icon">
                                                <use xlink:href="#icon-calendar"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="datepicker datepicker--multiple" data-mode="multiple">
                                    <div class="field field--multiple field--datepicker datepicker__field">
                                        <label class="field__label" for="field-multiple">Набор дат (от 3 до 10) *</label>
                                        <input class="field__input field__input--datepicker field__input--control js-mask-date-multiple" type="text" name="multiple" id="field-multiple" data-parsley-date-multiple data-parsley-date-min-max-count="3 — 10" autocomplete="off" placeholder="01.01.2019, 10.01.2019" required>
                                        <div class="field__control">
                                            <svg class="icon icon--calendar field__icon">
                                                <use xlink:href="#icon-calendar"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <p class="test-page__paragraph">Лучший фреймворк:</p>
                                <fieldset class="radio radio--test">
                                    <legend class="is-hidden">Выберите любимый фреймворк</legend>
                                    <input type="radio" class="radio__input" name="radio-test" id="radio-test-1" value="1" checked="checked" required>
                                    <label class="radio__label" for="radio-test-1">React</label>
                                    <input type="radio" class="radio__input" name="radio-test" id="radio-test-2" value="2" required>
                                    <label class="radio__label" for="radio-test-2">VueJS</label>
                                    <input type="radio" class="radio__input" name="radio-test" id="radio-test-3" value="3" required>
                                    <label class="radio__label" for="radio-test-3">Angular</label>
                                </fieldset>
                            </div>
                            <div class="test-form__col">
                                <p class="test-page__paragraph">Любимое число от 1 до 10:</p>
                                <div class="spinner spinner--test">
                                    <button class="spinner__btn spinner__btn--dec" type="button">
                                        <svg class="icon icon--minus spinner__icon">
                                            <title>Уменьшить</title>
                                            <use xlink:href="#icon-minus"></use>
                                        </svg>
                                    </button>
                                    <label class="spinner__label is-hidden" for="spinner-test-input">Значение:</label>
                                    <input type="number" class="spinner__input" name="spinner-test-input" id="spinner-test-input" value="5" min="1" max="10">
                                    <button class="spinner__btn spinner__btn--inc" type="button">
                                        <svg class="icon icon--plus spinner__icon">
                                            <title>Увеличить</title>
                                            <use xlink:href="#icon-plus"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <div class="custom-file custom-file--test" data-name="test">
                                    <ul class="custom-file__btns-list">
                                    </ul>
                                    <ul class="custom-file__files-list">
                                    </ul>
                                    <input type="hidden" class="custom-file__index-input" name="custom-file-test-index">
                                </div>
                            </div>
                        </div>
                        <div class="test-form__row">
                            <div class="test-form__col">
                                <fieldset class="rating rating--test test-form__rating">
                                    <legend class="rating__legend">Оцените эту форму:</legend>
                                    <div class="rating__container">
                                        <input type="radio" id="test-empty" class="rating__input rating__input--empty" name="test" value="0" aria-label="Без рейтинга" checked="checked">
                                        <input type="radio" id="test-1" class="rating__input" name="test" value="1">
                                        <label for="test-1" class="rating__label rating__label--half" title="Совсем ужасно">Совсем ужасно</label>
                                        <input type="radio" id="test-2" class="rating__input" name="test" value="2">
                                        <label for="test-2" class="rating__label" title="Ужасно">Ужасно</label>
                                        <input type="radio" id="test-3" class="rating__input" name="test" value="3">
                                        <label for="test-3" class="rating__label rating__label--half" title="Совсем плохо">Совсем плохо</label>
                                        <input type="radio" id="test-4" class="rating__input" name="test" value="4">
                                        <label for="test-4" class="rating__label" title="Плохо">Плохо</label>
                                        <input type="radio" id="test-5" class="rating__input" name="test" value="5">
                                        <label for="test-5" class="rating__label rating__label--half" title="Удовлетворительно">Удовлетворительно</label>
                                        <input type="radio" id="test-6" class="rating__input" name="test" value="6">
                                        <label for="test-6" class="rating__label" title="Нормально">Нормально</label>
                                        <input type="radio" id="test-7" class="rating__input" name="test" value="7">
                                        <label for="test-7" class="rating__label rating__label--half" title="Почти хорошо">Почти хорошо</label>
                                        <input type="radio" id="test-8" class="rating__input" name="test" value="8">
                                        <label for="test-8" class="rating__label" title="Хорошо">Хорошо</label>
                                        <input type="radio" id="test-9" class="rating__input" name="test" value="9">
                                        <label for="test-9" class="rating__label rating__label--half" title="Почти отлично">Почти отлично</label>
                                        <input type="radio" id="test-10" class="rating__input" name="test" value="10">
                                        <label for="test-10" class="rating__label" title="Отлично">Отлично</label>
                                        <span class="rating__focus"></span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="checkbox checkbox--test">
                            <legend class="is-hidden">Согласие на обработку персональных данных</legend>
                            <input type="checkbox" class="checkbox__input" name="checkbox-test[]" id="checkbox-test" value="1" required>
                            <label class="checkbox__label" for="checkbox-test">Я согласен на обработку персональных данных</label>
                        </fieldset>
                        <button class="test-form__btn btn" type="submit">Отправить</button>
                    </form>
                </div>
            </section>
            <section class="test-page__section">
                <div class="test-page__container">
                    <h2 class="test-page__section-hl">
                        <span class="test-page__section-hl-container">Табы</span>
                    </h2>
                    <div class="tabs tabs--test">
                        <div class="tabs__items">
                            <button type="button" class="tabs__item" id="tabs-test-item-0">Карусель</button>
                            <button type="button" class="tabs__item" id="tabs-test-item-1">Слайдер</button>
                        </div>
                        <div class="tabs__panels">
                            <div class="tabs__panel" id="tabs-test-panel-0">
                                <div class="carousel carousel--test-1 swiper-container test-page__carousel" data-pagination="bullets">
                                    <ul class="swiper-wrapper">
                                        <li class="swiper-slide">Slide 1</li>
                                        <li class="swiper-slide">Slide 2</li>
                                        <li class="swiper-slide">Slide 3</li>
                                        <li class="swiper-slide">Slide 4</li>
                                        <li class="swiper-slide">Slide 5</li>
                                        <li class="swiper-slide">Slide 6</li>
                                        <li class="swiper-slide">Slide 7</li>
                                        <li class="swiper-slide">Slide 8</li>
                                        <li class="swiper-slide">Slide 9</li>
                                        <li class="swiper-slide">Slide 10</li>
                                    </ul>
                                    <button class="swiper-button-prev" type="button">
                                        <svg class="icon icon--arrow carousel__nav-icon">
                                            <title>Предыдущий слайд</title>
                                            <use xlink:href="#icon-arrow"></use>
                                        </svg>
                                    </button>
                                    <button class="swiper-button-next" type="button">
                                        <svg class="icon icon--arrow carousel__nav-icon">
                                            <title>Следующий слайд</title>
                                            <use xlink:href="#icon-arrow"></use>
                                        </svg>
                                    </button>
                                    <ul class="swiper-pagination"></ul>
                                </div>
                                <nav class="pagination pagination--test" aria-labelledby="pagination-test-hl">
                                    <h2 class="pagination__status is-hidden" id="pagination-test-hl">
                                        Пример пагинации &mdash; страница 50
                                    </h2>
                                    <a href="javascript:;" class="pagination__btn pagination__btn--prev">
                                        <svg class="icon icon--arrow">
                                            <title>Предыдущая страница</title>
                                            <use xlink:href="#icon-arrow"></use>
                                        </svg>
                                    </a>
                                    <ol class="pagination__list">
                                        <li class="pagination__item">
                                            <a href="javascript:;" class="pagination__link">
                                                <span class="is-hidden">Перейти к странице </span>1
                                            </a>
                                        </li>
                                        <li class="pagination__item">
                                            <div class="pagination__dots">...</div>
                                        </li>
                                        <li class="pagination__item">
                                            <a href="javascript:;" class="pagination__link">
                                                <span class="is-hidden">Перейти к странице </span>49
                                            </a>
                                        </li>
                                        <li class="pagination__item">
                                            <a href="javascript:;" class="pagination__link" aria-current="page">
                                                50<span class="is-hidden"> &mdash; текущая страница</span>
                                            </a>
                                        </li>
                                        <li class="pagination__item">
                                            <a href="javascript:;" class="pagination__link">
                                                <span class="is-hidden">Перейти к странице </span>51
                                            </a>
                                        </li>
                                        <li class="pagination__item">
                                            <div class="pagination__dots">...</div>
                                        </li>
                                        <li class="pagination__item">
                                            <a href="javascript:;" class="pagination__link">
                                                <span class="is-hidden">Перейти к странице </span>99
                                            </a>
                                        </li>
                                    </ol>
                                    <a href="javascript:;" class="pagination__btn pagination__btn--next">
                                        <svg class="icon icon--arrow">
                                            <title>Следующая страница</title>
                                            <use xlink:href="#icon-arrow"></use>
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                            <div class="tabs__panel" id="tabs-test-panel-1">
                                <div class="test-page__paragraph">
                                    Выберите количество бонусов для списания:
                                    <div class="tooltip tooltip--question tooltip--tooltip">
                                        <button type="button" class="tooltip__trigger tooltip__trigger--question">?</button>
                                    </div>
                                </div>
                                <div class="range-slider range-slider--single" data-start="1000" data-min="0" data-max="1000" data-step="10">
                                    <div class="range-slider__control"></div>
                                    <p class="range-slider__values">
                                        <span class="range-slider__prefix">Использовать </span>
                                        <span class="range-slider__value range-slider__value--single"></span>
                                        <span class="range-slider__postfix">бонусов</span>
                                    </p>
                                </div>
                                <div class="test-page__paragraph">
                                    Установите диапазон цен:
                                    <div class="tooltip tooltip--question tooltip--dropdown">
                                        <button type="button" class="tooltip__trigger tooltip__trigger--question">?</button>
                                    </div>
                                </div>
                                <div class="range-slider range-slider--multiple" data-start="30000,70000" data-min="0" data-max="100000" data-step="100">
                                    <div class="range-slider__control"></div>
                                    <p class="range-slider__inputs">
                                        <label class="range-slider__label range-slider__label--from" for="range-slider-multiple-from">От</label>
                                        <input class="range-slider__input" type="number" name="range-slider-multiple-from" id="range-slider-multiple-from" step="100" max="100000">
                                        <label class="range-slider__label range-slider__label--to" for="range-slider-multiple-to">до</label>
                                        <input class="range-slider__input" type="number" name="range-slider-multiple-to" id="range-slider-multiple-to" step="100" max="100000">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="test-page__section">
                <div class="test-page__container">
                    <h2 class="test-page__section-hl">
                        <span class="test-page__section-hl-container">Аккордеон</span>
                    </h2>
                    <div class="accordion accordion--test">
                        <div class="accordion__item">
                            <h3 class="accordion__head">
                                <button type="button" class="accordion__head-btn" id="accordion-test-head-0">
                                    Всё
                                </button>
                            </h3>
                            <div class="accordion__panel" id="accordion-test-panel-0">
                                <div class="accordion__panel-container">
                                    <ul>
                                        <li>Toggle</li>
                                        <li>Field</li>
                                        <li>Select</li>
                                        <li>Datepicker</li>
                                        <li>RangeSlider</li>
                                        <li>Accordion</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <h3 class="accordion__head">
                                <button type="button" class="accordion__head-btn" id="accordion-test-head-1">
                                    Должно
                                </button>
                            </h3>
                            <div class="accordion__panel" id="accordion-test-panel-1">
                                <div class="accordion__panel-container">
                                    <ul>
                                        <li>Radio</li>
                                        <li>Checkbox</li>
                                        <li>CustomFile</li>
                                        <li>Spinner</li>
                                        <li>Tooltip</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion__item">
                            <h3 class="accordion__head">
                                <button type="button" class="accordion__head-btn" id="accordion-test-head-2">
                                    Работать
                                </button>
                            </h3>
                            <div class="accordion__panel" id="accordion-test-panel-2">
                                <div class="accordion__panel-container">
                                    <ul>
                                        <li>Rating</li>
                                        <li>Breadcrumbs</li>
                                        <li>Tabs</li>
                                        <li>Carousel</li>
                                        <li>Pagination</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="test-page__section">
                <div class="test-page__container">
                    <h2 class="test-page__section-hl">
                        <span class="test-page__section-hl-container">Изображения</span>
                    </h2>
                    <ul class="test-page__gallery"></ul>
                    <ul class="test-page__previews"></ul>
                </div>
            </section>
        </div>
    </main>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>