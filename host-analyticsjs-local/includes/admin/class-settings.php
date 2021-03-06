<?php
/* * * * * * * * * * * * * * * * * * * *
 *  ██████╗ █████╗  ██████╗ ███████╗
 * ██╔════╝██╔══██╗██╔═══██╗██╔════╝
 * ██║     ███████║██║   ██║███████╗
 * ██║     ██╔══██║██║   ██║╚════██║
 * ╚██████╗██║  ██║╚██████╔╝███████║
 *  ╚═════╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝
 *
 * @author   : Daan van den Bergh
 * @url      : https://daan.dev/wordpress-plugins/caos/
 * @copyright: (c) 2021 Daan van den Bergh
 * @license  : GPL2v2 or later
 * * * * * * * * * * * * * * * * * * * */

defined('ABSPATH') || exit;

class CAOS_Admin_Settings extends CAOS_Admin
{
    const CAOS_ADMIN_PAGE = 'host_analyticsjs_local';
    const CAOS_NEWS_REEL  = 'caos_news_reel';

    /**
     * Admin Sections
     */
    const CAOS_ADMIN_SECTION_BASIC_SETTINGS = 'caos-basic-settings';
    const CAOS_ADMIN_SECTION_ADV_SETTINGS   = 'caos-advanced-settings';
    const CAOS_ADMIN_SECTION_EXT_SETTINGS   = 'caos-extensions-settings';
    const CAOS_ADMIN_SECTION_HELP           = 'caos-help';

    /**
     * Option Values
     */
    const CAOS_ADMIN_ALLOW_TRACKING_OPTIONS  = [
        ''                  => 'Always (default)',
        'cookie_is_set'     => 'When cookie is set',
        'cookie_is_not_set' => 'When cookie is NOT set',
        'cookie_has_value'  => 'When cookie has a value (exact match)',
        'cookie_value_contains' => 'When cookie value contains (loose comparison)'
    ];
    const CAOS_ADMIN_SNIPPET_TYPE_OPTIONS    = [
        ''        => 'Default',
        'async'   => 'Asynchronous',
        'minimal' => 'Minimal Analytics (fastest)'
    ];
    const CAOS_ADMIN_SCRIPT_POSITION_OPTIONS = [
        'header' => 'Header (default)',
        'footer' => 'Footer',
        'manual' => 'Add manually',
    ];
    const CAOS_ADMIN_JS_FILE_OPTIONS         = [
        'analytics.js'  => 'Analytics.js (default)',
        'gtag-v4.js'    => 'Gtag.js (v4 API - Beta)',
        'gtag.js'       => 'Gtag.js'
    ];
    const CAOS_ADMIN_COMPATIBILITY_OPTIONS   = [
        ''                 => 'None (default)',
        'analytify'        => 'GADP for WP by Analytify',
        'exact_metrics'    => 'GAD for WP by ExactMetrics',
        'monster_insights' => 'GA for WP by Monster Insights',
        'rankmath'         => 'RankMath',
        'seopress'         => 'SEOPress',
        'woocommerce'      => 'WooCommerce GA Integration'
    ];
    const CAOS_ADMIN_EXT_PLUGIN_HANDLING     = [
        'set_redirect' => 'Safe Mode (default)',
        'send_file'    => 'Experimental (faster)'
    ];

