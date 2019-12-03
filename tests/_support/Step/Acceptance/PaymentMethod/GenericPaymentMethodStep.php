<?php


namespace Step\Acceptance\PaymentMethod;


use Codeception\Scenario;
use Helper\Config\GenericConfig;
use Helper\Config\PaymentMethod\CreditCardConfig;
use Helper\Config\PaymentMethod\PayPalConfig;
use Step\Acceptance\GenericStep;
use Helper\Config\Filesystem;

/**
 * Class GenericPaymentMethodStep
 * @package Step\Acceptance\PaymentMethod
 */
class GenericPaymentMethodStep extends GenericStep
{
    /**
     * @var CreditCardConfig|PayPalConfig;
     */
    private $paymentMethod;

    /**
     * @var array
     */
    private $configObjectMap = [
        self::CREDIT_CARD => CreditCardConfig::class,
        self::PAY_PAL => PayPalConfig::class
    ];

    /**
     * GenericStep constructor.
     * @param Scenario $scenario
     * @param $gateway
     */
    public function __construct(Scenario $scenario, $gateway)
    {
        parent::__construct($scenario, $gateway);
        $this->setLocator($this->getDataFromDataFile($this->getFullPath(FileSystem::PAYMENT_METHOD_LOCATOR_FOLDER_PATH)
            . static::STEP_NAME . DIRECTORY_SEPARATOR . static::STEP_NAME . 'Locators.json'));
    }

    /**
     * @param $type
     * @param $dataFileName
     */
    public function setConfigObject($type, $dataFileName): void
    {
        $dataFolderPath = $this->getFullPath(FileSystem::PAYMENT_METHOD_DATA_FOLDER_PATH);
        $this->paymentMethod = new $this->configObjectMap[$type]($this->getDataFromDataFile($dataFolderPath . $dataFileName));
    }


    /**
     * @return GenericConfig| CreditCardConfig| PayPalConfig
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}