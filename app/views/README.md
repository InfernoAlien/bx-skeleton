В данной директории располагаются всякие дополнительные "шаблоны"/"вьюшки",
которые могут потребоваться в проекте и которые лучше хранить выше DOCUMENT_ROOT чтобы не создавать проблем связанных с безопасностью.
Предназначение этих вьюшек может быть абсолютно любым.

По-умолчанию здесь хранятся:
1. Директория `blade` - общие вьюшки блейда
2. Директория `admin` - пользовательские административные страницы, которые мы хотим добавить в `/bitrix/admin`
3. Директория `popups` - все попапы в проекте

Можно добавить и свои директории, например `vue_components` чтобы хранить в ней шаблоны компонентов `vue.js`, или `email_templates` чтобы хранить в ней какие-то шаблоны писем.