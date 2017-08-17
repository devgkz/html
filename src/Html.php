<?php

namespace Devgkz\Html;

/**
 * Html helper class file.
 *
 * @link      https://github.com/devgkz/html
 * @copyright Copyright (c) 2017 Eugene Dementyev.
 * @license   https://opensource.org/licenses/BSD-3-Clause

 * Parts of this code originally based on Yii 1.x
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

class Html
{
    const ID_PREFIX='t';
    /**
     * @var string the CSS class for displaying error summaries (see {@link errorSummary}).
     */
    public static $errorSummaryCss='errorSummary';
    /**
     * @var string the CSS class for displaying error messages (see {@link error}).
     */
    public static $errorMessageCss='errorMessage';
    /**
     * @var string the CSS class for highlighting error inputs. Form inputs will be appended
     * with this CSS class if they have input errors.
     */
    public static $errorCss='error';
    /**
     * @var string the CSS class for required labels. Defaults to 'required'.
     */
    public static $requiredCss='required';
    /**
     * @var string the HTML code to be prepended to the required label.
     */
    public static $beforeRequiredLabel='';
    /**
     * @var string the HTML code to be appended to the required label.
     */
    public static $afterRequiredLabel=' <span class="required">*</span>';
    /**
     * @var integer the counter for generating automatic input field names.
     */
    public static $count=0;

    /**
     * Encodes special characters into HTML entities.
     * The {@link CApplication::charset application charset} will be used for encoding.
     * @param string $text data to be encoded
     * @return string the encoded data
     */
    public static function encode($text)
    {
        //return htmlspecialchars($text,ENT_QUOTES,App::_()->charset);
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Decodes special HTML entities back to the corresponding characters.
     * This is the opposite of {@link encode()}.
     * @param string $text data to be decoded
     * @return string the decoded data
     */
    public static function decode($text)
    {
        return htmlspecialchars_decode($text, ENT_QUOTES);
    }

    /**
     * Encodes special characters in an array of strings into HTML entities.
     * Both the array keys and values will be encoded if needed.
     * If a value is an array, this method will also encode it recursively.
     * @param array $data data to be encoded
     * @return array the encoded data
     */
    public static function encodeArray($data)
    {
        $d=array();
        foreach ($data as $key=>$value) {
            if (is_string($key)) {
                $key=htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            }
            if (is_string($value)) {
                $value=htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } elseif (is_array($value)) {
                $value=self::encodeArray($value);
            }
            $d[$key]=$value;
        }
        return $d;
    }

    /**
     * Generates an HTML element.
     * @param string $tag the tag name
     * @param array $htmlOptions the element attributes. The values will be HTML-encoded using {@link encode()}.
     * If an 'encode' attribute is given and its value is false,
     * the rest of the attribute values will NOT be HTML-encoded.
     * Attributes whose value is null will not be rendered.
     * @param mixed $content the content to be enclosed between open and close element tags. It will not be HTML-encoded.
     * If false, it means there is no body content.
     * @param boolean $closeTag whether to generate the close tag.
     * @return string the generated HTML element tag
     */
    public static function tag($tag, $htmlOptions=array(), $content=false, $closeTag=true)
    {
        $html='<' . $tag . self::renderAttributes($htmlOptions);
        if ($content===false) {
            return $closeTag ? $html.' />' : $html.'>';
        } else {
            return $closeTag ? $html.'>'.$content.'</'.$tag.'>' : $html.'>'.$content;
        }
    }

    /**
     * Generates an open HTML element.
     * @param string $tag the tag name
     * @param array $htmlOptions the element attributes. The values will be HTML-encoded using {@link encode()}.
     * If an 'encode' attribute is given and its value is false,
     * the rest of the attribute values will NOT be HTML-encoded.
     * Attributes whose value is null will not be rendered.
     * @return string the generated HTML element tag
     */
    public static function openTag($tag, $htmlOptions=array())
    {
        return '<' . $tag . self::renderAttributes($htmlOptions) . '>';
    }

    /**
     * Generates a close HTML element.
     * @param string $tag the tag name
     * @return string the generated HTML element tag
     */
    public static function closeTag($tag)
    {
        return '</'.$tag.'>';
    }

    /**
     * Encloses the given string within a CDATA tag.
     * @param string $text the string to be enclosed
     * @return string the CDATA tag with the enclosed content.
     */
    public static function cdata($text)
    {
        return '<![CDATA[' . $text . ']]>';
    }

    /**
     * Generates a meta tag that can be inserted in the head section of HTML page.
     * @param string $content content attribute of the meta tag
     * @param string $name name attribute of the meta tag. If null, the attribute will not be generated
     * @param string $httpEquiv http-equiv attribute of the meta tag. If null, the attribute will not be generated
     * @param array $options other options in name-value pairs (e.g. 'scheme', 'lang')
     * @return string the generated meta tag
     */
    public static function metaTag($content, $name=null, $httpEquiv=null, $options=array())
    {
        if ($name!==null) {
            $options['name']=$name;
        }
        if ($httpEquiv!==null) {
            $options['http-equiv']=$httpEquiv;
        }
        $options['content']=$content;
        return self::tag('meta', $options);
    }

    /**
     * Generates a link tag that can be inserted in the head section of HTML page.
     * Do not confuse this method with {@link link()}. The latter generates a hyperlink.
     * @param string $relation rel attribute of the link tag. If null, the attribute will not be generated.
     * @param string $type type attribute of the link tag. If null, the attribute will not be generated.
     * @param string $href href attribute of the link tag. If null, the attribute will not be generated.
     * @param string $media media attribute of the link tag. If null, the attribute will not be generated.
     * @param array $options other options in name-value pairs
     * @return string the generated link tag
     */
    public static function linkTag($relation=null, $type=null, $href=null, $media=null, $options=array())
    {
        if ($relation!==null) {
            $options['rel']=$relation;
        }
        if ($type!==null) {
            $options['type']=$type;
        }
        if ($href!==null) {
            $options['href']=$href;
        }
        if ($media!==null) {
            $options['media']=$media;
        }
        return self::tag('link', $options);
    }

    /**
     * Encloses the given CSS content with a CSS tag.
     * @param string $text the CSS content
     * @param string $media the media that this CSS should apply to.
     * @return string the CSS properly enclosed
     */
    public static function css($text, $media='')
    {
        if ($media!=='') {
            $media=' media="'.$media.'"';
        }
        return "<style type=\"text/css\"{$media}>\n/*<![CDATA[*/\n{$text}\n/*]]>*/\n</style>";
    }

    /**
     * Links to the specified CSS file.
     * @param string $url the CSS URL
     * @param string $media the media that this CSS should apply to.
     * @return string the CSS link.
     */
    public static function cssFile($url, $media='')
    {
        if ($media!=='') {
            $media=' media="'.$media.'"';
        }
        return '<link rel="stylesheet" type="text/css" href="'.self::encode($url).'"'.$media.' />';
    }

    /**
     * Encloses the given JavaScript within a script tag.
     * @param string $text the JavaScript to be enclosed
     * @return string the enclosed JavaScript
     */
    public static function script($text)
    {
        return "<script type=\"text/javascript\">\n/*<![CDATA[*/\n{$text}\n/*]]>*/\n</script>";
    }

    /**
     * Includes a JavaScript file.
     * @param string $url URL for the JavaScript file
     * @return string the JavaScript file tag
     */
    public static function scriptFile($url)
    {
        return '<script type="text/javascript" src="'.self::encode($url).'"></script>';
    }

    /**
     * Generates an opening form tag.
     * This is a shortcut to {@link beginForm}.
     * @param mixed $action the form action URL (see {@link normalizeUrl} for details about this parameter.)
     * @param string $method form method (e.g. post, get)
     * @param array $htmlOptions additional HTML attributes (see {@link tag}).
     * @return string the generated form tag.
     */
    public static function form($action='', $method='post', $htmlOptions=array())
    {
        return self::beginForm($action, $method, $htmlOptions);
    }

    /**
     * Generates an opening form tag.
     * Note, only the open tag is generated. A close tag should be placed manually
     * at the end of the form.
     * @param mixed $action the form action URL (see {@link normalizeUrl} for details about this parameter.)
     * @param string $method form method (e.g. post, get)
     * @param array $htmlOptions additional HTML attributes (see {@link tag}).
     * @return string the generated form tag.
     */
    public static function beginForm($action='', $method='post', $htmlOptions=array())
    {
        $htmlOptions['action']=$url=self::normalizeUrl($action);
        $htmlOptions['method']=$method;
        $form=self::tag('form', $htmlOptions, false, false);
        $hiddens=array();
        if (!strcasecmp($method, 'get') && ($pos=strpos($url, '?'))!==false) {
            foreach (explode('&', substr($url, $pos+1)) as $pair) {
                if (($pos=strpos($pair, '='))!==false) {
                    $hiddens[]=self::hiddenField(urldecode(substr($pair, 0, $pos)), urldecode(substr($pair, $pos+1)), array('id'=>false));
                }
            }
        }
        //$request=Yii::app()->request; //devg
        //if($request->enableCsrfValidation && !strcasecmp($method,'post'))
            //$hiddens[]=self::hiddenField($request->csrfTokenName,$request->getCsrfToken(),array('id'=>false)); //devg
        if ($hiddens!==array()) {
            $form.="\n".self::tag('div', array('style'=>'display:none'), implode("\n", $hiddens));
        }
        return $form;
    }

    /**
     * Generates a closing form tag.
     * @return string the generated tag
     */
    public static function endForm()
    {
        return '</form>';
    }

  /**
     * Âûâîä îøèáîê ôîðì
     * @return string the generated html
     * @author devg
     */
  public static function formErrors($errors=array(), $header='<p><b>Äîïóùåííûå îøèáêè:</b></p>')
  {
      if (count($errors)) {
          /* $result = '<div class="errors">'.$header.'<ul>';
      foreach ($errors as $err=>$msg) $result .= '<li>'.$msg."</li>\n";
      $result .= '</ul></div>'; */
      $result = '<div class="'.self::$errorSummaryCss.'">'.$header.'';
          foreach ($errors as $err=>$msg) {
              $result .= '<p class="">'.$msg."</p>\n";
          }
          $result .= '</div>';
          return $result;
      }
  }


    /**
     * Generates a hyperlink tag.
     * @param string $text link body. It will NOT be HTML-encoded. Therefore you can pass in HTML code such as an image tag.
     * @param mixed $url a URL or an action route that can be used to create a URL.
     * See {@link normalizeUrl} for more details about how to specify this parameter.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated hyperlink
     */
    public static function link($text, $url='#', $htmlOptions=array())
    {
        if ($url!=='') {
            $htmlOptions['href']=self::normalizeUrl($url);
        }
        return self::tag('a', $htmlOptions, $text);
    }

    /**
     * Generates a mailto link.
     * @param string $text link body. It will NOT be HTML-encoded. Therefore you can pass in HTML code such as an image tag.
     * @param string $email email address. If this is empty, the first parameter (link body) will be treated as the email address.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated mailto link
     */
    public static function mailto($text, $email='', $htmlOptions=array())
    {
        if ($email==='') {
            $email=$text;
        }
        return self::link($text, 'mailto:'.$email, $htmlOptions);
    }

    /**
     * Generates an image tag.
     * @param string $src the image URL
     * @param string $alt the alternative text display
     * @param array $htmlOptions additional HTML attributes (see {@link tag}).
     * @return string the generated image tag
     */
    public static function image($src, $alt='', $htmlOptions=array())
    {
        $htmlOptions['src']=$src;
        $htmlOptions['alt']=$alt;
        return self::tag('img', $htmlOptions);
    }

    /**
     * Generates a button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag
     */
    public static function button($label='button', $htmlOptions=array())
    {
        if (!isset($htmlOptions['name'])) {
            if (!array_key_exists('name', $htmlOptions)) {
                $htmlOptions['name']=self::ID_PREFIX.self::$count++;
            }
        }
        if (!isset($htmlOptions['type'])) {
            $htmlOptions['type']='button';
        }
        if (!isset($htmlOptions['value'])) {
            $htmlOptions['value']=$label;
        }
        return self::tag('input', $htmlOptions);
    }

    /**
     * Generates a button using HTML button tag.
     * This method is similar to {@link button} except that it generates a 'button'
     * tag instead of 'input' tag.
     * @param string $label the button label. Note that this value will be directly inserted in the button element
     * without being HTML-encoded.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag
     */
    public static function htmlButton($label='button', $htmlOptions=array())
    {
        if (!isset($htmlOptions['name'])) {
            $htmlOptions['name']=self::ID_PREFIX.self::$count++;
        }
        if (!isset($htmlOptions['type'])) {
            $htmlOptions['type']='button';
        }
        return self::tag('button', $htmlOptions, $label);
    }

    /**
     * Generates a submit button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag
     */
    public static function submitButton($label='submit', $htmlOptions=array())
    {
        $htmlOptions['type']='submit';
        return self::button($label, $htmlOptions);
    }

    /**
     * Generates a reset button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag
     */
    public static function resetButton($label='reset', $htmlOptions=array())
    {
        $htmlOptions['type']='reset';
        return self::button($label, $htmlOptions);
    }

    /**
     * Generates an image submit button.
     * @param string $src the image URL
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag
     */
    public static function imageButton($src, $htmlOptions=array())
    {
        $htmlOptions['src']=$src;
        $htmlOptions['type']='image';
        return self::button('submit', $htmlOptions);
    }

    /**
     * Generates a link submit button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag
     */
    public static function linkButton($label='submit', $htmlOptions=array())
    {
        if (!isset($htmlOptions['submit'])) {
            $htmlOptions['submit']=isset($htmlOptions['href']) ? $htmlOptions['href'] : '';
        }
        return self::link($label, '#', $htmlOptions);
    }

    /**
     * Generates a label tag.
     * @param string $label label text. Note, you should HTML-encode the text if needed.
     * @param string $for the ID of the HTML element that this label is associated with.
     * If this is false, the 'for' attribute for the label tag will not be rendered.
     * @param array $htmlOptions additional HTML attributes.
     * The following HTML option is recognized:
     * <ul>
     * <li>required: if this is set and is true, the label will be styled
     * with CSS class 'required' (customizable with CHtml::$requiredCss),
     * and be decorated with {@link CHtml::beforeRequiredLabel} and
     * {@link CHtml::afterRequiredLabel}.</li>
     * </ul>
     * @return string the generated label tag
     */
    public static function label($label, $for, $htmlOptions=array())
    {
        if ($for=='') {
            unset($htmlOptions['for']);
        } else {
            $htmlOptions['for']=$for;
        }
        if (isset($htmlOptions['required'])) {
            if ($htmlOptions['required']) {
                if (isset($htmlOptions['class'])) {
                    $htmlOptions['class'].=' '.self::$requiredCss;
                } else {
                    $htmlOptions['class']=self::$requiredCss;
                }
                $label=self::$beforeRequiredLabel.$label.self::$afterRequiredLabel;
            }
            unset($htmlOptions['required']);
        }
        return self::tag('label', $htmlOptions, $label);
    }

    /**
     * Generates a text field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field
     */
    public static function textField($name, $value='', $htmlOptions=array())
    {
        return self::inputField('text', $name, $value, $htmlOptions);
    }

    /**
     * Generates a hidden input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes (see {@link tag}).
     * @return string the generated input field
     */
    public static function hiddenField($name, $value='', $htmlOptions=array())
    {
        return self::inputField('hidden', $name, $value, $htmlOptions);
    }

    /**
     * Generates a password field input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field
     */
    public static function passwordField($name, $value='', $htmlOptions=array())
    {
        return self::inputField('password', $name, $value, $htmlOptions);
    }

    /**
     * Generates a file input.
     * Note, you have to set the enclosing form's 'enctype' attribute to be 'multipart/form-data'.
     * After the form is submitted, the uploaded file information can be obtained via $_FILES[$name] (see
     * PHP documentation).
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes (see {@link tag}).
     * @return string the generated input field
     */
    public static function fileField($name, $value='', $htmlOptions=array())
    {
        return self::inputField('file', $name, $value, $htmlOptions);
    }

    /**
     * Generates a text area input.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area
     */
    public static function textArea($name, $value='', $htmlOptions=array())
    {
        $htmlOptions['name']=$name;
        if (!isset($htmlOptions['id'])) {
            $htmlOptions['id']=self::getIdByName($name);
        } elseif ($htmlOptions['id']===false) {
            unset($htmlOptions['id']);
        }
        return self::tag('textarea', $htmlOptions, isset($htmlOptions['encode']) && !$htmlOptions['encode'] ? $value : self::encode($value));
    }

    /**
     * Generates a radio button.
     * @param string $name the input name
     * @param boolean $checked whether the radio button is checked
     * @param array $htmlOptions additional HTML attributes.
     * Since version 1.1.2, a special option named 'uncheckValue' is available that can be used to specify
     * the value returned when the radio button is not checked. When set, a hidden field is rendered so that
     * when the radio button is not checked, we can still obtain the posted uncheck value.
     * If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.
     * @return string the generated radio button
     */
    public static function radioButton($name, $checked=false, $htmlOptions=array())
    {
        if ($checked) {
            $htmlOptions['checked']='checked';
        } else {
            unset($htmlOptions['checked']);
        }
        $value=isset($htmlOptions['value']) ? $htmlOptions['value'] : 1;
        
        if (array_key_exists('uncheckValue', $htmlOptions)) {
            $uncheck=$htmlOptions['uncheckValue'];
            unset($htmlOptions['uncheckValue']);
        } else {
            $uncheck=null;
        }

        if ($uncheck!==null) {
            // add a hidden field so that if the radio button is not selected, it still submits a value
            if (isset($htmlOptions['id']) && $htmlOptions['id']!==false) {
                $uncheckOptions=array('id'=>self::ID_PREFIX.$htmlOptions['id']);
            } else {
                $uncheckOptions=array('id'=>false);
            }
            $hidden=self::hiddenField($name, $uncheck, $uncheckOptions);
        } else {
            $hidden='';
        }

        // add a hidden field so that if the radio button is not selected, it still submits a value
        return $hidden . self::inputField('radio', $name, $value, $htmlOptions);
    }

    /**
     * Generates a check box.
     * @param string $name the input name
     * @param boolean $checked whether the check box is checked
     * @param array $htmlOptions additional HTML attributes.
     * Since version 1.1.2, a special option named 'uncheckValue' is available that can be used to specify
     * the value returned when the checkbox is not checked. When set, a hidden field is rendered so that
     * when the checkbox is not checked, we can still obtain the posted uncheck value.
     * If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.
     * @return string the generated check box
     */
    public static function checkBox($name, $checked=false, $htmlOptions=array())
    {
        if ($checked) {
            $htmlOptions['checked']='checked';
        } else {
            unset($htmlOptions['checked']);
        }
        $value=isset($htmlOptions['value']) ? $htmlOptions['value'] : 1;
        
        if (array_key_exists('uncheckValue', $htmlOptions)) {
            $uncheck=$htmlOptions['uncheckValue'];
            unset($htmlOptions['uncheckValue']);
        } else {
            $uncheck=null;
        }

        if ($uncheck!==null) {
            // add a hidden field so that if the radio button is not selected, it still submits a value
            if (isset($htmlOptions['id']) && $htmlOptions['id']!==false) {
                $uncheckOptions=array('id'=>self::ID_PREFIX.$htmlOptions['id']);
            } else {
                $uncheckOptions=array('id'=>false);
            }
            $hidden=self::hiddenField($name, $uncheck, $uncheckOptions);
        } else {
            $hidden='';
        }

        // add a hidden field so that if the checkbox  is not selected, it still submits a value
        return $hidden . self::inputField('checkbox', $name, $value, $htmlOptions);
    }

    /**
     * Generates a drop down list.
     * @param string $name the input name
     * @param string $select the selected value
     * @param array $data data for generating the list options (value=>display).
     * You may use {@link listData} to generate this data.
     * Please refer to {@link listOptions} on how this data is used to generate the list options.
     * Note, the values and labels will be automatically HTML-encoded by this method.
     * @param array $htmlOptions additional HTML attributes.
     * In addition, the following options are also supported specifically for dropdown list:
     * <ul>
     * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
     * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
     * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
     * The 'empty' option can also be an array of value-label pairs.
     * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
     * <li>options: array, specifies additional attributes for each OPTION tag.
     *     The array keys must be the option values, and the array values are the extra
     *     OPTION tag attributes in the name-value pairs. For example,
     * <pre>
     *     array(
     *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
     *         'value2'=>array('label'=>'value 2'),
     *     );
     * </pre>
     * </li>
     * </ul>
     * @return string the generated drop down list
     */
    public static function dropDownList($name, $select, $data, $htmlOptions=array())
    {
        $htmlOptions['name']=$name;
        if (!isset($htmlOptions['id'])) {
            $htmlOptions['id']=self::getIdByName($name);
        } elseif ($htmlOptions['id']===false) {
            unset($htmlOptions['id']);
        }
        $options="\n".self::listOptions($select, $data, $htmlOptions);
        return self::tag('select', $htmlOptions, $options);
    }

    public static function dropDownListPopular($name, $select, $data, $htmlOptions=array())
    {
        $htmlOptions['name']=$name;
        if (!isset($htmlOptions['id'])) {
            $htmlOptions['id']=self::getIdByName($name);
        } elseif ($htmlOptions['id']===false) {
            unset($htmlOptions['id']);
        }

        $options="\n".self::listOptionsPopular($select, $data, $htmlOptions);
        return self::tag('select', $htmlOptions, $options);
    }

    /**
     * Generates a list box.
     * @param string $name the input name
     * @param mixed $select the selected value(s). This can be either a string for single selection or an array for multiple selections.
     * @param array $data data for generating the list options (value=>display)
     * You may use {@link listData} to generate this data.
     * Please refer to {@link listOptions} on how this data is used to generate the list options.
     * Note, the values and labels will be automatically HTML-encoded by this method.
     * @param array $htmlOptions additional HTML attributes.
     * In addition, the following options are also supported specifically for list box:
     * <ul>
     * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
     * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
     * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
     * The 'empty' option can also be an array of value-label pairs.
     * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
     * <li>options: array, specifies additional attributes for each OPTION tag.
     *     The array keys must be the option values, and the array values are the extra
     *     OPTION tag attributes in the name-value pairs. For example,
     * <pre>
     *     array(
     *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
     *         'value2'=>array('label'=>'value 2'),
     *     );
     * </pre>
     * </li>
     * </ul>
     * @return string the generated list box
     */
    public static function listBox($name, $select, $data, $htmlOptions=array())
    {
        if (!isset($htmlOptions['size'])) {
            $htmlOptions['size']=4;
        }
        if (isset($htmlOptions['multiple'])) {
            if (substr($name, -2)!=='[]') {
                $name.='[]';
            }
        }
        return self::dropDownList($name, $select, $data, $htmlOptions);
    }

    /**
     * Normalizes the input parameter to be a valid URL.
     *
     * If the input parameter is an empty string, the currently requested URL will be returned.
     *
     * If the input parameter is a non-empty string, it is treated as a valid URL and will
     * be returned without any change.
     *
     * @param mixed $url the parameter to be used to generate a valid URL
     * @return string the normalized URL
     */
    public static function normalizeUrl($url)
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        
        return $url==='' ? $uri : $url;
    }

    /**
     * Generates an input HTML tag.
     * This method generates an input HTML tag based on the given input name and value.
     * @param string $type the input type (e.g. 'text', 'radio')
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes for the HTML tag (see {@link tag}).
     * @return string the generated input tag
     */
    protected static function inputField($type, $name, $value, $htmlOptions)
    {
        $htmlOptions['type']=$type;
        $htmlOptions['value']=$value;
        $htmlOptions['name']=$name;
        if (!isset($htmlOptions['id'])) {
            $htmlOptions['id']=self::getIdByName($name);
        } elseif ($htmlOptions['id']===false) {
            unset($htmlOptions['id']);
        }
        return self::tag('input', $htmlOptions);
    }

    /**
     * Generates the data suitable for list-based HTML elements.
     * The generated data can be used in {@link dropDownList}, {@link listBox}, {@link checkBoxList},
     * {@link radioButtonList}, and their active-versions (such as {@link activeDropDownList}).
     * Note, this method does not HTML-encode the generated data. You may call {@link encodeArray} to
     * encode it if needed.
     * Please refer to the {@link value} method on how to specify value field, text field and group field.
     * @param array $models a list of model objects. This parameter
     * can also be an array of associative arrays (e.g. results of {@link CDbCommand::queryAll}).
     * @param string $valueField the attribute name for list option values
     * @param string $textField the attribute name for list option texts
     * @param string $groupField the attribute name for list option group names. If empty, no group will be generated.
     * @return array the list data that can be used in {@link dropDownList}, {@link listBox}, etc.
     */
    public static function listData($models, $valueField, $textField, $groupField='')
    {
        $listData=array();
        if ($groupField==='') {
            foreach ($models as $model) {
                $value=self::value($model, $valueField);
                $text=self::value($model, $textField);
                $listData[$value]=$text;
            }
        } else {
            foreach ($models as $model) {
                $group=self::value($model, $groupField);
                $value=self::value($model, $valueField);
                $text=self::value($model, $textField);
                $listData[$group][$value]=$text;
            }
        }
        return $listData;
    }

    /**
     * Evaluates the value of the specified attribute for the given model.
     * The attribute name can be given in a dot syntax. For example, if the attribute
     * is "author.firstName", this method will return the value of "$model->author->firstName".
     * A default value (passed as the last parameter) will be returned if the attribute does
     * not exist or is broken in the middle (e.g. $model->author is null).
     * The model can be either an object or an array. If the latter, the attribute is treated
     * as a key of the array. For the example of "author.firstName", if would mean the array value
     * "$model['author']['firstName']".
     * @param mixed $model the model. This can be either an object or an array.
     * @param string $attribute the attribute name (use dot to concatenate multiple attributes)
     * @param mixed $defaultValue the default value to return when the attribute does not exist
     * @return mixed the attribute value
     */
    public static function value($model, $attribute, $defaultValue=null)
    {
        foreach (explode('.', $attribute) as $name) {
            if (is_object($model)) {
                $model=$model->$name;
            } elseif (is_array($model) && isset($model[$name])) {
                $model=$model[$name];
            } else {
                return $defaultValue;
            }
        }
        return $model;
    }

    /**
     * Generates a valid HTML ID based on name.
     * @param string $name name from which to generate HTML ID
     * @return string the ID generated based on name.
     */
    public static function getIdByName($name)
    {
        return self::ID_PREFIX.str_replace(array('[]', '][', '[', ']'), array('', '_', '_', ''), $name);
    }

    

    /**
     * Generates the list options.
     * @param mixed $selection the selected value(s). This can be either a string for single selection or an array for multiple selections.
     * @param array $listData the option data (see {@link listData})
     * @param array $htmlOptions additional HTML attributes. The following two special attributes are recognized:
     * <ul>
     * <li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
     * <li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
     * <li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
     * The 'empty' option can also be an array of value-label pairs.
     * Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
     * <li>options: array, specifies additional attributes for each OPTION tag.
     *     The array keys must be the option values, and the array values are the extra
     *     OPTION tag attributes in the name-value pairs. For example,
     * <pre>
     *     array(
     *         'value1'=>array('disabled'=>true, 'label'=>'value 1'),
     *         'value2'=>array('label'=>'value 2'),
     *     );
     * </pre>
     * </li>
     * <li>key: string, specifies the name of key attribute of the selection object(s).
     * This is used when the selection is represented in terms of objects. In this case,
     * the property named by the key option of the objects will be treated as the actual selection value.
     * This option defaults to 'primaryKey', meaning using the 'primaryKey' property value of the objects in the selection.
     * This option has been available since version 1.1.3.</li>
     * </ul>
     * @return string the generated list options
     */
    public static function listOptions($selection, $listData, &$htmlOptions)
    {
        $raw=isset($htmlOptions['encode']) && !$htmlOptions['encode'];
        $content='';
        if (isset($htmlOptions['prompt'])) {
            $content.='<option value="">'.strtr($htmlOptions['prompt'], array('<'=>'&lt;', '>'=>'&gt;'))."</option>\n";
            unset($htmlOptions['prompt']);
        }
        if (isset($htmlOptions['empty'])) {
            if (!is_array($htmlOptions['empty'])) {
                $htmlOptions['empty']=array(''=>$htmlOptions['empty']);
            }
            foreach ($htmlOptions['empty'] as $value=>$label) {
                $content.='<option value="'.self::encode($value).'">'.strtr($label, array('<'=>'&lt;', '>'=>'&gt;'))."</option>\n";
            }
            unset($htmlOptions['empty']);
        }

        if (isset($htmlOptions['options'])) {
            $options=$htmlOptions['options'];
            unset($htmlOptions['options']);
        } else {
            $options=array();
        }

        $key=isset($htmlOptions['key']) ? $htmlOptions['key'] : 'primaryKey';
        if (is_array($selection)) {
            foreach ($selection as $i=>$item) {
                if (is_object($item)) {
                    $selection[$i]=$item->$key;
                }
            }
        } elseif (is_object($selection)) {
            $selection=$selection->$key;
        }

        foreach ($listData as $key=>$value) {
            if (is_array($value)) {
                $content.='<optgroup label="'.($raw?$key : self::encode($key))."\">\n";
                $dummy=array('options'=>$options);
                if (isset($htmlOptions['encode'])) {
                    $dummy['encode']=$htmlOptions['encode'];
                }
                $content.=self::listOptions($selection, $value, $dummy);
                $content.='</optgroup>'."\n";
            } else {
                $attributes=array('value'=>(string)$key, 'encode'=>!$raw);
                if (!is_array($selection) && !strcmp($key, $selection) || is_array($selection) && in_array($key, $selection)) {
                    $attributes['selected']='selected';
                }
                if (isset($options[$key])) {
                    $attributes=array_merge($attributes, $options[$key]);
                }
                $content.=self::tag('option', $attributes, $raw?(string)$value : self::encode((string)$value))."\n";
            }
        }

        unset($htmlOptions['key']);

        return $content;
    }

    public static function listOptionsPopular($selection, $listData, &$htmlOptions)
    {
        $raw=isset($htmlOptions['encode']) && !$htmlOptions['encode'];
        $content='';
        if (isset($htmlOptions['prompt'])) {
            $content.='<option value="">'.strtr($htmlOptions['prompt'], array('<'=>'&lt;', '>'=>'&gt;'))."</option>\n";
            unset($htmlOptions['prompt']);
        }
        if (isset($htmlOptions['empty'])) {
            if (!is_array($htmlOptions['empty'])) {
                $htmlOptions['empty']=array(''=>$htmlOptions['empty']);
            }
            foreach ($htmlOptions['empty'] as $value=>$label) {
                $content.='<option value="'.self::encode($value).'">'.strtr($label, array('<'=>'&lt;', '>'=>'&gt;'))."</option>\n";
            }
            unset($htmlOptions['empty']);
        }

        if (isset($htmlOptions['options'])) {
            $options=$htmlOptions['options'];
            unset($htmlOptions['options']);
        } else {
            $options=array();
        }

        $key=isset($htmlOptions['key']) ? $htmlOptions['key'] : 'primaryKey';
        if (is_array($selection)) {
            foreach ($selection as $i=>$item) {
                if (is_object($item)) {
                    $selection[$i]=$item->$key;
                }
            }
        } elseif (is_object($selection)) {
            $selection=$selection->$key;
        }

        foreach ($listData as $key=>$value) {
            if (is_array($value)) {
                $content.='<optgroup label="'.($raw?$key : self::encode($key))."\">\n";
                $dummy=array('options'=>$options);
                if (isset($htmlOptions['encode'])) {
                    $dummy['encode']=$htmlOptions['encode'];
                }
                $content.=self::listOptions($selection, $value, $dummy);
                $content.='</optgroup>'."\n";
            } else {
                // Проверка на прочерк между элементами списка
                $attributes=array('value'=>(string)$value, 'encode'=>!$raw);
                if ($value=='---') {
                    $attributes['value']='';
                }

                if (!is_array($selection) && !strcmp($value, $selection) || is_array($selection) && in_array($key, $selection)) {
                    $attributes['selected']='selected';
                }
                if (isset($options[$key])) {
                    $attributes=array_merge($attributes, $options[$key]);
                }
                $content.=self::tag('option', $attributes, $raw?(string)$value : self::encode((string)$value))."\n";
            }
        }

        unset($htmlOptions['key']);

        return $content;
    }

    /**
     * Appends {@link errorCss} to the 'class' attribute.
     * @param array $htmlOptions HTML options to be modified
     */
    protected static function addErrorCss(&$htmlOptions)
    {
        if (isset($htmlOptions['class'])) {
            $htmlOptions['class'].=' '.self::$errorCss;
        } else {
            $htmlOptions['class']=self::$errorCss;
        }
    }

    /**
     * Renders the HTML tag attributes.
     * Attributes whose value is null will not be rendered.
     * Special attributes, such as 'checked', 'disabled', 'readonly', will be rendered
     * properly based on their corresponding boolean value.
     * @param array $htmlOptions attributes to be rendered
     * @return string the rendering result
     */
    public static function renderAttributes($htmlOptions)
    {
        static $specialAttributes=array(
            'checked'=>1,
            'declare'=>1,
            'defer'=>1,
            'disabled'=>1,
            'ismap'=>1,
            'multiple'=>1,
            'nohref'=>1,
            'noresize'=>1,
            'readonly'=>1,
            'selected'=>1,
        );

        if ($htmlOptions===array()) {
            return '';
        }

        $html='';
        if (isset($htmlOptions['encode'])) {
            $raw=!$htmlOptions['encode'];
            unset($htmlOptions['encode']);
        } else {
            $raw=false;
        }

        if ($raw) {
            foreach ($htmlOptions as $name=>$value) {
                if (isset($specialAttributes[$name])) {
                    if ($value) {
                        $html .= ' ' . $name . '="' . $name . '"';
                    }
                } elseif ($value!==null) {
                    $html .= ' ' . $name . '="' . $value . '"';
                }
            }
        } else {
            foreach ($htmlOptions as $name=>$value) {
                if (isset($specialAttributes[$name])) {
                    if ($value) {
                        $html .= ' ' . $name . '="' . $name . '"';
                    }
                } elseif ($value!==null) {
                    $html .= ' ' . $name . '="' . self::encode($value) . '"';
                }
            }
        }
        return $html;
    }
}
