<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'beka' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Xp-H!}b,@#tVK~gan IvQ!xSz)x{F}[XJNImK/*+rF)zZQJ:/|moFJ?MQnjZW71O' );
define( 'SECURE_AUTH_KEY',  '&.*)^Pnb,tn0^]#jJ+%)hwr(KmEKcs=3.9|;s^9mA`t{pYq/^)NnwRlr*.KC%]R2' );
define( 'LOGGED_IN_KEY',    'YuUe_+l4R+g~;{rM}Qqw=JY*QwI~@T:olWjJg93Xi6jl+Hm],nKw4j^LD$fD{Ta+' );
define( 'NONCE_KEY',        '^:#@l&X,#pWJC=RYN`1Srem7i~8$IO;;7Q]K32y$gH#Ws8MWpb5[zl@Lvmv:2a;m' );
define( 'AUTH_SALT',        '/,R<NJD,Gr=%<SGn!ew+&D[wa]WR+Sf,p#V4O1%[Irz8IL||HJM{7xoz$*.hKl6F' );
define( 'SECURE_AUTH_SALT', 'v[+`5zL&y/f31EfXHVFXyz*{+>wJ%pl]e,Lm|/RU}%Cipe[:ZC]Cm#S )Zs0`.vg' );
define( 'LOGGED_IN_SALT',   'IxI}hhk{]n[VH79h;%`60ViVA]RZCx)t3Qb5Xoo%)UN3I6n`Z6<s104x#g:St%mo' );
define( 'NONCE_SALT',       'Mx+K`2|i@dVHR(dj#j;ynb*+Aa2#G=g=n*Q!<Vq_w&hX(Rrk.)/-/Iy>G&8+{<@m' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
