<?php
/**
* InterwikiUsage MediaWiki extension.
*
* This extension adds a parser function that displays content as
* ROT13- or otherwise substitution cipher-encrypted, except for
* users with a specified right.
*
* Written by Leucosticte
* http://www.mediawiki.org/wiki/User:Leucosticte
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License along
* with this program; if not, write to the Free Software Foundation, Inc.,
* 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
* http://www.gnu.org/copyleft/gpl.html
*
* @file
* @ingroup Extensions
*/

# Alert the user that this is not a valid entry point to MediaWiki if the user tries to access the
# extension file directly.
if( !defined('MEDIAWIKI' ) ) {
        die( 'This file is a MediaWiki extension. It is not a valid entry point' );
}

$wgExtensionCredits['specialpage'][] = array(
        'path' => __FILE__,
        'name' => 'InterwikiUsage',
        'author' => 'Nathan Larson',
        'url' => 'https://www.mediawiki.org/wiki/Extension:InterwikiUsage',
        'descriptionmsg' => 'interwikiusage-desc',
        'version' => '1.0.1',
);

$wgExtensionMessagesFiles['InterwikiUsage'] = __DIR__ . '/InterwikiUsage.i18n.php';
$wgSpecialPages['InterwikiUsage'] = 'SpecialInterwikiUsage';
$wgSpecialPageGroups['InterwikiUsage'] = 'wiki';
$wgAutoloadClasses['SpecialInterwikiUsage'] = __DIR__ . '/SpecialInterwikiUsage.php';
