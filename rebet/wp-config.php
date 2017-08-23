<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'kiss_fanli');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'root');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

define('SAVEQUERIES', true);
define( 'DIEONDBERROR', true );
/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AUqQbOS6]!l8y94*d^_zeqe^m oh9sd.YvgWgl$5g)~n-#pf^=v{OQ.1Xy@3!/rb');
define('SECURE_AUTH_KEY',  'NkNdJ*nbtx7A-*CGP~[A`]FQ1i7YIl*p6(|U^*85;:Il>-CTbdaf($6kLyU,isk#');
define('LOGGED_IN_KEY',    '!!%E9Z8@Bf;fx^UCy%PH<QtQ@A;lTeqZMr7;?oKsZ8Dy{uJqMG}q8o(kx1-EA%QQ');
define('NONCE_KEY',        '}1 +ZN(sdop*&1]h(RL}lNRiR.o6/Cl>1vJ}GsrvjK3)ES$JWVJI+htsS8O:KKCh');
define('AUTH_SALT',        'T3bN?PZwyb2rj38|k$=2-W#*E}5HjhCa{f0 *|CxvF6:t6m2TQSEj^^`C8:-k:!a');
define('SECURE_AUTH_SALT', 'KPv+Gj,80zyVYXquCwZf87]P:Vy@.5:i$bX7$~_Dr3a*E>43IpDKK<u~LGH5%}L4');
define('LOGGED_IN_SALT',   '>nL5a#~M]i@iAC[{~}BU@GC4:(E^>a, lO1Y- #2v0gt<KPY$lg:T>NAU$ufDQcL');
define('NONCE_SALT',       '0z, g3;KC3CbXu9UX?5V;CkJK(ho4#JTwW`}S_6wfH!-.B#A^j|oIoW4@dcl@l)2');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
setlocale(LC_ALL, 'zh_CN.UTF8');
/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);
define('ALLOW_UNFILTERED_UPLOADS',  true);
/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */
define ('WP_CONTENT_FOLDERNAME', 'assets');
define ('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME) ;
define('WP_SITEURL', 'http://localhost/reference_project/rebate/');
define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME);
//define( 'WP_CONTENT_DIR', 'D:\www\2017\03\fanlisys\wp-content' );
//define( 'WP_CONTENT_URL', 'http://localhost/2017/03/fanlisys/cont' );

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
