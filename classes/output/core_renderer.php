<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace theme_boost_training\output;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_boost_training
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * @return string
     */
    public function favicon() {
        return $this->page->theme->setting_file_url('favicon', 'favicon');
    }

    /**
     * @return bool
     */
    public function should_display_navbar_logo1() {
        if (get_config('theme_boost_training', 'logo1')) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function get_logo_url1() {
        $imageurl = $this->page->theme->setting_file_url('logo1', 'logo1');
        if (!empty($imageurl)) {
            return $imageurl;
        }
        return '';
    }

    /**
     * @return bool
     */
    public function should_display_navbar_logo2() {
        if (get_config('theme_boost_training', 'logo2')) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function get_logo_url2() {
        $imageurl = $this->page->theme->setting_file_url('logo2', 'logo2');
        if (!empty($imageurl)) {
            return $imageurl;
        }
        return '';
    }

    /**
     * @return bool|string
     */
    public function user_flat_menu() {
        global $CFG, $USER, $OUTPUT;

        if (!isset($USER->id) || !$USER->id) {
            return false;
        }

        $picture = $OUTPUT->user_picture($USER, array('size' => 65));
        $fullname = fullname($USER);

        return "
         <div class=\"user_flat_menu\" >
             <div class=\"user_picture\">
                 {$picture}
             </div>
             <div class=\"icones-right\">
                 <span class=\"bem-vindo\">" . get_string('welcome', 'theme_boost_training') . "</span><br>
                 <span>{$fullname}</span><br>
                 <a href=\"{$CFG->wwwroot}/user/profile.php?id={$USER->id}\" class=\"icones\"
                    ><i class=\"material-icons\" title=\"" . get_string('profile') . "\">account_box</i></a>
                 <a href=\"{$CFG->wwwroot}/grade/report/overview/\" class=\"icones\"
                    ><i class=\"material-icons\" title=\"" . get_string('grades', 'grades') . "\">assignment</i></a>
                 <a href=\"{$CFG->wwwroot}/user/preferences.php\" class=\"icones\"
                    ><i class=\"material-icons\" title=\"" . get_string('preferences', 'moodle') . "\">settings</i></a>
                 <a href=\"{$CFG->wwwroot}/login/logout.php?sesskey=" . sesskey() . "\" class=\"icones\"
                    ><i class=\"material-icons\" title=\"" . get_string('logout') . "\">exit_to_app</i></a>
             </div>
         </div>";
    }

    /**
     * @return string
     */
    public function get_icons_footer() {
        $returnicones = '';

        foreach ($this->page->theme->settings as $iconname => $setting) {
            if (strpos($iconname, 'icon_') === 0) {
                if (!empty($setting)) {

                    $icon = str_replace('icon_', '', $iconname);

                    if ($icon == 'website') {
                        $returnicones .= '<a target="_blank" href="' . $setting . '"><span
                                             class="footer-icon ' . $icon . '"><i class="material-icons">pages</i></span></a>';
                    } else {
                        $returnicones .= '<a target="_blank" href="' . $setting . '"><span
                                             class="footer-icon ' . $icon . '"><i class="fa fa-' . $icon . '"></i></span></a>';
                    }
                }
            }
        }

        return "<div class=\"icones\">$returnicones</div>";
    }
}
