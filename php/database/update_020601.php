<?php

###
# @name			Update to version 2.6.1
# @author		Tobias Reich
# @copyright	2014 by Tobias Reich
###

# Add `downloadable`
$query = Database::prepare($database, "SELECT `downloadable` FROM `?` LIMIT 1", [LYCHEE_TABLE_ALBUMS]);
if (!$database->query($query)) {
	$query	= Database::prepare($database, "ALTER TABLE `?` ADD `downloadable` TINYINT(1) NOT NULL DEFAULT 1", [LYCHEE_TABLE_ALBUMS]);
	$result	= $database->query($query);
	if (!$result) {
		Log::error($database, 'update_020601', __LINE__, 'Could not update database (' . $database->error . ')');
		return false;
	}
}

# Set version
$query	= Database::prepare($database, "UPDATE ? SET value = '020601' WHERE `key` = 'version'", [LYCHEE_TABLE_SETTINGS]);
$result	= $database->query($query);
if (!$result) {
	Log::error($database, 'update_020601', __LINE__, 'Could not update database (' . $database->error . ')');
	return false;
}

?>