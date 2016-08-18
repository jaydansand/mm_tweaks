CONTENTS OF THIS FILE
---------------------

  * Introduction
  * Restrictions
  * Installation
  * Configuration
  * Future Development
  * Maintainers


INTRODUCTION
------------
Monster Menus Panels Bridge allows a Monster Menus "page" to be panelized
(via the Panels Module) similarly to panelized nodes.

RESTRICTIONS
------------
Currently, a user may only interact with a Monster Menus page through the
Panels IPE.

INSTALLATION
------------
Monster Menus Panels can be installed similar to other contributed Drupal
modules.

  1) Place all contents of the "mm_panels" folder in your module's directory.
  2) Navigate to 'admin/build/modules'.
  3) Check the box next to "Monster Menus Panels" under the category "Monster
	Menus Tweaks".

CONFIGURATION
-------------
Users with the "Administer all Monster Menus menus" permission will have a new
option called "create_panel" on each page's MM settings form under the flag
section.  Activating this flag on a page allows users with both the "Use the
Panels In-Place Editor" Drupal permission and the "Delete/Change settings" MM
permission (for that page) to see the Panels IPE controls while on that page's
content view.

FUTURE DEVELOPMENT
------------------
There are a couple "to do" items documented in the mm_panels.module file.  These 
items in no way prevent a user from using this module.  The additional items
simply provide additional configuration options.

1) Add a configuration page for which roles are allow to add certain types of
  content to a panelized page.  For example a user with the role "www_core" can
  add a view to a panelized page, but not a widget.

2) Add a configuration page for the default layout that is initially applied to
  a panelized page.  Currently, a one column layout is applied.

MAINTAINERS
-----------
- nackersa (Drew Nackers)
- jay.dansand (Jay Dansand)
