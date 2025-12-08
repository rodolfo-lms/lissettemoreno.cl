<?php
namespace TPCAddons;

defined('ABSPATH') || exit;

if (!class_exists('Corpix_Global_Variables')) {
    /**
     * Corpix Global Variables
     *
     *
     * @category Class
     * @package corpix\core\class
     * @author Pixelcurve <help.pixelcurve@gmail.com>
     * @since 1.0.0
     */
    class Corpix_Global_Variables
    {
        protected static $primary_color;
        protected static $secondary_color;
        protected static $tertiary_color;
        protected static $h_font_color;
        protected static $main_font_color;
	    protected static $btn_color_idle;
	    protected static $btn_color_hover;

        function __construct()
        {
            if (class_exists('\Corpix_Theme_Helper')) {
                $this->set_variables();
            }
        }

        protected function set_variables()
        {
            self::$primary_color = esc_attr(\Corpix_Theme_Helper::get_option('theme-primary-color'));
            self::$secondary_color = esc_attr(\Corpix_Theme_Helper::get_option('theme-secondary-color'));
            self::$tertiary_color = esc_attr(\Corpix_Theme_Helper::get_option('theme-tertiary-color'));
            self::$h_font_color = esc_attr(\Corpix_Theme_Helper::get_option('header-font')['color'] ?? null);
            self::$main_font_color = esc_attr(\Corpix_Theme_Helper::get_option('main-font')['color'] ?? null);
	        self::$btn_color_idle = esc_attr(\Corpix_Theme_Helper::get_option('button-color-idle'));
	        self::$btn_color_hover = esc_attr(\Corpix_Theme_Helper::get_option('button-color-hover'));
        }

        public static function get_primary_color()
        {
            return self::$primary_color;
        }

        public static function get_secondary_color()
        {
            return self::$secondary_color;
        }

        public static function get_tertiary_color()
        {
            return self::$tertiary_color;
        }

        public static function get_h_font_color()
        {
            return self::$h_font_color;
        }

        public static function get_main_font_color()
        {
            return self::$main_font_color;
        }

	    public static function get_btn_color_idle()
	    {
		    return self::$btn_color_idle;
	    }

	    public static function get_btn_color_hover()
	    {
		    return self::$btn_color_hover;
	    }
    }

    new Corpix_Global_Variables();
}