    /**
     * CAOS Basic/Advanced Settings
     */
    const CAOS_BASIC_SETTING_TRACKING_ID            = 'sgal_tracking_id';
    const CAOS_BASIC_SETTING_TRACK_ADMIN            = 'sgal_track_admin';
    const CAOS_BASIC_SETTING_ALLOW_TRACKING         = 'caos_allow_tracking';
    const CAOS_BASIC_SETTING_COOKIE_NOTICE_NAME     = 'sgal_cookie_notice_name';
    const CAOS_BASIC_SETTING_COOKIE_VALUE           = 'caos_cookie_value';
    const CAOS_BASIC_SETTING_SNIPPET_TYPE           = 'caos_snippet_type';
    const CAOS_BASIC_SETTING_ANONYMIZE_IP           = 'sgal_anonymize_ip';
    const CAOS_BASIC_SETTING_SCRIPT_POSITION        = 'sgal_script_position';
    const CAOS_ADV_SETTING_COMPATIBILITY_MODE       = 'caos_analytics_compatibility_mode';
    const CAOS_ADV_SETTING_JS_FILE                  = 'caos_analytics_js_file';
    const CAOS_ADV_SETTING_COOKIELESS_ANALYTICS     = 'caos_cookieless_analytics';
    const CAOS_ADV_SETTING_CACHE_DIR                = 'caos_analytics_cache_dir';
    const CAOS_ADV_SETTING_CDN_URL                  = 'caos_analytics_cdn_url';
    const CAOS_ADV_SETTING_GA_COOKIE_EXPIRY_DAYS    = 'sgal_ga_cookie_expiry_days';
    const CAOS_ADV_SETTING_SITE_SPEED_SAMPLE_RATE   = 'caos_site_speed_sample_rate';
    const CAOS_ADV_SETTING_ENQUEUE_ORDER            = 'sgal_enqueue_order';
    const CAOS_ADV_SETTING_DISABLE_DISPLAY_FEATURES = 'caos_disable_display_features';
    const CAOS_ADV_SETTING_DEBUG_MODE               = 'caos_debug_mode';
    const CAOS_ADV_SETTING_UNINSTALL_SETTINGS       = 'caos_analytics_uninstall_settings';
    const CAOS_EXT_SETTING_PLUGIN_HANDLING          = 'caos_extension_plugin_handling';
    const CAOS_EXT_SETTING_STEALTH_MODE             = 'caos_stealth_mode';
    const CAOS_EXT_SETTING_ADJUSTED_BOUNCE_RATE     = 'sgal_adjusted_bounce_rate';
    const CAOS_EXT_SETTING_TRACK_AD_BLOCKERS        = 'caos_extension_track_ad_blockers';
    const CAOS_EXT_SETTING_LINKID                   = 'caos_extension_linkid';
    const CAOS_EXT_SETTING_OPTIMIZE                 = 'caos_extension_optimize';
    const CAOS_EXT_SETTING_OPTIMIZE_ID              = 'caos_extension_optimize_id';
    const CAOS_EXT_SETTING_CAPTURE_OUTBOUND_LINKS   = 'caos_capture_outbound_links';
    const CAOS_CRON_RUN_UPDATE                      = 'caos_cron_run_update';
    const CAOS_CRON_FILE_ALIASES                    = 'caos_cron_file_aliases';

    /**
     * Info URLs
     */
    const FFW_PRESS_WORDPRESS_PLUGINS_SUPER_STEALTH  = 'https://ffw.press/wordpress/caos-super-stealth-upgrade/';
    const CAOS_ADMIN_SETTINGS_EXTENSIONS_TAB_URI     = 'options-general.php?page=host_analyticsjs_local&tab=caos-extensions-settings';
    const CAOS_SETTINGS_UTM_PARAMS_SUPPORT_TAB       = '?utm_source=caos&utm_medium=plugin&utm_campaign=support_tab';

    /** @var string $active_tab */
    private $active_tab;

    /** @var string $page */
    private $page;

    /** @var string $plugin_text_domain */
    private $plugin_text_domain = 'host-analyticsjs-local';

