# API Documentation

## Table of Contents

* [Html](#html)
    * [encode](#encode)
    * [decode](#decode)
    * [encodeArray](#encodearray)
    * [tag](#tag)
    * [openTag](#opentag)
    * [closeTag](#closetag)
    * [cdata](#cdata)
    * [metaTag](#metatag)
    * [linkTag](#linktag)
    * [css](#css)
    * [cssFile](#cssfile)
    * [script](#script)
    * [scriptFile](#scriptfile)
    * [form](#form)
    * [beginForm](#beginform)
    * [endForm](#endform)
    * [formErrors](#formerrors)
    * [link](#link)
    * [mailto](#mailto)
    * [image](#image)
    * [button](#button)
    * [htmlButton](#htmlbutton)
    * [submitButton](#submitbutton)
    * [resetButton](#resetbutton)
    * [imageButton](#imagebutton)
    * [linkButton](#linkbutton)
    * [label](#label)
    * [textField](#textfield)
    * [hiddenField](#hiddenfield)
    * [passwordField](#passwordfield)
    * [fileField](#filefield)
    * [textArea](#textarea)
    * [radioButton](#radiobutton)
    * [checkBox](#checkbox)
    * [dropDownList](#dropdownlist)
    * [dropDownListPopular](#dropdownlistpopular)
    * [listBox](#listbox)
    * [normalizeUrl](#normalizeurl)
    * [listData](#listdata)
    * [value](#value)
    * [getIdByName](#getidbyname)
    * [listOptions](#listoptions)
    * [listOptionsPopular](#listoptionspopular)
    * [renderAttributes](#renderattributes)

## Html

Html helper class file.



* Full name: \Devgkz\Html\Html

**See Also:**

* https://github.com/devgkz/html 

### encode

Encodes special characters into HTML entities.

```php
Html::encode( string $text ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | data to be encoded |


**Return Value:**

the encoded data



---

### decode

Decodes special HTML entities back to the corresponding characters.

```php
Html::decode( string $text ): string
```

This is the opposite of \encode().

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | data to be decoded |


**Return Value:**

the decoded data



---

### encodeArray

Encodes special characters in an array of strings into HTML entities.

```php
Html::encodeArray( array $data ): array
```

Both the array keys and values will be encoded if needed.
If a value is an array, this method will also encode it recursively.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **array** | data to be encoded |


**Return Value:**

the encoded data



---

### tag

Generates an HTML element.

```php
Html::tag( string $tag, array $htmlOptions = array(), mixed $content = false, boolean $closeTag = true ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$tag` | **string** | the tag name |
| `$htmlOptions` | **array** | the element attributes. The values will be HTML-encoded using {@link encode()}.
If an 'encode' attribute is given and its value is false,
the rest of the attribute values will NOT be HTML-encoded.
Attributes whose value is null will not be rendered. |
| `$content` | **mixed** | the content to be enclosed between open and close element tags. It will not be HTML-encoded. If false, it means there is no body content. |
| `$closeTag` | **boolean** | whether to generate the close tag. |


**Return Value:**

the generated HTML element tag



---

### openTag

Generates an open HTML element.

```php
Html::openTag( string $tag,  $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$tag` | **string** | the tag name |
| `$htmlOptions` | **** |  |


**Return Value:**

the generated HTML element tag



---

### closeTag

Generates a close HTML element.

```php
Html::closeTag( string $tag ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$tag` | **string** | the tag name |


**Return Value:**

the generated HTML element tag



---

### cdata

Encloses the given string within a CDATA tag.

```php
Html::cdata( string $text ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | the string to be enclosed |


**Return Value:**

the CDATA tag with the enclosed content.



---

### metaTag

Generates a meta tag that can be inserted in the head section of HTML page.

```php
Html::metaTag( string $content, string $name = null, string $httpEquiv = null, array $options = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$content` | **string** | content attribute of the meta tag |
| `$name` | **string** | name attribute of the meta tag. If null, the attribute will not be generated |
| `$httpEquiv` | **string** | http-equiv attribute of the meta tag. If null, the attribute will not be generated |
| `$options` | **array** | other options in name-value pairs (e.g. 'scheme', 'lang') |


**Return Value:**

the generated meta tag



---

### linkTag

Generates a link tag that can be inserted in the head section of HTML page.

```php
Html::linkTag( string $relation = null, string $type = null, string $href = null, string $media = null, array $options = array() ): string
```

Do not confuse this method with \link(). The latter generates a hyperlink.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$relation` | **string** | rel attribute of the link tag. If null, the attribute will not be generated. |
| `$type` | **string** | type attribute of the link tag. If null, the attribute will not be generated. |
| `$href` | **string** | href attribute of the link tag. If null, the attribute will not be generated. |
| `$media` | **string** | media attribute of the link tag. If null, the attribute will not be generated. |
| `$options` | **array** | other options in name-value pairs |


**Return Value:**

the generated link tag



---

### css

Encloses the given CSS content with a CSS tag.

```php
Html::css( string $text, string $media = &#039;&#039; ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | the CSS content |
| `$media` | **string** | the media that this CSS should apply to. |


**Return Value:**

the CSS properly enclosed



---

### cssFile

Links to the specified CSS file.

```php
Html::cssFile( string $url, string $media = &#039;&#039; ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$url` | **string** | the CSS URL |
| `$media` | **string** | the media that this CSS should apply to. |


**Return Value:**

the CSS link.



---

### script

Encloses the given JavaScript within a script tag.

```php
Html::script( string $text ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | the JavaScript to be enclosed |


**Return Value:**

the enclosed JavaScript



---

### scriptFile

Includes a JavaScript file.

```php
Html::scriptFile( string $url ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$url` | **string** | URL for the JavaScript file |


**Return Value:**

the JavaScript file tag



---

### form

Generates an opening form tag.

```php
Html::form( mixed $action = &#039;&#039;, string $method = &#039;post&#039;, array $htmlOptions = array() ): string
```

This is a shortcut to \beginForm.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$action` | **mixed** | the form action URL (see {@link normalizeUrl} for details about this parameter.) |
| `$method` | **string** | form method (e.g. post, get) |
| `$htmlOptions` | **array** | additional HTML attributes (see {@link tag}). |


**Return Value:**

the generated form tag.



---

### beginForm

Generates an opening form tag.

```php
Html::beginForm( mixed $action = &#039;&#039;, string $method = &#039;post&#039;, array $htmlOptions = array() ): string
```

Note, only the open tag is generated. A close tag should be placed manually
at the end of the form.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$action` | **mixed** | the form action URL (see {@link normalizeUrl} for details about this parameter.) |
| `$method` | **string** | form method (e.g. post, get) |
| `$htmlOptions` | **array** | additional HTML attributes (see {@link tag}). |


**Return Value:**

the generated form tag.



---

### endForm

Generates a closing form tag.

```php
Html::endForm(  ): string
```



* This method is **static**.

**Return Value:**

the generated tag



---

### formErrors

Return composed fields errors.

```php
Html::formErrors(  $errors = array(),  $header = &#039;&lt;p&gt;&lt;b&gt;Please fix errors:&lt;/b&gt;&lt;/p&gt;&#039; ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$errors` | **** |  |
| `$header` | **** |  |


**Return Value:**

the generated html



---

### link

Generates a hyperlink tag.

```php
Html::link( string $text, mixed $url = &#039;#&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | link body. It will NOT be HTML-encoded. Therefore you can pass in HTML code such as an image tag. |
| `$url` | **mixed** | a URL or an action route that can be used to create a URL. |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated hyperlink



---

### mailto

Generates a mailto link.

```php
Html::mailto( string $text, string $email = &#039;&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$text` | **string** | link body. It will NOT be HTML-encoded. Therefore you can pass in HTML code such as an image tag. |
| `$email` | **string** | email address. If this is empty, the first parameter (link body) will be treated as the email address. |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated mailto link



---

### image

Generates an image tag.

```php
Html::image( string $src, string $alt = &#039;&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$src` | **string** | the image URL |
| `$alt` | **string** | the alternative text display |
| `$htmlOptions` | **array** | additional HTML attributes (see {@link tag}). |


**Return Value:**

the generated image tag



---

### button

Generates a button.

```php
Html::button( string $label = &#039;button&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$label` | **string** | the button label |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated button tag



---

### htmlButton

Generates a button using HTML button tag.

```php
Html::htmlButton( string $label = &#039;button&#039;, array $htmlOptions = array() ): string
```

This method is similar to \button except that it generates a 'button'
tag instead of 'input' tag.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$label` | **string** | the button label. Note that this value will be directly inserted in the button element without being HTML-encoded. |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated button tag



---

### submitButton

Generates a submit button.

```php
Html::submitButton( string $label = &#039;submit&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$label` | **string** | the button label |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated button tag



---

### resetButton

Generates a reset button.

```php
Html::resetButton( string $label = &#039;reset&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$label` | **string** | the button label |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated button tag



---

### imageButton

Generates an image submit button.

```php
Html::imageButton( string $src, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$src` | **string** | the image URL |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated button tag



---

### linkButton

Generates a link submit button.

```php
Html::linkButton( string $label = &#039;submit&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$label` | **string** | the button label |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated button tag



---

### label

Generates a label tag.

```php
Html::label( string $label, string $for, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$label` | **string** | label text. Note, you should HTML-encode the text if needed. |
| `$for` | **string** | the ID of the HTML element that this label is associated with.
If this is false, the 'for' attribute for the label tag will not be rendered. |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated label tag



---

### textField

Generates a text field input.

```php
Html::textField( string $name, string $value = &#039;&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$value` | **string** | the input value |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated input field



---

### hiddenField

Generates a hidden input.

```php
Html::hiddenField( string $name, string $value = &#039;&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$value` | **string** | the input value |
| `$htmlOptions` | **array** | additional HTML attributes (see {@link tag}). |


**Return Value:**

the generated input field



---

### passwordField

Generates a password field input.

```php
Html::passwordField( string $name, string $value = &#039;&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$value` | **string** | the input value |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated input field



---

### fileField

Generates a file input.

```php
Html::fileField( string $name, string $value = &#039;&#039;, array $htmlOptions = array() ): string
```

Note, you have to set the enclosing form's 'enctype' attribute to be 'multipart/form-data'.
After the form is submitted, the uploaded file information can be obtained via $_FILES[$name] (see
PHP documentation).

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$value` | **string** | the input value |
| `$htmlOptions` | **array** | additional HTML attributes (see {@link tag}). |


**Return Value:**

the generated input field



---

### textArea

Generates a text area input.

```php
Html::textArea( string $name, string $value = &#039;&#039;, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$value` | **string** | the input value |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated text area



---

### radioButton

Generates a radio button.

```php
Html::radioButton( string $name, boolean $checked = false, array $htmlOptions = array() ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$checked` | **boolean** | whether the radio button is checked |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated radio button



---

### checkBox

Generates a check box.

```php
Html::checkBox( string $name, boolean $checked = false, array $htmlOptions = array() ): string
```

Special option named 'uncheckValue' is available that can be used to specify
the value returned when the checkbox is not checked. When set, a hidden field is rendered so that
when the checkbox is not checked, we can still obtain the posted uncheck value.
If 'uncheckValue' is not set or set to NULL, the hidden field will not be rendered.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$checked` | **boolean** | whether the check box is checked |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated check box



---

### dropDownList

Generates a drop down list.

```php
Html::dropDownList( string $name, string $select, array $data, array $htmlOptions = array() ): string
```

You may use \listData to generate this data.
Please refer to \listOptions on how this data is used to generate the list options.
Note, the values and labels will be automatically HTML-encoded by this method.
In addition, the following options are also supported specifically for dropdown list:
<ul>
<li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
<li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
<li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
The 'empty' option can also be an array of value-label pairs.
Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
<li>options: array, specifies additional attributes for each OPTION tag.
    The array keys must be the option values, and the array values are the extra
    OPTION tag attributes in the name-value pairs. For example,
<pre>
    [
        'value1'=>array('disabled'=>true, 'label'=>'value 1'),
        'value2'=>array('label'=>'value 2'),
    ];
</pre>
</li>
</ul>

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$select` | **string** | the selected value |
| `$data` | **array** | data for generating the list options (value=>display). |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated drop down list



---

### dropDownListPopular



```php
Html::dropDownListPopular(  $name,  $select,  $data,  $htmlOptions = array() )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **** |  |
| `$select` | **** |  |
| `$data` | **** |  |
| `$htmlOptions` | **** |  |




---

### listBox

Generates a list box.

```php
Html::listBox( string $name, mixed $select, array $data, array $htmlOptions = array() ): string
```

You may use \listData to generate this data.
Please refer to \listOptions on how this data is used to generate the list options.
Note, the values and labels will be automatically HTML-encoded by this method.
In addition, the following options are also supported specifically for list box:
<ul>
<li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
<li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
<li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
The 'empty' option can also be an array of value-label pairs.
Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
<li>options: array, specifies additional attributes for each OPTION tag.
    The array keys must be the option values, and the array values are the extra
    OPTION tag attributes in the name-value pairs. For example,
<pre>
    [
        'value1'=>array('disabled'=>true, 'label'=>'value 1'),
        'value2'=>array('label'=>'value 2'),
    ];
</pre>
</li>
</ul>

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | the input name |
| `$select` | **mixed** | the selected value(s). This can be either a string for single selection or an array for multiple selections. |
| `$data` | **array** | data for generating the list options (value=>display) |
| `$htmlOptions` | **array** | additional HTML attributes. |


**Return Value:**

the generated list box



---

### normalizeUrl

Normalizes the input parameter to be a valid URL.

```php
Html::normalizeUrl( mixed $url ): string
```

If the input parameter is an empty string, the currently requested URL will be returned.
If the input parameter is a non-empty string, it is treated as a valid URL and will
be returned without any change.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$url` | **mixed** | the parameter to be used to generate a valid URL |


**Return Value:**

the normalized URL



---

### listData

Generates the data suitable for list-based HTML elements.

```php
Html::listData( array $models, string $valueField, string $textField, string $groupField = &#039;&#039; ): array
```

The generated data can be used in \dropDownList, \listBox, \checkBoxList,
\radioButtonList, and their active-versions (such as \activeDropDownList).
Note, this method does not HTML-encode the generated data. You may call \encodeArray to
encode it if needed.
Please refer to the \value method on how to specify value field, text field and group field.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$models` | **array** | a list of model objects. |
| `$valueField` | **string** | the attribute name for list option values |
| `$textField` | **string** | the attribute name for list option texts |
| `$groupField` | **string** | the attribute name for list option group names. If empty, no group will be generated. |


**Return Value:**

the list data that can be used in {@link dropDownList}, {@link listBox}, etc.



---

### value

Evaluates the value of the specified attribute for the given model.

```php
Html::value( mixed $model, string $attribute, mixed $defaultValue = null ): mixed
```

The attribute name can be given in a dot syntax. For example, if the attribute
is "author.firstName", this method will return the value of "$model->author->firstName".
A default value (passed as the last parameter) will be returned if the attribute does
not exist or is broken in the middle (e.g. $model->author is null).
The model can be either an object or an array. If the latter, the attribute is treated
as a key of the array. For the example of "author.firstName", if would mean the array value
"$model['author']['firstName']".

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$model` | **mixed** | the model. This can be either an object or an array. |
| `$attribute` | **string** | the attribute name (use dot to concatenate multiple attributes) |
| `$defaultValue` | **mixed** | the default value to return when the attribute does not exist |


**Return Value:**

the attribute value



---

### getIdByName

Generates a valid HTML ID based on name.

```php
Html::getIdByName( string $name ): string
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** | name from which to generate HTML ID |


**Return Value:**

the ID generated based on name.



---

### listOptions

Generates the list options.

```php
Html::listOptions( mixed $selection, array $listData, array &$htmlOptions ): string
```

<ul>
<li>encode: boolean, specifies whether to encode the values. Defaults to true.</li>
<li>prompt: string, specifies the prompt text shown as the first list option. Its value is empty. Note, the prompt text will NOT be HTML-encoded.</li>
<li>empty: string, specifies the text corresponding to empty selection. Its value is empty.
The 'empty' option can also be an array of value-label pairs.
Each pair will be used to render a list option at the beginning. Note, the text label will NOT be HTML-encoded.</li>
<li>options: array, specifies additional attributes for each OPTION tag.
    The array keys must be the option values, and the array values are the extra
    OPTION tag attributes in the name-value pairs. For example,
<pre>
    [
        'value1'=>array('disabled'=>true, 'label'=>'value 1'),
        'value2'=>array('label'=>'value 2'),
    ];
</pre>
</li>
<li>key: string, specifies the name of key attribute of the selection object(s).
This is used when the selection is represented in terms of objects. In this case,
the property named by the key option of the objects will be treated as the actual selection value.
This option defaults to 'primaryKey', meaning using the 'primaryKey' property value of the objects in the selection.
This option has been available since version 1.1.3.</li>
</ul>

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$selection` | **mixed** | the selected value(s). This can be either a string for single selection or an array for multiple selections. |
| `$listData` | **array** | the option data (see {@link listData}) |
| `$htmlOptions` | **array** | additional HTML attributes. The following two special attributes are recognized: |


**Return Value:**

the generated list options



---

### listOptionsPopular



```php
Html::listOptionsPopular(  $selection,  $listData,  &$htmlOptions )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$selection` | **** |  |
| `$listData` | **** |  |
| `$htmlOptions` | **** |  |




---

### renderAttributes

Renders the HTML tag attributes.

```php
Html::renderAttributes( array $htmlOptions ): string
```

Attributes whose value is null will not be rendered.
Special attributes, such as 'checked', 'disabled', 'readonly', will be rendered
properly based on their corresponding boolean value.

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$htmlOptions` | **array** | attributes to be rendered |


**Return Value:**

the rendering result



---



--------
> This document was automatically generated from source code comments on 2017-08-18 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
