#jSocial
##The Social sharing plugin

###About

jSocial is a Craft CMS plugin that gives the user the ability to add links to share on Facebook, Twitter, LinkedIn and Google+. Not only does it just echo out a link, its almost completely customizable. It has support for things such as custom images, custom classes, font awesome icons, fontello icon sets and just plain text.

###How to use jSocial

First we set up our options (these arent needed but it wont be customized then). So in our template file or desired file and we can do this like so.

```
{% set options = {
      'title': 'foo',
      'url': 'http://google.com',
      'content': {
        'facebook': {
          'item-type': 'image',
          'value': 'http://img2.wikia.nocookie.net/__cb20130501121248/logopedia/images/f/fb/Facebook_icon_2013.svg',
          'class': 'fb',
          'size': {
            'width': '40px',
            'height': '40px'
          }
        },
        'twitter': {
          'item-type': 'text',
          'value': 'fb',
          'class': 'twitter',
          'id': 'twitter'
        },
        'linkedin': {
          'item-type': 'text',
          'value': 'Linked in',
          'class': 'linkedin'
        },
        'googleplus': {
          'item-type': 'text',
          'value': 'Google Plus',
          'class': 'googleplus'
        }
      }
    }
  %}
``` 

####Available options and what they do

title
>Sets a custom title; by default it is equal to the website name

url
>Sets a custom url that will be shared; by default it uses current page url

class-prefix
>Custom Class prefix, by default its 'jSocial'

content
>This is where most of the customization is available. 

Within this array there are all the options for modifying each social button.
Available options

	facebook
	twitter
	googleplus
	linkedin
	print
	email
	
Each one of these options has sub options

	item-type
	value
	class
	id

`item-type` |
Available Options
	
	'icon'
	'image'
	'text'

When `item-type` = `icon`

`value` is what the icon class is e.g for a facebook icon with font awesome the value would be equal to `fa fa-facebook`

`class` is what will go on the link so if `class` = `fb` then on the Anchor tag the class would be equal to the `class-prefix` + `class`

When `item-type` = `text`
`value` is what the text will be

`class` is what will go on the link so if `class` = `fb` then on the Anchor tag the class would be equal to the `class-prefix` + `class`

When `item-type` = `image`

`value` is the image source. When you use the image you have the option to give it a size.
like so:
```
'content': {
        'facebook': {
          'item-type': 'image',
          'value': 'http://img2.wikia.nocookie.net/__cb20130501121248/logopedia/images/f/fb/Facebook_icon_2013.svg',
          'class': 'fb',
          'size': {
            'width': '40px',
            'height': '40px'
          }
        }
  ```
  
###How to call the function

To echo out all of the links with no options specified
`{{ jSocialButtons() }}`

This is how you would echo out every link with the options you specified
`{{ jSocialButtons('', options) }}`

You can select specific links and a specific order by putting the item in the first parameter seperated by `|`. 

So if I wanted Facebook and Email I would so this:

```
{{ jSocialButtons('facebook|email', options) }}
```
or this if I wanted to use the defaults
```
{{ jSocialButtons('facebook|email') }}
```

