<?php

namespace Custom\Autocomplete\Model;

use \Custom\Autocomplete\Helper\Data as HelperData;
use \Custom\Autocomplete\Model\SearchFactory;

/**
 * Search class returns needed search data
 */
class Search
{
    /**
     * @var \Custom\Autocomplete\Helper\Data
     */
    protected $helperData;

    /**
     * @var \Custom\Autocomplete\Model\SearchFactory
     */
    protected $searchFactory;

    /**
     * Search constructor.
     *
     * @param HelperData $helperData
     * @param \Custom\Autocomplete\Model\SearchFactory $searchFactory
     */
    public function __construct(
        HelperData $helperData,
        SearchFactory $searchFactory
    ) {
        $this->helperData    = $helperData;
        $this->searchFactory = $searchFactory;
    }

    /**
     * Retrieve suggested, product data
     *
     * @return array
     */
    public function getData()
    {
        $data               = [];
        $autocompleteFields = $this->helperData->getAutocompleteFieldsAsArray();

        foreach ($autocompleteFields as $field) {
            $data[] = $this->searchFactory->create($field)->getResponseData();
        }

        return $data;
    }
}
