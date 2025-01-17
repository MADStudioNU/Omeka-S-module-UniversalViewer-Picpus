Universal Viewer (module for Omeka S)
=====================================

[![Build Status](https://travis-ci.org/Daniel-KM/Omeka-S-module-UniversalViewer.svg?branch=master)](https://travis-ci.org/Daniel-KM/Omeka-S-module-UniversalViewer)

[Universal Viewer] is a module for [Omeka S] that integrates [UniversalViewer],
a unified online player for any files, so it can display books, images, maps,
audio, movies, pdf, 3D, and anything else as long as the appropriate extension
is installed. Rotation, zoom, inside search, etc. may be managed too.

It uses the resources of any [IIIF] compliant server. The full specification of
the "International Image Interoperability Framework" standard is supported
(level 2). If you don’t have an [IIPImage] server, Omeka S can be one! Just
install the module [IIIF Server].

It’s an alternative to the [Mirador Viewer] or the lighter [Diva Viewer].

The Universal Viewer was firstly developed by [Digirati] for the [Wellcome Library]
of the [British Library] and the [National Library of Wales], then open sourced
(unlike the viewer of [Gallica], the public digital library built by the [Bibliothèque Nationale de France], which is sold to its partners).

This [Omeka S] module is a rewrite of the [Universal Viewer plugin for Omeka] by
[BibLibre] with the same features as the original plugin, but separated into two
modules (the IIIF server and the widget Universal Viewer).

See a [demo] on the [Bibliothèque patrimoniale] of [Mines ParisTech], or you can
set the url "https://patrimoine.mines-paristech.fr/iiif/collection/7"
in the official [example server], because this is fully interoperable.


Installation
------------

The module uses an external library [UniversalViewer], so use the release zip to
install it, or use and init the source.

* From the zip

Download the last release [`UniversalViewer.zip`] from the list of releases (the
master does not contain the dependency), and uncompress it in the `modules`
directory.

* From the source and for development:

If the module was installed from the source, rename the name of the folder of
the module to `UniversalViewer`, and go to the root module, and run:

```
    composer install
```

The next times:

```
    composer update
```

* Configuration

Then install it like any other Omeka module.

If you don’t have an IIIF Server, install the module [IIIF Server].

If you need to display big images (bigger than 1 to 10 MB according to your
server and your network), use an external image server, or create tiles with [IIIF Server].
The tiling means that big images like maps and deep paintings, and any other
images, are converted into tiles in order to load and zoom them instantly.

Only one option can be set in the main config (the manifest property, if any).
The other ones can be set differently for each site via the theme:

- in the json file "config.json" of UniversalViewer for the player itself: copy
  and update it in a folder named "universal-viewer" inside the folder "asset"
  of the theme;
- via the helper: to use an alternative config for some items, add an option
  `config` with its url in the array of arguments passed to the viewer (see
  below), or use a metadata in the field set in the IIIF server config form.

See below the notes for more info.


Usage
-----

If the [IIIF Server] is installed, all resources of Omeka S are automatically
available by the Universal Viewer.

The viewer is always available at `http://www.example.com/item-set/{item-set id}/play`
and `http://www.example.com/item/{item id}/play`. Furthermore, it is
automatically embedded in "item-set/{id}" and "item/{id}" show and/or browse
pages. This can be disabled in the settings of the site. Finally, a block layout
is available to add the viewer in any standard page.

To embed the Universal Viewer somewhere else, just use the helper:

```php
    // Display the viewer with the specified item set.
    echo $this->universalViewer($itemSet);

    // Display the viewer with the specified item and specified options.
    // The options for UV are directly passed to the partial, so they are
    // available in the theme and set for the viewer.
    echo $this->universalViewer($item, $options);

    // Display multiple resources (items and/or item sets).
    echo $this->universalViewer($resources);
```


Notes
-----

- If an item has no file, the viewer is not able to display it, so a check is
  automatically done.
- Media: Currently, no image should be available in the same item.
- Audio/Video: the format should be supported by the browser of the user. In
  fact, only open, free and/or common codecs are really supported: "mp3" and
  "ogg" for audio and "webm" and "ogv" for video. They can be modified in the
  file "routes.ini".
- The Universal Viewer cannot display empty item sets, so an empty view may
  appear when multiple resources are displayed.
- The display of 3D models is fully supported by the widget and natively managed
  since the release 2.3. 3D models are managed via the [threejs] library.
  Nevertheless, see the readme of the module [IIIF Server] for some possible
  additional requirements.


Bugs
----

- When an item set contains non image items, the left panel with the index is
  displayed only when the first item contains an image.


Warning
-------

Use it at your own risk.

It’s always recommended to backup your files and your databases and to check
your archives regularly so you can roll back if needed.


Troubleshooting
---------------

See online issues on the [module issues] page on GitHub.


License
-------

This module is published under the [CeCILL v2.1] licence, compatible with
[GNU/GPL] and approved by [FSF] and [OSI].

In consideration of access to the source code and the rights to copy, modify and
redistribute granted by the license, users are provided only with a limited
warranty and the software’s author, the holder of the economic rights, and the
successive licensors only have limited liability.

In this respect, the risks associated with loading, using, modifying and/or
developing or reproducing the software by the user are brought to the user’s
attention, given its Free Software status, which may make it complicated to use,
with the result that its use is reserved for developers and experienced
professionals having in-depth computer knowledge. Users are therefore encouraged
to load and test the suitability of the software as regards their requirements
in conditions enabling the security of their systems and/or data to be ensured
and, more generally, to use and operate it in the same conditions of security.
This Agreement may be freely reproduced and published, provided it is not
altered, and that no provisions are either added or removed herefrom.

The [UniversalViewer] is published under the [MIT licence].


Contact
-------

See documentation on the UniversalViewer and the IIIF on their respective site.

Current maintainers of the module:
* Daniel Berthereau (see [Daniel-KM])

First version of this module was built for [Mines ParisTech].


Copyright
---------

Widget [UniversalViewer]:

* Copyright Wellcome Library, 2013
* Copyright British Library, 2015-2017
* Copyright National Library of Wales, 2015-2017
* Copyright [Edward Silverton] 2013-2017

Module Universal Viewer for Omeka S:

* Copyright Daniel Berthereau, 2015-2018
* Copyright BibLibre, 2016-2017


[Universal Viewer]: https://github.com/Daniel-KM/Omeka-S-module-UniversalViewer
[Omeka S]: https://omeka.org/s
[Omeka]: https://omeka.org
[IIIF Server]: https://github.com/Daniel-KM/Omeka-S-module-IiifServer
[IIIF]: http://iiif.io
[IIPImage]: http://iipimage.sourceforge.net
[UniversalViewer]: https://github.com/UniversalViewer/universalviewer
[Digirati]: http://digirati.co.uk
[British Library]: http://bl.uk
[National Library of Wales]: http://www.llgc.org.uk
[Gallica]: http://gallica.bnf.fr
[Bibliothèque Nationale de France]: http://bnf.fr
[Wellcome Library]: http://wellcomelibrary.org
[Universal Viewer plugin for Omeka]: https://github.com/Daniel-KM/Omeka-plugin-UniversalViewer
[BibLibre]: https://github.com/biblibre
[demo]: https://patrimoine.mines-paristech.fr/collections/play/7
[Bibliothèque patrimoniale]: https://patrimoine.mines-paristech.fr
[Mines ParisTech]: http://mines-paristech.fr
[example server]: http://universalviewer.io/examples/
[`UniversalViewer.zip`]: https://github.com/Daniel-KM/Omeka-S-module-UniversalViewer/releases
[Upgrade to Omeka S]: https://github.com/Daniel-KM/Omeka-S-module-UpgradeToOmekaS
[wiki]: https://github.com/UniversalViewer/universalviewer/wiki/Configuration
[online]: http://universalviewer.io/examples/
[iiif specifications]: http://iiif.io/api/
[official release]: https://github.com/UniversalViewer/universalviewer/releases
[OpenLayersZoom]: https://github.com/Daniel-KM/Omeka-S-module-OpenLayersZoom
[threejs]: https://threejs.org
[Archive Repertory]: https://github.com/Daniel-KM/Omeka-S-module-ArchiveRepertory
[module issues]: https://github.com/Daniel-KM/Omeka-S-module-UniversalViewer/issues
[CeCILL v2.1]: https://www.cecill.info/licences/Licence_CeCILL_V2.1-en.html
[GNU/GPL]: https://www.gnu.org/licenses/gpl-3.0.html
[FSF]: https://www.fsf.org
[OSI]: http://opensource.org
[MIT licence]: https://github.com/UniversalViewer/universalviewer/blob/master/LICENSE.txt
[Edward Silverton]: https://github.com/edsilv
[Daniel-KM]: https://github.com/Daniel-KM "Daniel Berthereau"
