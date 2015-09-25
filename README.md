# README #

### How do I get set up? ###

Place the files into mod/data/field/linkedcheckbox and run notifications.

Due to limitations in the database activity you will need to run the installhacks script which copies an image and language string into the core mod_data code. You can do this by typing:

php mod/data/field/linkedcheckbox/cli/installhacks.php

at the command line.

One the plugin is installed if you go to MOODLESITEROOT/mod/data/field/linkedcheckbox/migrate/migrate.php you will be able to choose checkbox database fields that you wish to migrate over.

Once the plugin is installed you can add the block to any course/activity page, use the block configuration to pick the database activity and fields to include in the tag cloud.