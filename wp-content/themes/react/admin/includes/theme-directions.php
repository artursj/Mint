<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="react-theme-directions">

	<h2>Layout structure <span class="react-header-note"> // The backbone of your theme</span></h2>

	<p>React has been built with function and versatility in mind, starting with the layout structure. Here you will learn about the different sections and the terminology used within the theme.</p>

	<p>To better acquaint yourself with each part of the theme, please check the image below and read each section for more information. If you need further help you can check our
	<a href="http://support.themecatcher.net/react-wordpress" class="react-external-link">online documentation</a> or ask us a question on <a href="http://support.themecatcher.net/forums/forum/react-wordpress-theme" class="react-external-link">the forums</a>.</p>

	<div class="react-break"></div>
	<h3>Main sections</h3>
	<p>The structure has 4 main blocks with subsections, some of which can be switched on or off completely, or for only the devices of your choice. Items with an asterisk (*) in the list below can be switched on or off:</p>

	<div class="react-clearfix">
		<div class="react-seven react-columns">
			<img src="<?php echo esc_url(react_admin_url('images/over-view-sketch.png')); ?>" alt="over-view-sketch" width="473" height="436" class="alignleft size-full wp-image-10318" />
		</div>
		<div class="react-five react-columns">
			<br>
			<ul>
				<li>
					<strong>Pop Down *</strong>
					<ul>
						<li>Pop Down widget area</li>
						<li>Pop Down trigger</li>
					</ul>
				</li>
				<li>
					<strong>Header</strong>
					<ul>
						<li>Top header *</li>
						<li>Main header</li>
						<li>Solo navigation *</li>
					</ul>
				</li>
				<li>
					<strong>Content</strong>
					<ul>
						<li>Intro *</li>
						<li>Content area</li>
					</ul>
				</li>
				<li>
					<strong>Footer</strong>
					<ul>
						<li>Main footer widget area *</li>
						<li>Subfooter *</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>

	<div class="react-break"></div>

	<div class="react-clearfix react-directions-row">
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-popdownt-selected.png')); ?>" alt="layout-popdown-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Pop Down</h3>
					<h5>Widget area / Component</h5>
					<p>A dynamic component that can be toggled from hidden to visible, or visible to hidden, via a trigger message at the very top of the page. The Pop Down uses cookies so the user only needs to see this message once. There is also an option for the user to dismiss the trigger message. The Pop Down space is a widget area so you can build in various content via shortcodes and widgets. </p>
				</div>
			</div>
		</div>
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-tophead-selected.png')); ?>" alt="layout-tophead-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Top Head</h3>
					<h5>Section / Navigation area</h5>
					<p>The first of the header sections. It can be utilized for various functions, like contact details (with form popups), social links, a navigation menu and more. It can also be set to 3 sizes depending on its usage.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="react-break"></div>

	<div class="react-clearfix react-directions-row">
		<div class="react-six react-columns">
			<div class="react-five react-columns">
				<img src="<?php echo esc_url(react_admin_url('images/layout-mainhead-selected.png')); ?>" alt="layout-mainhead-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
			</div>
			<div class="react-seven react-columns">
				<h3>Main Header</h3>
				<h5>Section / Pimary navigation</h5>
				<p>The second header section is comprised of your logo (which can be set to left or right) and a main navigation area with a home icon. It also holds the Info Menu (more info below).</p>

				<div class="react-accordion react-toggle">
					<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Info Menu', 'react'); ?></div>
					<div class="react-accordion-content">
						<p>This is an icon based clickable menu where you can build in various dynamic content via shortcodes and widgets or via our preset options, such as forms, search bar, location map, video and more. The content section can be displayed in two ways: "Pop Out" or "Slide Down". This gives it various content usage depending on the function you choose.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-solonav-selected.png')); ?>" alt="layout-solonav-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Solo Navigation</h3>
					<h5>Section / Primary navigation</h5>
					<p>This is the last header section. It can be used only for site navigation purposes, hence its name. It can hold a primary or secondary navigation area and a search bar.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="react-break"></div>

	<div class="react-clearfix react-directions-row">
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-content-selected.png')); ?>" alt="layout-content-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Content</h3>
					<p>The main content area for the theme:</p>

					<div class="react-accordion react-toggle">
						<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Intro', 'react'); ?></div>
						<div class="react-accordion-content">
							<p>The first of the content area sections, the Intro starts the page with a heading and subheading. You may be familiar with this section if you have used WordPress before.</p>
						</div>

						<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Breadcrumbs', 'react'); ?></div>
						<div class="react-accordion-content">
							<p>Allow the user to back track their steps by using the breadcrumbs plugin. It's at the top of the page content but can also be used as a widget.</p>
						</div>

						<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Sidebar widget area', 'react'); ?></div>
						<div class="react-accordion-content">
							<p>WordPress default widget area, which is to the side of the page content area. It can be switched on or off and placed left or right using the per page (metabox) options.</p>
						</div>

						<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('After content widget area', 'react'); ?></div>
						<div class="react-accordion-content">
							<p>A handy widget area after the page content.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-slider-selected.png')); ?>" alt="layout-slider-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Slider Area</h3>
					<h5>Slider Revolution</h5>
					<p>If in use, it can hold a Slider Revolution or LayerSlider of your choice.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="react-break"></div>

	<div class="react-clearfix react-directions-row">
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-footmain-selected.png')); ?>" alt="layout-footmain-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Main Footer</h3>
					<h5>Widget area</h5>
					<p>The larger of the two footer areas, this is a widget area allowing you to build in various content via shortcodes and widgets.</p>
				</div>
			</div>
		</div>
		<div class="react-six react-columns">
			<div class="react-clearfix">
				<div class="react-five react-columns">
					<img src="<?php echo esc_url(react_admin_url('images/layout-subfoot-selected.png')); ?>" alt="layout-subfoot-selected" width="164" height="224" class="alignnone size-full wp-image-10307" />
				</div>
				<div class="react-seven react-columns">
					<h3>Sub Footer</h3>
					<h5>Section</h5>
					<p>The last area in the footer section and the last of the page too. It has many uses and variations in function. It can hold a logo, a Pop Out Box when user reaches the end of the page, social icons, background video / audio / image controls and more.</p>
				</div>
			</div>
		</div>
	</div>

</div>
