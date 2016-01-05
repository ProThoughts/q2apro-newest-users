====================================
Question2Answer Newest Users v0.3
====================================
-----------
Description
-----------
This is a plugin for **Question2Answer** that displays the newest users of the last x days on a separate page

--------
Features
--------
- provides a page for showing newest users of last x days, access-URL ``your-q2a-installation.com/newusers``
- page lists user registration, username, user's website (helps to find spam), email, and email confirmed
- page can be blocked from public, see qa-new-users-page.php and uncomment after '// return if not admin'

------------
Installation
------------
#. Install Question2Answer_
#. Get the source code for this plugin directly from github_
#. Extract the files.
#. Change language strings in file **qa-newest-users-lang.php**
#. Optional: Change settings in file qa-newest-users-page.php ($lastdays, $maxusers)
#. Upload the files to a subfolder called ``newest-users-page`` inside the ``qa-plugins`` folder of your Q2A installation.
#. Navigate to your site, go to **Admin -> Plugins** on your q2a install. Check if plugin "Newest Users Page" is listed.
#. Navigate to yourq2asite.com/newusers to see the new users listed

.. _Question2Answer: http://www.question2answer.org/install.php
.. _github: https://github.com/echteinfachtv/q2a-newest-users

----------
Disclaimer
----------
This is **beta** code. It is probably okay for production environments, but may not work exactly as expected. You bear the risk. Refunds will not be given!

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
See the GNU General Public License for more details.

-------
Copyright
-------
All code herein is OpenSource_. Feel free to build upon it and share with the world.

.. _OpenSource: http://www.gnu.org/licenses/gpl.html

---------
About q2a
---------
Question2Answer is a free and open source platform for Q&A sites. For more information, visit: www.question2answer.org

---------
Final Note
---------
If you use the plugin:
+ Consider joining the Question2Answer-Forum_, answer some questions or write your own plugin!
+ You can use the code of this plugin to learn more about q2a-plugins. It is commented code.
+ Thanks!

.. _Question2Answer-Forum: http://www.question2answer.org/qa/

