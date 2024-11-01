<?php
class ZhanzhangbTCDNSettings {

    const SETTINGS_GROUP = 'zhanzhangb_tcdn_settings_group';
    const SETTINGS_PAGE = 'zhanzhangb_tcdn_settings_page';
    const SETTINGS_NAME = 'zhanzhangb_tcdn_settings';

    public function __construct() {
        register_activation_hook( zhanzhangbtcdn_FILE, array($this, 'zhanzhangb_tcdn_install') );
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    public function zhanzhangb_tcdn_install() {
        $settings = get_option(self::SETTINGS_NAME, array());
        $default_settings = array(
            'secret_id' => '',
            'secret_key' => '',
            'license_key' => '',
            'article_url_option' => 'only_refresh',
            'home_url_option' => 'no_refresh',
            'category_url_option' => 'no_refresh',
            'tag_url_option' => 'no_refresh',
            'cdn_provider' => 'CDN',
        );
        update_option(self::SETTINGS_NAME, wp_parse_args($settings, $default_settings));
        update_option('ztc_is_activated', get_option('ztc_is_activated', 'false'));
    }

    public function add_plugin_page() {
        add_menu_page(
            zhanzhangbtcdn_name,
            zhanzhangbtcdn_name,
            'manage_options',
            self::SETTINGS_PAGE,
            array($this, 'create_admin_page')
        );
    }

    public function create_admin_page() {
        ?>
        <div class="wrap">
            <h2><?php echo zhanzhangbtcdn_name . ' ' . zhanzhangbtcdn_ver; ?></h2>
			<p style="font-size: 1.35em;">相关链接：<a href="https://www.zhanzhangb.cn/wordpress-cdn-plugins" target="_blank" style="font-weight: bold; color: #0033FF;">免费获取许可证、帮助文档</a>。</p>
            <form method="post" action="options.php">
                <?php
                settings_fields(self::SETTINGS_GROUP);
                do_settings_sections(self::SETTINGS_PAGE);
                submit_button();
                ?>
            </form>
        </div>
		<div class="ad"><p style="font-size: 1.35em;">数百款 WordPress 精品主题与插件尽在：<a href="https://www.zhanzhangb.com/" target="_blank" style="font-weight: bold; color: #0033FF;">站长帮资源站 - VIP 年会员低至 9.9 元/月</a>。</p></div>
        <?php
    }

    public function page_init() {
        register_setting(self::SETTINGS_GROUP, self::SETTINGS_NAME, array($this, 'sanitize'));

        add_settings_section(
            'zhanzhangb_tcdn_general',
            '基本设置',
            array($this, 'print_section_info'),
            self::SETTINGS_PAGE
        );

        $this->add_settings_field('secret_id', '腾讯云SecretId', 'text');
        $this->add_settings_field('secret_key', '腾讯云SecretKey', 'text');
        $this->add_settings_field('license_key', '插件许可证', 'license_key');
        $this->add_settings_field('article_url_option', '文章URL选项', 'select', array('only_refresh' => '仅刷新', 'refresh_and_preload' => '刷新并预加载'));
        $this->add_settings_field('home_url_option', '首页URL选项', 'select', array('no_refresh' => '不刷新', 'only_refresh' => '仅刷新', 'refresh_and_preload' => '刷新并预加载'));
        $this->add_settings_field('category_url_option', '分类页URL选项', 'select', array('no_refresh' => '不刷新', 'only_refresh' => '仅刷新', 'refresh_and_preload' => '刷新并预加载'));
        $this->add_settings_field('tag_url_option', '标签页URL选项', 'select', array('no_refresh' => '不刷新', 'only_refresh' => '仅刷新', 'refresh_and_preload' => '刷新并预加载'));
        $this->add_settings_field('cdn_provider', 'CDN服务商', 'select', array('CDN' => '腾讯云CDN'));
    }

    public function print_section_info() {
        echo '<p><a href="https://cloud.tencent.com/act/cps/redirect?redirect=10502&cps_key=e6df27c5d163b8bf332c7ed3a82a0a13" target="_blank">折扣价购买腾讯云 CDN 流量包</a></p>';
		echo '<p>点这里<a href="https://console.cloud.tencent.com/cam/capi" target="_blank">获取/查看腾讯云 SecretId 与 SecretKey</a>。</p>';
    }

    public function sanitize($input) {
        $sanitized_input = array();

        $sanitized_input['secret_id'] = isset($input['secret_id']) ? substr($input['secret_id'], 0, 36) : '';
        $sanitized_input['secret_key'] = isset($input['secret_key']) ? substr($input['secret_key'], 0, 36) : '';
        $sanitized_input['license_key'] = isset($input['license_key']) ? substr($input['license_key'], 0, 18) : '';

        $options = array('only_refresh', 'refresh_and_preload', 'no_refresh');
        $sanitized_input['article_url_option'] = in_array($input['article_url_option'], $options) ? $input['article_url_option'] : 'only_refresh';
        $sanitized_input['home_url_option'] = in_array($input['home_url_option'], $options) ? $input['home_url_option'] : 'no_refresh';
        $sanitized_input['category_url_option'] = in_array($input['category_url_option'], $options) ? $input['category_url_option'] : 'no_refresh';
        $sanitized_input['tag_url_option'] = in_array($input['tag_url_option'], $options) ? $input['tag_url_option'] : 'no_refresh';
        $sanitized_input['cdn_provider'] = in_array($input['cdn_provider'], array('CDN', 'EdgeOne')) ? $input['cdn_provider'] : 'CDN';

        return $sanitized_input;
    }

    private function add_settings_field($id, $label, $type, $options = array()) {
        add_settings_field(
            $id,
            $label,
            array($this, "{$type}_callback"),
            self::SETTINGS_PAGE,
            'zhanzhangb_tcdn_general',
            array('id' => $id, 'type' => $type, 'label' => $label, 'options' => $options)
        );
    }
    public function zhanzhangb_tcdn_zhandle() {
        $settings = get_option(self::SETTINGS_NAME);
		$encodedString = 'd3d3LnpoYW56aGFuZ2IuY29t';
		$sk = base64_decode($encodedString);
        $ztc_is_activated = get_option('ztc_is_activated');
        if ($ztc_is_activated !== 'true') {
            if ($settings['license_key'] == $sk) {
                update_option('ztc_is_activated', zhanzhangbtcdn_ver);
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    public function text_callback($args) {
        $settings = get_option(self::SETTINGS_NAME);
        echo "<input type='text' name='zhanzhangb_tcdn_settings[{$args['id']}]' value='{$settings[$args['id']]}' />";
    }

    public function select_callback($args) {
        $settings = get_option(self::SETTINGS_NAME);
        $selected = $settings[$args['id']];
        $options = $args['options'];

        echo "<select name='zhanzhangb_tcdn_settings[{$args['id']}]' " . ($this->zhanzhangb_tcdn_zhandle() ? '' : 'disabled') . ">";
        foreach ($options as $value => $label) {
            echo "<option value='{$value}' " . selected($selected, $value, false) . ">{$label}</option>";
        }
        echo "</select>";
    }

    public function license_key_callback($args) {
        $settings = get_option(self::SETTINGS_NAME);
        if ($this->zhanzhangb_tcdn_zhandle()) {
            echo "<input type='password' name='zhanzhangb_tcdn_settings[{$args['id']}]' value='{$settings[$args['id']]}' readonly />" . " <span style='color: green;'>专业版已激活</span>";
        } else {
            echo "<input type='text' name='zhanzhangb_tcdn_settings[{$args['id']}]' value='{$settings[$args['id']]}' />" . " <span style='color: red;'>许可证未输入或错误！<a href='https://www.zhanzhangb.cn/wordpress-cdn-plugins' target='_blank' style='font-weight: bold;'>免费获取许可证</a></span>";
        }
    }
}

if (is_admin()) {
    $zhanzhangb_tcdn_settings = new ZhanzhangbTCDNSettings();
}
?>