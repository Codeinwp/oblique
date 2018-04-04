I.Theme

Oblique, Copyright 2015 
Oblique is licensed under GNU General Public License V2 or later. You can find a copy of it in the license.txt file.

II. Resources

a) Framework
a1) Underscores
Resource URI: http://underscores.me/
Copyright: Automattic, automattic.com
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

a2) Bootstrap
Resource URI: http://getbootstrap.com/
Copyright: 2011-2014 Twitter, Inc
License: MIT
License URI: http://opensource.org/licenses/MIT

b) FontAwesome
Copyright: Fonticons, Inc.
Resource URI: http://fontawesome.io
License: Icons - CC BY 4.0, Fonts - SIL OFL 1.1, Code - MIT License
License URI: https://creativecommons.org/licenses/by/4.0/
License URI: https://scripts.sil.org/OFL
License URI: https://opensource.org/licenses/MIT

c) FitVids
Copyright: Chris Coyier, Paravel
Resource URI: http://fitvidsjs.com/
License: WTFPL
License URI: http://www.wtfpl.net/txt/copying/

d) html5shiv
Copyright: Alexander Farkas, Jonathan Neal, Paul Irish
Resource URI: https://code.google.com/p/html5shiv/
License: MIT/GPLv2
License URI: http://opensource.org/licenses/MIT
License URI: http://www.gnu.org/licenses/gpl-2.0.html

e) imagesLoaded
Copyright: 2014 David DeSandro
Resource URI: http://imagesloaded.desandro.com/
License: MIT
License URI: http://opensource.org/licenses/MIT

f) Slicknav
Copyright: Josh Cope
Resource URI: https://github.com/ComputerWolf/SlickNav
License: MIT
License URI: http://opensource.org/licenses/MIT

g) jQuery Parallax
Copyright: Ian Lunn
Resource URI: http://www.ianlunn.co.uk/plugins/jquery-parallax/
License: MIT/GPL
License URI: http://opensource.org/licenses/MIT
License URI: http://www.gnu.org/licenses/gpl-2.0.html

h) Screenshot
The header image from the screenshot is also bundled and can be found in the images folder.

Copyright: LYNESTYLEMAKEOVER
Resource URI: http://pixabay.com/en/glamour-style-hat-woman-portrait-678834/
License: CC0 1.0
License URI: http://creativecommons.org/publicdomain/zero/1.0/deed.en

Copyright: jwhphotog
Resource URI: http://pixabay.com/en/studio-portrait-woman-face-model-660806/
License: CC0 1.0
License URI: http://creativecommons.org/publicdomain/zero/1.0/deed.en

Copyright: Nissor
Resource URI: http://pixabay.com/en/model-fashion-glamour-girl-female-600238/
License: CC0 1.0
License URI: http://creativecommons.org/publicdomain/zero/1.0/deed.en

Copyright: jill111
Resource URI: http://pixabay.com/en/vintage-woman-on-bed-retro-bedroom-635262/
License: CC0 1.0
License URI: http://creativecommons.org/publicdomain/zero/1.0/deed.en

III. Hooks and Filters

HOOKS

oblique_nav_container
-replacing the svg container located under the top-bar container
-header.php

oblique_footer_svg
-replacing the svg container located within the footer
-footer.php

oblique_posts_navigation
-displaying custom posts navigation
-index.php
-archive.php
-search.php

oblique_post_entry_content_bottom
-placing new function for customizing read more link
-content.php

oblique_link_to_single
removing the old code for read more link and leave empty instead
-content.php

oblique_post_bottom_svg
-changing the post bottom svg
-content.php

oblique_arhive_title_top_svg
-changing archive title top svg
-archive.php

oblique_archive_title_bottom_svg
-changing archive title bottom svg
-acrhive.php

oblique_single_post_bottom_svg
-changing single post bottom svg
-content-page.php

oblique_single_post_navigation
-changing the post navigation on single
-single.php

oblique_single_page_post_svg
-changing post bototm svg on single page
-content-single.php

oblique_comments_title
-changing comments title
-comments.php

oblique_comments_list
-changing comments list
-comments.php

oblique_single_sidebar
-showing right sidebar
-single.php

oblique_search_before_title
-adding title top svg
-search.php

oblique_search_after_title
-adding title bototm svg
-search.php

oblique_nav_search
-adding search icon on main nav
-header.php

FILTERS

oblique_post_read_more
-changin the post read more text
-functions.php

oblique_body_text_color
-replace body text color
-/inc/customizer.php
-/inc/styles.php

oblique_primary_color
-replace default primary color
-/inc/customizer.php
-/inc/styles.php

oblique_site_title_color
-replace site title color
-/inc/customizer.php
-/inc/styles.php

oblique_site_desc_color
-replace site desc color
-/inc/customizer.php
-/inc/styles.php

oblique_entry_titles_color
-replace entry titles color
-/inc/customizer.php
-/inc/styles.php

oblique_entry_meta_color
-replace entry meta color
-/inc/customizer.php
-/inc/styles.php

oblique_menu_icon_color
-replace menu icon color
-/inc/customizer.php
-/inc/styles.php

oblique_footer_background_color
-replace footer background color
-/inc/customizer.php
-/inc/styles.php

oblique_social_color
-replace social color
-/inc/customizer.php
-/inc/styles.php

oblique_comments_args
-replace comment_form parameters
-comments.php

oblique_post_tags_message
-replace post tags message
-template-tags.php

oblique_main_classes
-adding other classes to main
-single.php
