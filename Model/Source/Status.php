<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 02:54 PM
 */
namespace Lts\Contact\Model\Source;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $emp;

    public function __construct(\Lts\Contact\Model\Contact $emp)
    {
        $this->emp = $emp;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->getOptionArray();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }

    public static function getOptionArray()
    {
        return [1 => __('Active'), 0 => __('Inactive')];
    }
}