    /**
     * CAOS_Admin_Settings constructor.
     */
    public function __construct()
    {
        $this->active_tab = isset($_GET['tab']) ? $_GET['tab'] : self::CAOS_ADMIN_SECTION_BASIC_SETTINGS;
        $this->page       = isset($_GET['page']) ? $_GET['page'] : '';

        parent::__construct();

        // Global
        add_action('admin_menu', [$this, 'create_menu']);
        add_filter('plugin_action_links_' . plugin_basename(CAOS_PLUGIN_FILE), [$this, 'settings_link']);

        if ($this->page !== self::CAOS_ADMIN_PAGE) {
            return;
        }

        // Scripts
        add_action('admin_head', [$this, 'enqueue_admin_assets']);

        // Footer Text
        add_filter('admin_footer_text', [$this, 'footer_text_left']);
        add_filter('update_footer', [$this, 'footer_text_right'], 11);

        // Tabs
        add_action('caos_settings_tab', [$this, 'do_basic_settings_tab'], 1);

        if (CAOS_OPT_SNIPPET_TYPE != 'minimal') {
            add_action('caos_settings_tab', [$this, 'do_advanced_settings_tab'], 2);
        }

        add_action('caos_settings_tab', [$this, 'do_extensions_tab'], 3);
        add_action('caos_settings_tab', [$this, 'do_help_tab'], 4);

        // Settings Screen Content
        add_action('caos_settings_content', [$this, 'do_content'], 1);

        $this->do_cron_check();
    }

