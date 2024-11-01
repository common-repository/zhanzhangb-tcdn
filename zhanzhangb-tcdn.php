<?php
/**
    Plugin Name: 站长帮 - WordPress CDN 管理插件
	Plugin URI: https://www.zhanzhangb.cn/wordpress-cdn-plugins
    Text Domain: zhanzhangb-tcdn
	Requires PHP: 8.1
    Description: 为 WordPress 网站添加自动管理 CDN 缓存的功能。在发布或更新文章、发表评论或评论被审批后自动刷新/预缓存相关URL的 CDN 缓存，目前仅支持腾讯云CDN。
    Version: 1.3.1
    Author: 站长帮
    Author URI: https://www.zhanzhangb.cn/
    License: GNU General Public License (GPL) version 3
    License URI: https://www.gnu.org/licenses/gpl-3.0.html

    Copyright (c) 2020-2024, 站长帮（zhanzhangb.cn）

    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/*
*    BOOTSTRAP FILE
*/
defined( 'ABSPATH' ) || exit;
define('zhanzhangbtcdn_basename', plugin_basename(__FILE__));
define('zhanzhangbtcdn_name', esc_html( __( '站长帮 - WordPress CDN 管理插件', 'zhanzhangb-tcdn' ) ) );
define('zhanzhangbtcdn_ver', ' v1.3.1' );
define('zhanzhangbtcdn_FILE', __FILE__);
define('zhanzhangbtcdn_DIR', __DIR__);
require_once zhanzhangbtcdn_DIR. '/options.php';
require_once zhanzhangbtcdn_DIR . '/refresh-url.php';