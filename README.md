# README #

The database linked checkbox field is an enhanced version of the current checkbox field that allows the individual values in the checkboxes to show as hyperlinks when the record is displayed. Clicking the hyperlinks will display a filtered search result based on the checkbox value.

block_databasetags, filter_databasetagcloud, datafield_linkedcheckbox and datafield_tag were created specifically for a resource database which can be seen at http://practicelearning.info/course/view.php?id=10. It was commissioned and funded by Focused on Learning, and coded and maintained by Andrew Hancox. We are certain this will be of use to others so we are contributing this development back in to the Moodle community.

### How do I get set up? ###

Place the files into mod/data/field/linkedcheckbox and run notifications.

Due to limitations in the database activity you will need to run the installhacks script which copies an image and language string into the core mod_data code. You can do this by typing:

php mod/data/field/linkedcheckbox/cli/installhacks.php

at the command line.

One the plugin is installed if you go to MOODLESITEROOT/mod/data/field/linkedcheckbox/migrate/migrate.php you will be able to choose checkbox database fields that you wish to migrate over.
