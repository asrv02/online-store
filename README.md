# online-store
Язык программирования php, работа с фреймворком yii2.

Рубрики сайта.

Всем пользователям доступны рубрики: "О нас", "Каталог", "Где нас найти?". На странице «О нас» представлен слайдер ("Новинки компании") с пятью последними добавленными товарами (выводится фото товара и его название).
На странице «Каталог» по умолчанию представлены все товары, упорядоченные по новизне (от новых добавленных к более старым). Упорядочить товары можно: по году производства, по наименованию, по цене. Также товары можно отфильтровать по категориям. Каждая карточка товара представлена изображением, названием и ценой. При клике на товар открывается отдельная страница товара. Пользователю всегда показывает товары, которые только есть в наличии.
Каждая страница товаров содержит фото товара, наименование, цену и характеристики (страна-производитель, год выпуска, модель).
Форма регистрации нового пользователя в системе должна содержать следующие
поля:
- name – обязательное поле, разрешенные символы (кириллица, пробел и тире);
- surname – обязательное поле, разрешенные символы (кириллица, пробел и
тире);
- patronymic – не обязательное поле, разрешенные символы (кириллица, пробел
- и тире);
- login – обязательное и уникальное поле, разрешенные символы (латиница,
цифры и тире);
- email – обязательное и уникальное поле, проверка на email;
- password – обязательное поле, не менее 6-ти символов;
- password_repeat – обязательное поле, должно совпадать с полем password;
- rules - согласие с правилами регистрации.
При ошибках валидации пользователю должны выводиться сообщения без
перезагрузки страницы.
Форма авторизации пользователя в системе должна содержать следующие поля:
- login,
- password.
При ошибках валидации пользователю должны выводиться сообщения.

Функционал клиента:

Формирование корзины. После авторизации у пользователя появляется кнопка "В корзину" на карточках товаров
в каталоге, а также на странице самого товара. Каждое нажатие добавляет 1 товар в
корзину. Нельзя добавить в корзину больше товаров, чем есть в наличии (выдается
сообщение об ошибке без перезагрузки страницы).
Управление корзиной. В корзине можно добавить или убрать единицу каждого товара (учитывая ограничения
по количеству в наличии). После чего пользователь может сформировать заказ.

Оформление заказа. Пользователь вводит свой пароль для подтверждения заказа и нажимает кнопку
"Сформировать заказ" (выдается сообщение об ошибке без перезагрузки страницы в
случае неверного ввода пароля).

Просмотр заказов. Пользователь может просмотреть список своих заказов (в каждом есть количество
товаров, его наименование и их статус), упорядоченных от новых к старым.
Пользователь также имеет возможность удалить новые заказы.

Функционал администратора:

Просмотр списка всех заказов. Администратор может просматривать все заказы, фильтруя их по: новые, подтвержденные, отмененные. В списке видны таймстамп заказа, ФИО заказчика и количество заказанных товаров. По умолчанию у всех заказов статус "Новый".

Управление заказом. Администратор может отменить заказ, указав причину отказа или подтвердить заказ.

Управление товарами. Администратор опубликовывает, удаляет и редактирует товары.

Управление категориями. В будущем планируется расширение спектра товаров для этого нужно сделать функцию
добавления и удаления категории.
