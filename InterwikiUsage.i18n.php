<?php
/**
* Internationalisation for InterwikiUsage
*
* @file
* @ingroup Extensions
*/
$messages = array();

/** English
* @author Nathan Larson (Leucosticte)
*/
$messages['en'] = array(
    'interwikiusage' => 'Interwiki prefix usage',
    'interwikiusage-desc' => 'Adds a [[Special:InterwikiUsage|special page]] showing what interwiki prefixes are used by what pages',
    'interwikiusage-intro' => 'These are the interwiki prefixes used on $1, the referring pages, and the titles of the target pages:',
    'interwikiusage-intro-prefix' => 'For the interwiki prefix $1, these are the referring pages and the titles of the target pages:',
    'interwikiusage-pages-count' => "$1 ($2 {{PLURAL:$2|page|pages}}, $3 {{PLURAL:$3|use|uses}})",
    'interwikiusage-uses-count' => "$1 ($2 {{PLURAL:$2|use|uses}})",
    'interwikiusage-no-usages' => "No interwiki prefix usages were found.",
    'interwikiusage-no-usages-prefix' => "No usages were found for interwiki prefix $1."
);
