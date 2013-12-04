CONTENTS OF THIS FILE
---------------------

  * Introduction
  * Restrictions
  * Installation
  * Configuration
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

MAINTAINERS
-----------
- nackersa (Drew Nackers)
- jay.dansand (Jay Dansand)