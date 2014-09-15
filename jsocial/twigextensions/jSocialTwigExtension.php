<?php

namespace Craft;

class jSocialTwigExtension extends \Twig_Extension
{
  public function getName()
  {
    return 'jSocial';
  }

  public function getFunctions()
  {
    return array(
      'jSocialButtons' => new \Twig_Function_Method($this, 'getButtons'),
      'jSocialButton' => new \Twig_Function_Method($this, 'getButton')
    );
  }

  public function setDefaults(){
    return array (
      'class-prefix' => 'jSocial-',
      'url' => craft()->request->getHostInfo() . craft()->request->getUrl(),
      'title' => craft()->getSiteName(),
      'content' => array(
        'facebook' => array(
            'item-type' => 'text',
            'value' => 'Facebook',
            'class' => 'fb',
        ),
        'twitter' => array(
            'item-type' => 'text',
            'value' => 'Twitter',
            'class' => 'twitter',
        ),
        'linkedin' => array(
            'item-type' => 'text',
            'value' => 'Linked In',
            'class' => 'linkedin',
        ),
        'googleplus' => array(
            'item-type' => 'text',
            'value' => 'Google+',
            'class' => 'google-plus',
        ),
      )
    );
  }

  public function getButtons($btnList = null, $options = array()){
    $defaults = $this->setDefaults();
    $list = [
      'facebook',
      'twitter',
      'linkedin',
      'googleplus'
    ];
    $options = $this->setOpts($defaults, $options);

    $buttons = '';



    if ($btnList !=  '') {
      $btnList = explode('|', $btnList);
      foreach ($btnList as $key => $btn) {
        $buttons .= $this->fetchSocial($btn, $options);
      }

    } else {
      foreach ($list as $key => $btn) {
        $buttons .= $this->fetchSocial($btn, $options);
      }
    }


      echo $buttons;

  }
  public function fetchSocial($btn, $options)
  {
    $button = '';
    // $type = $options['content'][$btn];

    $size = "style='max-width: 100%; ";

    if(isset($options['content'][$btn]['size']['width']))
        $size .= 'width: ' . $options['content'][$btn]['size']['width'] . ';';

    if(isset($options['content'][$btn]['size']['height']))
        $size .= 'height: ' . $options['content'][$btn]['size']['height'] . ';';

    $size .= "'";

    switch ($btn) {

      case 'facebook':
          switch ($options['content'][$btn]['item-type']) {
            case 'image':
                $button = "<a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "'><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
              break;
            case 'icon':
                $button = "<a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
              break;
            case 'text':
              $button = "<a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "'> ". $options['content'][$btn]['value'] ." </a>";
              break;
            default:
              $button = "<a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "'> ". $options['content'][$btn]['value'] ." </a>";
              break;
          }
          break;

      case 'twitter':
         switch ($options['content'][$btn]['item-type']) {
            case 'image':
              $button = "<a target='_blank' href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&via=jSocial&url=" . $options['url'] . "'><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
              break;
            case 'icon':
              $button = "<a target='_blank' href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&via=jSocial&url=" . $options['url'] . "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
              break;
            case 'text':
              $button = "<a target='_blank' href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&via=jSocial&url=" . $options['url'] . "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
              break;
            default:
              $button = "<a target='_blank' href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&via=jSocial&url=" . $options['url'] . "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
              break;
          }
        break;

      case 'googleplus':
          switch ($options['content'][$btn]['item-type']) {
            case 'image':
                $button = "<a target='_blank' href='https://plus.google.com/share?url=". $options['url'] ."'><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
              break;
            case 'icon':
              $button = "<a target='_blank' href='https://plus.google.com/share?url=". $options['url'] ."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
              break;
            case 'text':
              $button = "<a target='_blank' href='https://plus.google.com/share?url=". $options['url'] ."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
              break;
            default:
              $button = "<a target='_blank' href='https://plus.google.com/share?url=". $options['url'] ."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
              break;
          }
        break;

      case 'linkedin':
          switch ($options['content'][$btn]['item-type']) {
            case 'image':
              $button = "<a target='_blank' href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source='><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
              break;
            case 'icon':
              $button = "<a target='_blank' href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source=' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
              break;
            case 'text':
              $button = "<a target='_blank' href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source=' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
              break;
            default:
              $button = "<a target='_blank' href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source=' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
              break;
          }
       break;

    }

    // echo $type;
    return $button;
  }
  public function getButton($type, $options = array())
  {
    $defaults = $this->setDefaults();

    $options = $this->setOpts($defaults, $options);
    echo $this->fetchSocial($type, $options);
  }

  public function setOpts($defaults, $opts)
  {
    foreach($opts as $key => $value) {
      if ($key == 'content') {
        $content = $opts['content'];
        foreach ($content as $key_2 => $val) {
          $social = $opts[$key][$key_2];
          foreach($social as $key_3 => $val3) {
            $defaults[$key][$key_2][$key_3] = $val3;
          }
        }
      }else{
        $defaults[$key] = $value;
      }

    }
    return $defaults;
  }
}
