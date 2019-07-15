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

- join - common root name if any source has different root name (default is *root*, specifying *false* denies different names)
- updn - traverse the nodes by name sequence (*true*, default) or overall sequence (*false*)
- stay - the destination node *stay* attribute value to deny overwriting of specific node (default is *all*, can be array of values or empty)
- keep - the source node *keep* attribute value to deny overwriting of specific node (default is *all*, can be array of values or empty)

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

1. *mergexml.php* - the MergeXML class; requires PHP 5.3+;
2. *example.html* - client-side to select the xml files and display result;
3. *example.php* - server-side to receive & pass the xml data and return result;
4. *test1.xml, test2.xml* - test data for the example;
5. *packxml.php* - utility class to minify XML source.

The MergeXML is realized also in JavaScript (see [github.com]).

ChangeLog
---------

May 2014

- *mergexml.php*
  - *stay* parameter is added for *AddFile* and *AddSource* methods
  - *NameSpaces* method is added to register/xpath 1st (single) source

September 2015

- *mergexml.php*
  - *fmt* and *enc* parameters are added
- *packxml.php* utility is added to compress the XML string

December 2015

- *mergexml.php*
  - *keep* parameter is added for *__construct*, *AddFile* and *AddSource* methods

April 2017

- *mergexml.php*
  - [PackApp] obfuscation compatibility

May 2018

- *mergexml.php*
  - case-insensitive encoding checking

July 2019

- *example.html*
  - select multiple files (html5)

  [github.com]: http://www.github.com/hareko/js-merge-xml
  [PackApp]: http://vregistry.com/packapp
