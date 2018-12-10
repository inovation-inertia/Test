<?php

namespace Custom\Autocomplete\Model\Search;

use \Custom\Autocomplete\Helper\Data as HelperData;
use \Magento\Search\Helper\Data as SearchHelper;
use \Magento\Search\Model\AutocompleteInterface;
use \Custom\Autocomplete\Model\Source\AutocompleteFields;

/**
 * Suggested model. Return suggested data used in search autocomplete
 */
class Suggested implements \Custom\Autocomplete\Model\SearchInterface
{
    /**
     * @var \custom\Autocomplete\Helper\Data
     */
    protected $helperData;

    /**
     * @var \Magento\Search\Helper\Data
     */
    protected $searchHelper;

    /**
     * @var \Magento\Search\Model\AutocompleteInterface;
     */
    protected $autocomplete;

    /**
     * Suggested constructor.
     *
     * @param HelperData $helperData
     * @param SearchHelper $searchHelper
     * @param AutocompleteInterface $autocomplete
     */
    public function __construct(
        HelperData $helperData,
        SearchHelper $searchHelper,
        AutocompleteInterface $autocomplete
    ) {
        $this->helperData   = $helperData;
        $this->searchHelper = $searchHelper;
        $this->autocomplete = $autocomplete;
    }

    /**
     * {@inheritdoc}s
     */
    public function getResponseData()
    {
        $responseData['code'] = AutocompleteFields::SUGGEST;
        $responseData['data'] = [];

        if (!$this->canAddToResult()) {
            return $responseData;
        }

        $suggestResultNumber = $this->helperData->getSuggestedResultNumber();

        $autocompleteData = $this->autocomplete->getItems();
        $autocompleteData = array_slice($autocompleteData, 0, $suggestResultNumber);
        foreach ($autocompleteData as $item) {
            $item                   = $item->toArray();
            $item['url']            = $this->searchHelper->getResultUrl($item['title']);
            $responseData['data'][] = $item;
        }

        return $responseData;
    }

    /**
     * {@inheritdoc}
     */
    public function canAddToResult()
    {
        return in_array(AutocompleteFields::SUGGEST, $this->helperData->getAutocompleteFieldsAsArray());
    }
}
