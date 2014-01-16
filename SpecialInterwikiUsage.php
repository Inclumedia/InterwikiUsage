<?php
if ( !defined( 'MEDIAWIKI' ) ) {
   die( 'This file is a MediaWiki extension. It is not a valid entry point' );
}

class SpecialInterwikiUsage extends SpecialPage {
   function __construct( ) {
      parent::__construct( 'InterwikiUsage' );
   }

   function execute( $par ) {
      $this->setHeaders();
      $viewOutput = $this->getOutput();
      $dbr = wfGetDB( DB_SLAVE );
      global $wgSitename;
      if ( $par ) {
         $viewOutput->addWikiText( "<big>'''" . wfMessage( 'interwikiusage-intro-prefix', $par )->plain()
         . "'''</big>\n" );
      } else {
         $viewOutput->addWikiText( "<big>'''" . wfMessage( 'interwikiusage-intro', $wgSitename )->plain()
            . "'''</big>\n" );
      }
      $namespaces = MWNamespace::getCanonicalNamespaces();
      $where = array();
      if ( $par ) {
         $where = array( 'iwl_prefix' => $par );
      }
      $res = $dbr->select(
         array( 'iwlinks', 'page'),
         array( 'page_id', 'page_namespace', 'page_title', 'iwl_from', 'iwl_prefix', 'iwl_title' ),
         $where,
         __METHOD__,
         array(),
         array( 'page' => array( 'INNER JOIN', array( 'iwl_from=page_id' ) ) )
      );
      $interwikis = array();
      $titles = array();
      foreach ( $res as $row ) {
         $titles[$row->iwl_from] = array(
           'page_namespace' => $row->page_namespace,
           'page_title' => str_replace( '_', ' ', $row->page_title )
         );
         $interwikis[$row->iwl_prefix][$row->iwl_from][] = $row->iwl_title;
      }
      $thisPrefix = '';
      if ( !$interwikis ) {
         if ( $par ) {
            $viewOutput->addWikiText( wfMessage( 'interwikiusage-no-usages-prefix', $par ) );
         } else {
            $viewOutput->addWikiText( wfMessage( 'interwikiusage-no-usages' ) );
         }
         return;
      }
      foreach( $interwikis as $prefix => $froms ) {
         if ( $prefix != $thisPrefix ) {
            $countPages = count( $froms );
            $countUses = 0;
            foreach ( $froms as $from ) {
               $countUses += count ( $from );
            }
            $prefixAndCountText = wfMessage( 'interwikiusage-pages-count',
               $prefix, $countPages, $countUses )->plain();
            $viewOutput->addWikiText( "==$prefixAndCountText==\n" );
            $thisPrefix = $prefix;
         }
         $thisFrom = '';
         foreach ( $froms as $from => $data ) {
            if ( $from != $thisFrom ) {
               $thisTitle = $titles[$from];
               $thisTitleText = '';
               if ( $titles[$from]['page_namespace'] == 828 ) {
                  $thisTitleText = 'Module:';
               } else {
                  $thisTitleText = $namespaces[$titles[$from]['page_namespace']];
               }
               if ( $namespaces[$titles[$from]['page_namespace']] ) {
                  $thisTitleText .= ':';
               }
               $countUses = count ( $data );
               $thisTitleText .= $titles[$from]['page_title'];
               $thisTitleText = "[[:$thisTitleText]]";
               $thisTitleText = wfMessage( 'interwikiusage-uses-count',
                  $thisTitleText, $countUses )->plain();
               $viewOutput->addWikiText("===$thisTitleText===\n");
               $thisFrom = $from;
            }
            foreach ( $data as $datum ) {
               $viewOutput->addWikiText( "*[[$prefix:$datum|$datum]]\n" );
            }
         }
      }
      return;
   }
}
