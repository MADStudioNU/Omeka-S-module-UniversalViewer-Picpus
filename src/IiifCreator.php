<?php

/*
 * Copyright 2015  Daniel Berthereau
 * Copyright 2016  BibLibre
 *
 * This software is governed by the CeCILL license under French law and abiding
 * by the rules of distribution of free software.  You can use, modify and/or
 * redistribute the software under the terms of the CeCILL license as circulated
 * by CEA, CNRS and INRIA at the following URL "http://www.cecill.info".
 *
 * As a counterpart to the access to the source code and rights to copy, modify
 * and redistribute granted by the license, users are provided only with a
 * limited warranty and the software's author, the holder of the economic
 * rights, and the successive licensors have only limited liability.
 *
 * In this respect, the user's attention is drawn to the risks associated with
 * loading, using, modifying and/or developing or reproducing the software by
 * the user in light of its specific status of free software, that may mean that
 * it is complicated to manipulate, and that also therefore means that it is
 * reserved for developers and experienced professionals having in-depth
 * computer knowledge. Users are therefore encouraged to load and test the
 * software's suitability as regards their requirements in conditions enabling
 * the security of their systems and/or data to be ensured and, more generally,
 * to use and operate it in the same conditions as regards security.
 *
 * The fact that you are presently reading this means that you have had
 * knowledge of the CeCILL license and that you accept its terms.
 */

namespace UniversalViewer;

use Zend\Log\LoggerAwareInterface;
use Zend\Log\LoggerAwareTrait;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\TranslatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Omeka\File\Manager as FileManager;
use Omeka\Settings\Settings;

/**
 * Helper to create an image from another one with IIIF arguments.
 *
 * @package UniversalViewer
 */
class IiifCreator implements LoggerAwareInterface, TranslatorAwareInterface
{
    use LoggerAwareTrait, TranslatorAwareTrait;

    protected $_creator;
    protected $_args = array();
    protected $fileManager;

    public function __construct(FileManager $fileManager, Settings $settings)
    {
        $this->fileManager = $fileManager;
        $creatorClass = $settings->get('universalviewer_iiif_creator', 'Auto');
        $this->setCreator("\\UniversalViewer\\IiifCreator\\" . $creatorClass);
    }

    public function setCreator($creatorClass)
    {
        try {
            $this->_creator = new $creatorClass($this->fileManager);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setArgs($args)
    {
        $this->_args = $args;
    }

    /**
     * Transform an image into another image according to params.
     *
     * @internal The args are currently already checked in the controller.
     *
     * @param array $args List of arguments for the transformation.
     * @return string|null The filepath to the temp image if success.
     */
    public function transform(array $args = array())
    {
        if (!empty($args)) {
            $this->setArgs($args);
        }

        $this->_creator->setLogger($this->getLogger());
        $this->_creator->setTranslator($this->getTranslator());
        return $this->_creator->transform($this->_args);
    }
}