    /**
     * Create WP menu-item
     */
    public function create_menu()
    {
        add_options_page(
            'CAOS',
            'Optimize Google Analytics',
            'manage_options',
            self::CAOS_ADMIN_PAGE,
            [$this, 'settings_page']
        );

        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Create settings page
     */
    public function settings_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__("You're not cool enough to access this page.", $this->plugin_text_domain));
        } ?>

        <div class="wrap">
            <h1><?php _e('CAOS | Complete Analytics Optimization Suite', $this->plugin_text_domain); ?></h1>

            <?php if (CAOS_OPT_SNIPPET_TYPE != 'minimal') : ?>
                <div class="notice notice-info">
                    <p><?= sprintf(__('<strong>%s</strong> is renamed to <strong>%s</strong> and was last updated on <em>%s</em>. The next automatic update by cron is scheduled on <em>%s</em>.', $this->plugin_text_domain), ucfirst(CAOS_OPT_REMOTE_JS_FILE), CAOS::get_file_alias(str_replace('.js', '', CAOS_OPT_REMOTE_JS_FILE)), $this->file_last_updated(), $this->cron_next_scheduled()); ?></p>
                </div>
            <?php endif; ?>

            <h2 class="caos-nav nav-tab-wrapper">
                <?php do_action('caos_settings_tab'); ?>
            </h2>

            <form method="post" action="options.php?tab=<?= $this->active_tab; ?>">
                <?php
                settings_fields($this->active_tab);
                do_settings_sections($this->active_tab); ?>

                <?php do_action('caos_settings_content'); ?>

                <?php
                $current_section = str_replace('-', '_', $this->active_tab);
                do_action("after_$current_section"); ?>

                <?php if ($this->active_tab !== CAOS_Admin_Settings::CAOS_ADMIN_SECTION_HELP) : ?>
                    <?php submit_button(__('Save Changes & Update', $this->plugin_text_domain), 'primary', 'submit', false); ?>
                <?php endif; ?>
            </form>
        </div>
    <?php
    }

    /**
     * Register all settings.
     *
     * @throws ReflectionException
     */
    public function register_settings()
    {
        if (
            $this->active_tab !== self::CAOS_ADMIN_SECTION_BASIC_SETTINGS
            && $this->active_tab !== self::CAOS_ADMIN_SECTION_ADV_SETTINGS
            && $this->active_tab !== self::CAOS_ADMIN_SECTION_EXT_SETTINGS
            && $this->active_tab !== self::CAOS_ADMIN_SECTION_HELP
        ) {
            $this->active_tab = self::CAOS_ADMIN_SECTION_BASIC_SETTINGS;
        }

        foreach ($this->get_settings() as $constant => $value) {
            register_setting(
                $this->active_tab,
                $value
            );
        }
    }

    /**
     * Format timestamp of analytics.js last updated.
     *
     * @return string
     */
    private function file_last_updated()
    {
        $file_mod_time = filemtime(CAOS::get_file_alias_path(str_replace('.js', '', CAOS_OPT_REMOTE_JS_FILE)));

        return $this->format_time_by_locale($file_mod_time, get_locale());
    }

    /**
     * Get formatted timestamp of next scheduled cronjob.
     *
     * @return string
     */
    private function cron_next_scheduled()
    {
        $next_scheduled = wp_next_scheduled(CAOS_CRON);

        return $this->format_time_by_locale($next_scheduled, get_locale());
    }

    /**
     * Format any UNIX timestamp to a date/time in WP's chosen locale.
     *
     * @param null   $date_time
     * @param string $locale
     *
     * @return string
     */
    private function format_time_by_locale($date_time = null, $locale = 'en_US')
    {
        try {
            $date_object = new DateTime;
            $date_object->setTimestamp($date_time);
        } catch (\Exception $e) {
            return __('Date/Time cannot be set', $this->plugin_text_domain) . ': ' . $e->getMessage();
        }

        $intl_loaded = extension_loaded('intl');

        if (!$intl_loaded) {
            return $date_object->format('Y-m-d H:i:s');
        }

        try {
            $format = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::LONG);
        } catch (\Exception $e) {
            return __('Date/Time cannot be formatted to locale', $this->plugin_text_domain) . ': ' . $e->getMessage();
        }

        return $format->format($date_time);
    }

    /**
     * Get all settings for the current section using the constants in this class.
     *
     * @return array
     * @throws ReflectionException
     */
    public function get_settings()
    {
        $reflection = new ReflectionClass($this);
        $constants  = $reflection->getConstants();
        $needle     = 'CAOS_BASIC_SETTING';

        if ($this->active_tab == self::CAOS_ADMIN_SECTION_ADV_SETTINGS) {
            $needle = 'CAOS_ADV_SETTING';
        }

        if ($this->active_tab == self::CAOS_ADMIN_SECTION_EXT_SETTINGS) {
            $needle = 'CAOS_EXT_SETTING';
        }

        if ($this->active_tab == self::CAOS_ADMIN_SECTION_HELP) {
            $needle = 'CAOS_HELP_SETTING';
        }

        return array_filter(
            $constants,
            function ($key) use ($needle) {
                return strpos($key, $needle) !== false;
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * We add the assets directly to the head to avoid ad blockers blocking the URLs cause they include 'analytics'.
     * 
     * @return void 
     */
    public function enqueue_admin_assets()
    {
        if ($this->page !== self::CAOS_ADMIN_PAGE) {
            return;
        }

        echo '<script>' . file_get_contents(plugin_dir_path(CAOS_PLUGIN_FILE) . 'assets/js/caos-admin.js') . '</script>';
        echo '<style>' . file_get_contents(plugin_dir_path(CAOS_PLUGIN_FILE) . 'assets/css/caos-admin.css') . '</style>';
    }

    /**
     * Add Basic Settings Tab to Settings Screen.
     */
    public function do_basic_settings_tab()
    {
        $this->generate_tab(self::CAOS_ADMIN_SECTION_BASIC_SETTINGS, 'dashicons-analytics', __('Basic Settings', $this->plugin_text_domain));
    }

    /**
     * Add Advanced Settings Tab to Settings Screen.
     */
    public function do_advanced_settings_tab()
    {
        $this->generate_tab(self::CAOS_ADMIN_SECTION_ADV_SETTINGS, 'dashicons-admin-settings', __('Advanced Settings', $this->plugin_text_domain));
    }

    /**
     * Add Connect Tab to Settings Screen.
     */
    public function do_extensions_tab()
    {
        $this->generate_tab(self::CAOS_ADMIN_SECTION_EXT_SETTINGS, 'dashicons-admin-plugins', __('Extensions', $this->plugin_text_domain));
    }

    /**
     * Add Help tab to Settings Screen.
     * 
     * @return void 
     */
    public function do_help_tab()
    {
        $this->generate_tab(self::CAOS_ADMIN_SECTION_HELP, 'dashicons-editor-help', __('Help', $this->plugin_text_domain));
    }

    /**
     * @param      $id
     * @param null $icon
     * @param null $label
     */
    private function generate_tab($id, $icon = null, $label = null)
    {
    ?>
        <a class="nav-tab dashicons-before <?= $icon; ?> <?= $this->active_tab == $id ? 'nav-tab-active' : ''; ?>" href="<?= $this->generate_tab_link($id); ?>">
            <?= $label; ?>
        </a>
<?php
    }

    /**
     * @param $tab
     *
     * @return string
     */
    private function generate_tab_link($tab)
    {
        return admin_url("options-general.php?page=host_analyticsjs_local&tab=$tab");
    }

    /**
     * Render active content.
     */
    public function do_content()
    {
        echo apply_filters(str_replace('-', '_', $this->active_tab) . '_content', '');
    }

    /**
     * Add settings link to plugin overview
     *
     * @param $links
     *
     * @return mixed
     */
    public function settings_link($links)
    {
        $adminUrl     = admin_url() . 'options-general.php?page=host_analyticsjs_local';
        $settingsLink = "<a href='$adminUrl'>" . __('Settings', $this->plugin_text_domain) . '</a>';
        array_push($links, $settingsLink);

        return $links;
    }

    /**
     * Changes footer text.
     * 
     * @return string 
     */
    public function footer_text_left()
    {
        $text = sprintf(__('Coded with %s in The Netherlands @ <strong>FFW.Press</strong>.', $this->plugin_text_domain), '<span class="dashicons dashicons-heart ffwp-heart"></span>');

        return '<span id="footer-thankyou">' . $text . '</span>';
    }


    /**
     * All logic to generate the news reel in the bottom right of the footer on all of OMGF's settings pages.
     * 
     * Includes multiple checks to make sure the reel is only shown if a recent post is available.
     * 
     * @param mixed $text 
     * @return mixed 
     */
    public function footer_text_right($text)
    {
        if (!extension_loaded('simplexml')) {
            return $text;
        }

        /**
         * If a WordPress update is available, show the original text.
         */
        if (strpos($text, 'Get Version') !== false) {
            return $text;
        }

        // Prevents bashing the API.
        $xml = get_transient(self::CAOS_NEWS_REEL);

        if (!$xml) {
            $response = wp_remote_get('https://daan.dev/tag/caos/feed');

            if (!is_wp_error($response)) {
                $xml = wp_remote_retrieve_body($response);

                // Refresh the feed once a day to prevent bashing of the API.
                set_transient(self::CAOS_NEWS_REEL, $xml, DAY_IN_SECONDS);
            }
        }

        if (!$xml) {
            return $text;
        }

        $xml = simplexml_load_string($xml);

        if (!$xml) {
            return $text;
        }

        $items = $xml->channel->item ?? [];

        if (empty($items)) {
            return $text;
        }

        $text = sprintf(__('Recently tagged <a target="_blank" href="%s"><strong>#CAOS</strong></a> on my blog:', $this->plugin_text_domain), 'https://daan.dev/tag/caos') . ' ';
        $text .= '<span id="caos-ticker-wrap">';
        $i    = 0;

        foreach ($items as $item) {
            $hide = $i > 0 ? 'style="display: none;"' : '';
            $text .= "<span class='ticker-item' $hide>" . sprintf('<a target="_blank" href="%s"><em>%s</em></a>', $item->link, $item->title) . '</span>';
            $i++;
        }

        $text .= "</span>";

        return $text;
    }

    /**
     * Checks downloaded file and cron health.
     *
     * @return CAOS_Admin_Functions
     */
    private function do_cron_check()
    {
        return new CAOS_Admin_Functions();
    }

    /**
     * @param $file
     *
     * @return mixed
     */
    private function get_template($file)
    {
        return include CAOS_PLUGIN_DIR . 'templates/admin/block-' . $file . '.php';
    }
}
