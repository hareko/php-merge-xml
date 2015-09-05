PHP MergeXML class
==================

The class allows to merge the XML sources (files, strings, objects) into single DOM XML object.
The merging is performed recursively on the node level adding new elements and replacing existing ones.
The nodes with the same path/name are replaced/added sequentially and the modification can be controlled by the options.

MergeXML could be useful in cases where it is necessary to gather XML data from multiple sources.
For example, to join the configuration files of different subsystems depending on the system operation. 

The usage
---------

**$oMX = new MergeXML([$opts]);**

$opts - the options array:

- join - common root name if any source has different root name (*root* by default, specifying *false* denies different names)
- updn - traverse the nodes by name sequence (*true* by default) or overall sequence (*false*)
- stay - use the *stay* attribute value to deny overwriting of specific node (*all* by default, can be array of values, string or empty)
- fmt - *DOMDocument::$formatOutput* property value (*true* by default)
- enc - *DOMDocument::$encoding* property value (*utf-8* by default)
- clone - use the *clone* attribute value to clone specific nodes if they already exists (empty by default, can be array of values, string or empty)

**$oMX->AddFile($file)**;

> $file - XML file's pathed name

**$oMX->AddSource($source)**;

> $source - XML string or DOM object

The methods merge a sequent source and return the final object or *false* if failed (see *error* property below).

You can search in the result object:

**$oMX->Query($expr)**;

> $expr - XPath query expression

You can get the XML result tree:

**$oMX->Get([0|1|2])**;

- 0 - object (default)
- 1 - text
- 2 - html

The result object can be accessed also via *$oMX->dom* property. The properties available:

- **dom** - result XML DOM object
- **dxp** - result XPath object
- **nsp** - namespaces array (prefix => URI)
- **count** - number of sources merged
- **error** - error information
 - error->code ('' is ok)
 - error->text

The sources must have the same default namespace (if have at all).
Prefix '_' is reserved to handle default namespace.

The package
-----------

The following files are included:

1. *mergexml.php* - the MergeXML class; requires PHP 5.2+;
2. *example.html* - client-side to select the xml files and display result;
3. *example.php* - server-side to receive & pass the xml data and return result;
4. *test1.xml, test2.xml* - test data for the example.

The MergeXML is realized also in JavaScript (see [github.com]).

ChangeLog
---------

22 May 2014

- *mergexml.php*
 - *stay* parameter is added for *AddFile* and *AddSource* methods
 - *NameSpaces* method is added to register/xpath 1st (single) source

11 July 2014

- *mergexml.php*
 - *clone* parameter is added for *AddFile* and *AddSource* methods (Pedro Carrazco)

05 Sep 2015

- *mergexml.php*
 - *fmt* and *enc* parameters are added

  [github.com]: http://www.github.com/hareko/js-merge-xml
