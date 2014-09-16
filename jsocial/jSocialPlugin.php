<?php

/**
 * jSocial
 *
 * @package     jSocial
 * @version     Version 0.1
 * @author      Jerome Duncan
 * @copyright   Copyright (c) 2014
 * @link        itsjero.me
 *
 */

namespace Craft;

class jSocialPlugin extends BasePlugin
{
  //Name
  function getName()
  {
    return Craft::t('jSocial');
  }

  //Version

  function getVersion()
  {
    return '1.1.0a';
  }

  //Developer Name

  function getDeveloper()
  {
    return 'Jerome Duncan';
  }
  //Developer Url
  function getDeveloperUrl()
  {
      return 'http://itsjero.me';
  }

  //remove Control panel section
  public function hasCpSection()
  {
      return false;
  }

  //add custom tig extentions
  public function addTwigExtension()
  {
      Craft::import('plugins.jsocial.twigextensions.jSocialTwigExtension');
      return new jSocialTwigExtension();
  }
}
