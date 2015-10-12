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
            'id' => null,
        ),
        'linkedin' => array(
            'item-type' => 'text',
            'value' => 'Linked In',
            'id' => null,
            'class' => 'linkedin',
        ),
        'googleplus' => array(
            'item-type' => 'text',
            'value' => 'Google+',
            'id' => null,
            'class' => 'google-plus',
        ),
        'email' => array(
            'item-type' => 'text',
            'value' => 'Email',
            'id' => null,
            'class' => 'email',
        ),
        'print' => array(
            'item-type' => 'text',
            'value' => 'Print',
            'id' => null,
            'class' => 'print',
        ),

      )
    );
  }

  public function getButtons($btnList = null, $options = array()){
    $defaults = $this->setDefaults();
    $list = array(
      'facebook',
      'twitter',
      'linkedin',
      'googleplus',
      'email',
      'print',
    );
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

    if(isset($options['content'][$btn]['id']))
      $id = "id='" . $options['content'][$btn]['id'] . "'";
    else
      $id = '';
    switch ($options['content'][$btn]['item-type']) {
      case 'image':
        switch ($btn) {
          case 'facebook':
            $button = "<a target='_blank' ". $id ." href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "'><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
            break;
          case 'twitter':
            $button = "<a target='_blank' ". $id ." href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&url=" . $options['url'] . "'><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
            break;
          case 'linkedin':
            $button = "<a target='_blank' ". $id ." href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source='><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
            break;
          case 'googleplus':
            $button = "<a target='_blank' ". $id ." href='https://plus.google.com/share?url=". $options['url'] ."'><img src='".$options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'" . $size . "></a>";
            break;
          case 'email':
            $button = "<a ". $id ." href='mailto:?subject=" . $options['title'] . "&body=" . $options['url'] . "\n' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><img src='" . $options['content'][$btn]['value'] ."' " . $size . "></a>";
            break;
          case 'print':
            $button = "<a ". $id ." href='javascript: window.print();'><img src='". $options['content'][$btn]['value']."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'></a>";
            break;
        }
        break;

      case 'text':
        switch ($btn) {
          case 'facebook':
            $button = "<a target='_blank' ". $id ." href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "' class='".$options['class-prefix'] . $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
            break;
          case 'twitter':
            $button = "<a target='_blank' ". $id ." href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&url=" . $options['url'] . "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
            break;
          case 'linkedin':
            $button = "<a target='_blank' ". $id ." href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source=' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
            break;
          case 'googleplus':
            $button = "<a target='_blank' ". $id ." href='https://plus.google.com/share?url=". $options['url'] ."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> ". $options['content'][$btn]['value'] ." </a>";
            break;
          case 'email':
            $button = "<a ". $id ." href='mailto:?subject=" . $options['title'] . "&body=" . $options['url'] . "\n' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'>" . $options['content'][$btn]['value'] ."</a>";
            break;
          case 'print':
            $button = "<a ". $id ." href='javascript: window.print();' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'>". $options['content'][$btn]['value']."</a>";
            break;
        }
        break;

      case 'icon':
        switch ($btn) {
          case 'facebook':
            $button = "<a target='_blank' ". $id ." href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
            break;
          case 'twitter':
            $button = "<a target='_blank' ". $id ." href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&url=" . $options['url'] . "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
            break;
          case 'linkedin':
            $button = "<a target='_blank' ". $id ." href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source=' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
            break;
          case 'googleplus':
            $button = "<a target='_blank' ". $id ." href='https://plus.google.com/share?url=". $options['url'] ."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='".$options['content'][$btn]['value'] ."'></i></a>";
            break;
          case 'email':
            $button = "<a ". $id ." href='mailto:?subject=" . $options['title'] . "&body=" . $options['url'] . "\n' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='" . $options['content'][$btn]['value'] ."'></i></a>";
            break;
          case 'print':
            $button = "<a target='_blank' ". $id ." href='javascript: window.print();' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'><i class='". $options['content'][$btn]['value']."'></i></a>";
            break;
        }
        break;

      default:
        switch ($btn) {
          case 'facebook':
            $button = "<!-- the item type was invalid so as a default we used text --><a target='_blank' ". $id ." href='https://www.facebook.com/sharer/sharer.php?u=". $options['url'] ."&t=" . $options['title']. "'> Facebook </a>";
            break;
          case 'twitter':
            $button = "<!-- the item type was invalid so as a default we used text --><a target='_blank' ". $id ." href='https://twitter.com/intent/tweet?text=". $options['title'] ."&source=sharethiscom&related=sharethis&url=" . $options['url'] . "' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> Twitter </a>";
            break;
          case 'linkedin':
            $button = "<!-- the item type was invalid so as a default we used text --><a target='_blank' ". $id ." href='https://www.linkedin.com/shareArticle?summary=&title=" . $options['title'] . "&mini=true&url=" . $options['url'] . "&source=' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> LinkedIn </a>";
            break;
          case 'googleplus':
            $button = "<!-- the item type was invalid so as a default we used text --><a target='_blank' ". $id ." href='https://plus.google.com/share?url=". $options['url'] ."' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'> Google+ </a>";
            break;
          case 'email':
            $button = "<! was invalid so as a default we used text --><a target='_blank' ". $id ."  href='mailto:?subject=" . $options['title'] . "&body=" . $options['url'] . "\n' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'>" . $options['content'][$btn]['value'] ."</a>";
            break;
          case 'print':
            $button = "<! was invalid so as a default we used text --><a target='_blank' ". $id ." href='javascript: window.print();' class='".$options['class-prefix']. $options['content'][$btn]['class'] ."'>". $options['content'][$btn]['value']."</a>";
            break;
        }
        break;

    }

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
